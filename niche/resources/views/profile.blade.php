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
    <button id="edit" onclick="openModal(1)">edit</button>
</div>
@endsection
    <!-- <button id="edit" onclick="openModal(1)">edit</button> -->