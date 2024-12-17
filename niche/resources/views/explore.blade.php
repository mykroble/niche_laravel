@extends('layouts.exploreLayout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
    <div class="card">
        @foreach ($blogs as $blog)
        <div class="blog-container">
            <div class="h-100 w-100 d-flex justify-content-between channel">
                <div class="d-flex">
                    <div class="image-container">
                        <img src="{{ asset('pics/channel-icon.svg') }}" class="channel-icon">
                    </div>
                    <p class="m-auto p-1">{{ $blog->channelTitle }}</p>
                </div>
                <form action="{{ route('channel.join') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $blog->channelId }}" name="channel-id">
                    <button type="submit" class="btn btn-success btn-sm">Join</button>
                </form>
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