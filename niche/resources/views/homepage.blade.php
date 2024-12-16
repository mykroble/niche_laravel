@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
    @if(count($channels) > 0)
    <div class="card">
        <div class="channels-section my-4">
            <h4 class="text-white">Channels</h4>
            <div class="row flex-nowrap overflow-auto" style="white-space: nowrap;">
                @foreach ($channels as $channel)
                <a href="{{ route('homepage', ['channel_id' => $channel->id]) }}" 
                    class="col-auto bg-warning channel border p-3 mb-2 rounded mx-2 {{ $selectedChannelId == $channel->id ? 'bg-secondary text-white' : '' }}"
                    style="flex: 0 0 auto;">
                    <strong>{{ $channel->title }}</strong>
                </a>
                @endforeach
            </div>
        </div>
        @foreach ($blogs as $blog)
        <div class="blog-container">
            <div class="h-100 w-100 d-flex justify-content-between channel">
                <div class="d-flex">
                    <div class="image-container">
                        <img src="{{ asset('pics/pet-grooming.png') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1">{{ $blog->channelTitle }}</p>
                </div>
            </div>
            <div class="blog" data-blog-id="{{ $blog->id }}">
                <p class="mt-2">
                    {{ $blog->display_name }}
                    <span class="text-secondary">@ {{ $blog->username }}</span>
                </p>
                <h5>{{ $blog->title }}</h5>
                <div class="preview">{!! $blog->content !!}</div>
                <div class="d-flex justify-content-start">
                    <span class="px-3">5 likes</span>
                    <span>10 Community Members</span>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    @else
    <p class="display-1 no-channel-display">You do not have any channels yet. Find more in <a href="{{route('explore')}}">Explore</a></p>
    @endif
</div>
<script>

    const blogs = document.querySelectorAll('.blog');
    blogs.forEach(blog => {
        blog.addEventListener('click', function(event){
            let id = blog.dataset.blogId;
            console.log('clicked' + id);
            var url = "{{ route('viewBlog', ['value' => 'blogId']) }}".replace('blogId', id);
            window.location.href = url;
        })
    });

</script>
@endsection