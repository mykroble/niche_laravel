


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
            </div>
            <hr>
        @endforeach
        @endif
   
