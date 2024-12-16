@extends('layouts.layout')
@section('loadAssets')
<link rel="stylesheet" href="{{asset('css/homepage.css')}}" type="text/css">
@endsection

@section('title', 'Niche')

@section('content')

<div class="d-flex bg-dark flex-column align-items-center main-content">
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