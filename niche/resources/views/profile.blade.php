@extends('layouts.layout')

@section('loadAssets')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('js/profile_modal.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}" type="text/css">
@include('components.profile_modal_basic_info')
@endsection

@section('title', 'Niche Profile')

@section('content')
<div class="myBody">
    <div class="section1">
        <img src="{{ asset('pics/banner.jpg') }}" class="img-fluid banner" style="width: 100%; height:auto;">
    </div>
    <div class="profile-details">
        <ul>
            <li><strong>Username:</strong> {{ $userDetails->username }}</li>
            <li><strong>Email:</strong> {{ $userDetails->email }}</li>
            <li><strong>Display Name:</strong> {{ $userDetails->display_name }}</li>
            <li><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($userDetails->birthday)->format('d/m/Y') }}</li>
            <li><strong>Age:</strong> {{ $userDetails->age ?? 'Age not available' }}</li>
            <li><strong>Gender:</strong> {{ $userDetails->gender }}</li>
        </ul>
        <button id="edit" onclick="openModal(1)">Edit</button>
    </div>
    <div class="buttonsection">
        <button class="btn" id="btn1" name="posts_btn" onclick="openposts()">Posts</button>
        <button class="btn" id="btn2" name="likes_btn" onclick="openlikes()">Likes</button>
        <div class="underline"></div>
    </div>

    <!-- Posts Section -->
    <div id="posts-content">
    @if($blogs->isEmpty())
            <p>No posts found. Feel free to share something!</p>
        @else
        @foreach ($blogs as $blog)
            <div class="blog" data-blog-id="{{ $blog->id }}">
                <p class="mt-2">
                    {{ $blog->display_name ?? 'Unknown Author' }} 
                    <span class="text-secondary">@ {{ $blog->username ?? 'Unknown Username' }}</span>
                </p>
                <h5>{{ $blog->title }}</h5>
                <div class="preview">{!! $blog->content !!}</div>
                <div class="d-flex justify-content-start">
                    <span class="px-3">5 likes</span>
                    <span>10 Community Members</span>
                </div>
                        <!-- Delete button -->
        <form action="{{ route('posts.delete', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
            </div>
            <hr>
        @endforeach
        @endif



    </div>

    <!-- Likes Section (currently commented out) -->
    <div id="likes-content" class="hidden">
        {{-- 
        @include('components.likes', ['likes' => $likes])
        --}}
    </div>


</div>
<script src="{{ asset('/js/profilescript.js') }}"></script>
@endsection
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
