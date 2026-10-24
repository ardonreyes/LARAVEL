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