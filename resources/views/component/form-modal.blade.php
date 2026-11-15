@php
    $isCustomer = request()->is('customers', 'customers/*');
    $resource = $isCustomer ? 'customers' : 'users';
    $recordLabel = $isCustomer ? 'Customer' : 'User';
    $modalRecord = request()->route('num') ? $data->firstWhere('id', request()->route('num')) : null;
    $initialMode = request()->is($resource.'/create') ? 'create' : (isset($modalRecord) ? (request()->is($resource.'/delete/*') ? 'delete' : 'edit') : '');
@endphp

<dialog
    class="record-modal"
    data-record-modal
    data-base-url="{{ url($resource) }}"
    data-record-label="{{ $recordLabel }}"
    data-initial-mode="{{ $initialMode }}"
>
    <div class="flex items-start justify-between gap-4">
        <h2 class="uppercase" id="record-modal-title">{{ ['create' => 'Add', 'edit' => 'Edit', 'delete' => 'Delete'][$initialMode] ?? 'Add' }} {{ $recordLabel }}</h2>
        <button
            type="button"
            data-modal-close
            class="inline-flex size-8 shrink-0 cursor-pointer items-center justify-center rounded-md transition hover:bg-slate-200 hover:text-gray-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-700"
            title="Close {{ strtolower($recordLabel) }} form"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div data-form-feedback class="card feedback-failed text-center uppercase font-bold my-3" @if (! $errors->any()) hidden @endif>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>

    <form action="{{ url($resource.'/'.($modalRecord ? $initialMode.'/'.$modalRecord->id : 'create')) }}" method="post" data-record-form class="grid gap-3 mt-2" novalidate>
        @csrf
        <input type="hidden" name="_method" value="{{ $initialMode === 'delete' ? 'DELETE' : 'POST' }}">
        <p data-delete-confirmation @if ($initialMode !== 'delete') hidden @endif>Are you sure you want to delete <strong data-delete-name>{{ $modalRecord?->full_name }}</strong>?</p>
        <fieldset data-record-fields class="grid gap-3" @if ($initialMode === 'delete') hidden disabled @endif>
        <!-- <label class="profile-picker" for="user-add-profile" title="Choose profile image">
            <img src=""
            <span class="profile-picker-overlay">
                <i class="fa-solid fa-camera"></i>
            </span>
            <input
                type="file"
                id="user-add-profile"
                name="profile"
                accept="image/jpeg,image/png"
            >
        </label> -->

        <div class="modal-form-field">
            <label for="record-full-name">Full Name:</label>
            <input type="text" id="record-full-name" name="full_name" value="{{ old('full_name', $modalRecord?->full_name ?? '') }}" placeholder="First Last" autocomplete="name" autofocus>
        </div>

        @if ($isCustomer)
            <div class="modal-form-field">
                <label for="record-email">E-mail:</label>
                <input type="email" id="record-email" name="email" value="{{ old('email', $modalRecord?->email ?? '') }}" placeholder="local@domain.com" autocomplete="email">
            </div>
            <div class="modal-form-field">
                <label for="record-phone">Phone:</label>
                <input type="tel" id="record-phone" name="phone" value="{{ old('phone', $modalRecord?->phone ?? '') }}" placeholder="09-XX-XXX-XXXX" autocomplete="tel">
            </div>
        @else
            <div class="modal-form-field">
                <label for="record-username">Username:</label>
                <input type="text" id="record-username" name="username" value="{{ old('username', $modalRecord?->username ?? '') }}" placeholder="Username" autocomplete="username">
            </div>
            <div class="modal-form-field">
                <label for="record-role">Role:</label>
                <input type="text" id="record-role" name="role" value="{{ $modalRecord?->role ?? 'User' }}" readonly>
            </div>
        @endif
        </fieldset>

        <button type="submit" class="cursor-pointer mt-2 bg-slate-700 w-full py-3 uppercase font-bold rounded-md text-white hover:bg-slate-600 transition-colors">{{ $initialMode === 'delete' ? 'Delete' : 'Submit' }}</button>
    </form>
</dialog>
