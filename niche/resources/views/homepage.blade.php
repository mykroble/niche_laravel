@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
    <div class="card">
        <div class="d-flex align-items-center">
            <img src="https://via.placeholder.com/50" class="rounded-circle mr-3" alt="Niche">
            <div class="m-4">
                <strong>Niche Title</strong> <small>idk</small>
            </div>
        </div>

        <p class="mt-3">My Experience at the mall</p>
        <div class="d-flex justify-content-start">
            <span>503 posts</span>
            <span>30 active</span>
            <span>25K visits</span>
            <span>371 Community Members</span>
        </div>
    </div>
</div>
@endsection