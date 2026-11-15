// UI Element

const navBar = document.getElementById('main-nav');
const UIBackdrop = document.getElementById('ui-backdrop-nav');

document?.getElementById('open-nav')?.addEventListener('click', () => {
    navBar.classList.replace('translate-x-full', 'translate-x-0');
    UIBackdrop.classList.replace('opacity-0', 'opacity-100');
})

document?.getElementById('close-nav')?.addEventListener('click', () => {
    navBar.classList.replace('translate-x-0', 'translate-x-full');
    UIBackdrop.classList.replace('opacity-100', 'opacity-0');
})

const recordModal = document.querySelector('[data-record-modal]');

if (recordModal) {
    const form = recordModal.querySelector('[data-record-form]');
    const title = document.getElementById('record-modal-title');
    const feedback = recordModal.querySelector('[data-form-feedback]');
    const baseUrl = new URL(recordModal.dataset.baseUrl, window.location.href);
    const basePath = baseUrl.pathname.replace(/\/$/, '');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    let closeTimer;
    let animationFrame;
    let returnFocus;

    function modalRoute(url = new URL(window.location.href)) {
        if (url.origin !== baseUrl.origin) return null;
        const path = url.pathname.replace(/\/$/, '');
        if (path === `${basePath}/create`) return { mode: 'create' };
        for (const mode of ['edit', 'delete']) {
            if (path.startsWith(`${basePath}/${mode}/`)) {
                const id = path.slice(`${basePath}/${mode}/`.length);
                if (/^\d+$/.test(id)) return { mode, id: id.replace(/^0+(?=\d)/, '') };
            }
        }
        return null;
    }

    function openModal(route, trigger, initial = false) {
        const card = route.mode !== 'create'
            ? document.querySelector(`.card[data-record-id="${route.id}"]`)
            : null;
        if (route.mode !== 'create' && !card) return false;

        clearTimeout(closeTimer);
        cancelAnimationFrame(animationFrame);
        const deleting = route.mode === 'delete';
        form.action = `${baseUrl.href}/${route.mode === 'create' ? 'create' : `${route.mode}/${route.id}`}`;
        const fields = form.querySelector('[data-record-fields]');
        fields.hidden = fields.disabled = deleting;
        form.querySelector('[data-delete-confirmation]').hidden = !deleting;
        form.querySelector('[data-delete-name]').textContent = card?.dataset.fullName ?? '';
        form.querySelector('[type="submit"]').textContent = deleting ? 'Delete' : 'Submit';
        title.textContent = `${{ create: 'Add', edit: 'Edit', delete: 'Delete' }[route.mode]} ${recordModal.dataset.recordLabel}`;

        if (!initial) {
            form.reset();
            feedback.hidden = true;
            for (const field of form.querySelectorAll('input:not([type="hidden"])')) {
                const key = field.name.replace(/_([a-z])/g, (_, letter) => letter.toUpperCase());
                field.value = card ? (card.dataset[key] ?? '') : (field.name === 'role' ? 'User' : '');
            }
        }
        form.elements.namedItem('_method').value = deleting ? 'DELETE' : 'POST';

        if (!recordModal.open) {
            returnFocus = trigger ?? document.activeElement;
            recordModal.showModal();
            document.body.classList.add('record-modal-open');
            // Commit the starting style before transitioning the dialog and backdrop.
            recordModal.getBoundingClientRect();
        }

        animationFrame = requestAnimationFrame(() => recordModal.classList.add('is-open'));
        const focusTarget = deleting ? recordModal.querySelector('[data-modal-close]') : form.elements.namedItem('full_name');
        focusTarget.focus({ preventScroll: true });
        return true;
    }

    function hideModal() {
        if (!recordModal.open) return;
        clearTimeout(closeTimer);
        cancelAnimationFrame(animationFrame);
        recordModal.classList.remove('is-open');
        closeTimer = setTimeout(() => {
            recordModal.close();
            document.body.classList.remove('record-modal-open');
            if (returnFocus?.isConnected) returnFocus.focus({ preventScroll: true });
        }, reducedMotion.matches ? 0 : 180);
    }

    function closeModal() {
        if (!recordModal.classList.contains('is-open')) return;
        hideModal();
        if (window.history.state?.recordModal) {
            window.history.back();
        } else {
            const listUrl = new URL(window.location.href);
            listUrl.pathname = basePath;
            window.history.replaceState(null, '', listUrl);
        }
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[data-modal-open]');
        if (link && event.button === 0 && !event.ctrlKey && !event.metaKey && !event.shiftKey && !event.altKey && !link.hasAttribute('download') && (!link.target || link.target === '_self')) {
            const url = new URL(link.href);
            const route = modalRoute(url);
            if (route && openModal(route, link)) {
                event.preventDefault();
                window.history.pushState({ recordModal: true }, '', url);
            }
        }

    });

    recordModal.querySelector('[data-modal-close]').addEventListener('click', closeModal);
    recordModal.addEventListener('cancel', (event) => {
        event.preventDefault();
        closeModal();
    });
    // Only dismiss when both ends of a click are outside the dialog panel.
    let backdropPointerDown = false;
    function isOutside(event) {
        const bounds = recordModal.getBoundingClientRect();
        return event.clientX < bounds.left || event.clientX > bounds.right
            || event.clientY < bounds.top || event.clientY > bounds.bottom;
    }
    recordModal.addEventListener('pointerdown', (event) => {
        backdropPointerDown = event.target === recordModal && isOutside(event);
    });
    recordModal.addEventListener('click', (event) => {
        if (backdropPointerDown && event.target === recordModal && isOutside(event)) closeModal();
        backdropPointerDown = false;
    });
    window.addEventListener('popstate', () => {
        const route = modalRoute();
        if (route) openModal(route);
        else hideModal();
    });

    const initialRoute = modalRoute();
    if (initialRoute) openModal(initialRoute, null, true);
}
