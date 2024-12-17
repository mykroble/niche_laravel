@extends('layouts.layout')

@section('loadAssets')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<script src="{{ asset('js/profile_modal.js') }}"></script>
@include('components.profile_modal_basic_info')
@endsection

@section('title', 'Niche Profile')

@section('content')
<div class="container mt-4">
    <!-- Profile Header -->
    <div class="profile-header border-bottom pb-3">
        
        <div class="position-relative">
            <img src="{{ asset('pics/banner.jpg') }}" class="img-fluid banner" alt="Banner">
            <img src="{{ asset('pics/profile.jpg') }}" class="profile-picture rounded-circle border border-white" alt="Profile Picture">
        </div>
        <div class="mt-4 text-light">
            <h5 class="mb-1">{{ $userDetails->display_name }}</h5>
            <p class="text-light">@ {{ $userDetails->username }}</p>
            <ul class="list-inline text-light">
                <li class="list-inline-item"><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($userDetails->birthday)->format('d M Y') }}</li>
                <li class="list-inline-item"><strong>Age:</strong> {{ $userDetails->age ?? 'N/A' }}</li>
                <li class="list-inline-item"><strong>Gender:</strong> {{ $userDetails->gender }}</li>
            </ul>
            <button class="btn btn-outline-primary btn-sm" id="edit" onclick="openModal(1)">Edit Profile</button>
        </div>
    </div>

    <!-- navigation -->
    <div class="profile-tabs mt-3 d-flex justify-content-around border-left">
        <button class="btn btn-link text-decoration-none text-light fw-bold border-x" onclick="openposts()" id="btn1">Posts</button>
        <button class="btn btn-link text-decoration-none text-light" onclick="openlikes()" id="btn2">Likes</button>
    </div>

    <!-- Posts -->
    <div id="posts-content" class="mt-3 text-light">
        @if($blogs->isEmpty())
            <p class="text-center ">No posts found. Feel free to share something!</p>
        @else
            @foreach ($blogs as $blog)
                <a href="{{ route('viewBlog', ['value' => $blog->id]) }}" class="text-decoration-none text-light">
                    <div class="blog border p-3 rounded" data-blog-id="{{ $blog->id }}">
                        <p class="mt-2">
                            {{ $blog->display_name }} 
                            <span class="text-secondary">@ {{ $blog->username }}</span>
                        </p>
                        <h5>{{ $blog->title }}</h5>
                        <div class="preview">{!! $blog->content !!}</div>
                        <div class="d-flex justify-content-start">
                            <span class="px-3 mt-2 "><i class="bi bi-heart"></i> 5 Likes</span>
                            <span class="px-3 mt-2 "><i class="bi bi-people"></i> 10 Community Members</span>
                           
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>

    <!-- Likes Section -->
    <div id="likes-content" class="d-none mt-3">
        <!-- need likes here -->
    </div>
</div>

<script src="{{ asset('/js/profilescript.js') }}"></script>
@endsection

@if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif
