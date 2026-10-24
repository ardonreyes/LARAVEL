@extends('layouts.main')
@section('content')
<div class="">
    @include('component.header')

    <div class="grid grid-cols-2 grid-rows-2 my-3 gap-2 md:grid-cols-4 md:grid-rows-none">
        <div class="card">
            <h4>Status:</h4>
            <p>Deployed</p>
        </div>
        <div class="card">
            <h4>Errors:</h4>
            <p>None</p>
        </div>
        <div class="card">
            <h4>Customers:</h4>
            <p>{{ $data['userCount'] }}</p>
        </div>
        <div class="card">
            <h4>Users:</h4>
            <p>{{ $data['userCount'] }}</p>
        </div>
    </div>
    
    <div class="grid grid-cols-2 grid-rows-[1fr_50px] gap-2 md:grid-cols-[repeat(auto-fit,minmax(150px,1fr))] animation_link-btn">
        <h3 class='col-span-full -mb-1'>Quick Actions</h3>
        <a href="{{ url('/users') }}" class="card quick_action-btn">
            <i class="fa-solid fa-users text-slate-600"></i>
            Customers
        </a>
        <a href="{{ url('/users') }}" class="card quick_action-btn">
            <i class="fa-solid fa-user-group text-slate-600"></i>
            Users
        </a>
    </div>
</div>
@endSection
