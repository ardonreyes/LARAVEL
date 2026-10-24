@extends('layouts.main')
@section('content')

<div class="md:grid md:grid-cols-2 md:gap-2">
    @include('component.header')

    @foreach ($data as $key)
        <div class="card my-3 md:my-0">
            <h4>{{ $key['full_name'] }}</h4>
            <p>{{ $key['email'] }}</p>
            <p>{{ $key['phone'] }}</p>
        </div>
    @endforeach
</div>

@endSection
