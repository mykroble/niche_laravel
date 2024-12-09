@extends('layouts.layout')
@section('loadAssets')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css">
<script src = "{{asset('js/profile_modal.js')}}"></script>
@include('components.profile_modal_basic_info')
@endsection

@section('title', 'Niche Profile')

@section('content')
<div class="myBody">
    <div class="section1">
        <img src="{{asset('pics/banner.jpg')}}" class="img-fluid banner" style="width: 100% height:auto">
    </div>
    <div class ="profile details">make php logic here for getting profile details</div>
    <div class="buttonsection">
    <button class="btn" id="btn1" name="posts_btn" onclick = "openposts()">Button 1</button>
    <button class="btn" id="btn2" name="likes_btn"onclick = "openlikes()">Button 2</button>
    <div class="underline"></div>
</div>
<div id = "contente-container">content for the buttons go here
<div id="posts-content" class="hidden">
        @component('components.posts') @endcomponent
    </div>
    <div id="likes-content" class="hidden">
        @component('components.likes') @endcomponent
    </div>
</div>
    <button id="edit" onclick="openModal(1)">edit</button>
</div>
<script src="{{ asset('/js/profilescript.js') }}"></script>
@endsection
    <!-- <button id="edit" onclick="openModal(1)">edit</button> -->