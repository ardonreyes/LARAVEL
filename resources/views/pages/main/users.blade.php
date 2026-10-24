@extends('layouts.main')
@section('content')

<div class="customer_user-page">
    @include('component.header')

    @foreach ($data as $key)
        <div class="card my-3 md:my-0">
            <h4>{{ $key['full_name'] }}</h4>
            <p>{{ $key['username'] }}</p>
            <p>{{ $key['role'] }}</p>
        </div>
    @endforeach
</div>

@endSection
