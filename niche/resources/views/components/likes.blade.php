@props (['likes'])
<div id="likes-content">
    <p> likes goes here </p>
    <!--
@foreach($likes as $like)
        <div class="like">
            <p><strong>Liked Item:</strong> {{ $like->item_name ?? 'Placeholder Item' }}</p>
            <p><strong>Date Liked:</strong> {{ $like->created_at ?? 'Placeholder Date' }}</p>
        </div>
    @endforeach
-->
</div>