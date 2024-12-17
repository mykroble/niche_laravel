@extends('layouts.layout')

@section('title', 'My Bookmarks')

@section('content')
<div class="container my-4 text-white">
    <h3 class="text-white mb-4">My Bookmarks</h3>
    
    @foreach ($blogs as $blog)
        <div class="blog border p-3 mb-2 rounded" data-blog-id="{{ $blog->id }}">
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
            <button class="btn btn-sm btn-primary bookmark-btn" data-blog-id="{{ $blog->id }}">
                Remove Bookmark
            </button>
        </div>
        <hr>
    @endforeach
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