@extends('layouts.main')
@section('content')

<div class="customer_user-page">
    @include('component.header')

    <p data-record-feedback class="card feedback-{{ session('feedback_type', 'success') }} col-span-full text-center uppercase font-bold" @if (! session('feedback')) hidden @endif>{{ session('feedback') }}</p>

    @foreach ($data as $key)
        <div
            class="card grid-cols-[minmax(0,1fr)_auto] gap-3 my-3 md:my-0"
            data-record-id="{{ $key['id'] }}"
            data-full-name="{{ $key['full_name'] }}"
            data-email="{{ $key['email'] }}"
            data-phone="{{ $key['phone'] }}"
        >
            <div class="min-w-0 break-words">
                <h4>{{ $key['full_name'] }}</h4>
                <p>{{ $key['email'] }}</p>
                <p>{{ $key['phone'] }}</p>
            </div>
            <div class="flex flex-col items-center justify-start sm:flex-row sm:items-start">
                <a
                    href="{{ url('customers/edit/'.$key['id']) }}"
                    data-modal-open="edit"
                    data-record-id="{{ $key['id'] }}"
                    class="inline-flex size-8 items-center justify-center rounded-md text-slate-700 transition hover:bg-slate-100 hover:text-slate-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-700"
                    title="Edit customer"
                >
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a
                    href="{{ url('customers/delete/'.$key['id']) }}"
                    data-modal-open="delete"
                    class="inline-flex size-8 cursor-pointer items-center justify-center rounded-md text-red-700 transition hover:bg-red-50 hover:text-red-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700"
                    title="Delete customer"
                >
                    <i class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>

@endSection
