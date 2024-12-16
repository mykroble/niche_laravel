{{-- 
    @props(['likes'])

<div id="likes-content">
    @if($likes->isEmpty())
        <p>No likes found.</p>
    @else
        @foreach($likes as $like)
            <div class="like">
                <p><strong>Liked Item:</strong> {{ $like->item_name ?? 'Unknown Item' }}</p>
                <p><strong>Date Liked:</strong> {{ $like->created_at ?? 'Unknown date' }}</p>
            </div>
        @endforeach
    @endif
</div>
-- }}