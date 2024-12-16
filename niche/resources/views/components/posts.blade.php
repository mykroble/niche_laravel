@props (['posts'])
<div id="posts-content">
    <p> This is posts</p>
    <!-- 
@foreach($posts as $post)
        <div class="post">
            <p><strong>Title:</strong> {{ $post->title ?? 'Placeholder Title' }}</p>
            <p><strong>Content:</strong> {{ $post->content ?? 'Placeholder Content' }}</p>
        </div>
    @endforeach
-->
</div>
