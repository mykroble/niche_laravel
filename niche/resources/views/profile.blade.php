@extends('layouts.layout')

@section('loadAssets')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<script src="{{ asset('js/profile_modal.js') }}"></script>
@include('components.profile_modal_basic_info')
@endsection

@section('title', 'Niche Profile')

@section('content')
<div class="container">
    <!-- Profile Header -->
    <div class="profile-header border-bottom pb-3">
        
        <div class="position-relative">
            <img src="{{ asset('pics/banner.jpg') }}" class="img-fluid banner" alt="Banner">
            <img src="{{ asset(auth()->User()->icon_file_path) }}" class="profile-picture rounded-circle border border-white" alt="Profile Picture">
        </div>
        <div class="mt-4 text-light pt-4">
            <span class="">{{ $userDetails->display_name }}</span>
            <span class="text-light">@ {{ $userDetails->username }}</span>
            <ul class="list-inline text-light pt-2">
                <li class="list-inline-item"><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($userDetails->birthday)->format('d M Y') }}</li>
                <li class="list-inline-item"><strong>Age:</strong> {{ $userDetails->age ?? 'N/A' }}</li>
                <li class="list-inline-item"><strong>Gender:</strong> {{ $userDetails->gender }}</li>
            </ul>
            <button class="btn btn-outline-primary btn-sm" id="edit" data-bs-toggle="modal" data-bs-target="#modal_basic_info">Edit Profile</button>

        </div>
    </div>

    <!-- navigation -->
    <div class="profile-tabs mt-3 d-flex justify-content-around border-left">
        <button class="btn btn-link text-decoration-none text-light fw-bold border-x" onclick="loadPosts()" id="btn1">Posts</button>
        
    </div>

    <!-- Posts -->
    <div id="posts-content" class="mt-3 text-light">
        @if($blogs->isEmpty())
            <p class="text-center ">No posts found. Feel free to share something!</p>
        @else
            @foreach ($blogs as $blog)
                <a href="{{ route('viewBlog', ['value' => $blog->id]) }}" class="text-decoration-none text-light">
                    <div class="blog p-3 border-top" data-blog-id="{{ $blog->id }}">
                        <p class="mt-2">
                            {{ $blog->display_name }} 
                            <span class="text-secondary">@ {{ $blog->username }}</span>
                        </p>
                        <h5>{{ $blog->title }}</h5>
                        <div class="preview">{!! $blog->content !!}</div>
                        <div class="d-flex justify-content-start">
                        <button 
                            class="mt-2 px-2 btn btn-sm toggle-like {{ in_array($blog->id, $likedBlogIds) ? 'btn-danger' : 'btn-outline-danger' }}"
                            data-blog-id="{{ $blog->id }}"
                        >
                            {{ $likeCounts[$blog->id] ?? 0 }} Likes
                        </button>
                        </div>
                    </div>
                </a>
            @endforeach
        @endif
    </div>
 

    <!-- Likes Section -->
        
</div>

<script src="{{ asset('/js/profilescript.js') }}"></script>
@endsection

