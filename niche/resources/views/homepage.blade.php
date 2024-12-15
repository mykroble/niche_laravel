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
        @foreach ($blogs as $blog)
            <div class="blog" data-blog-id="{{ $blog->id }}">
                <p class="mt-2">
                    {{ $blog->display_name }} 
                    <span class="text-secondary">@ {{ $blog->username }}</span>
                </p>
                <h5>{{ $blog->title }}</h5>
                <!-- <div class="preview">{!! $blog->content !!}</div> -->
                    <div class="d-flex justify-content-start">
                        <span class="px-3">5 likes</span>
                        <span>10 Community Members</span>
                    </div>
            </div>
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