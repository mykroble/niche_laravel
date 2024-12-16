@extends('layouts.layout')

@section('title', 'Messages')

@section('content')
<div class="d-flex bg-dark flex-column align-items-center main-content py-3 text-light">
  <div class="container-fluid chat-container">
    <div class="row w-100">
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-12 sidebar p-3">
        <ul class="list-group chat-list">
          @foreach ($users as $user)
            <li class="list-group-item d-flex align-items-center">
              <img src="{{ asset('images/user1.jpg') }}" alt="{{ $user->display_name }}" class="rounded-circle me-3" width="40" height="40">
              <div>
                <strong>{{ $user->display_name }}</strong>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                  @if ($user->id == $groupedMessages->keys()->first())  <!-- Check if user has messages -->
                    {{ $groupedMessages->first()->last()->message }}
                  @else
                    No recent messages
                  @endif
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      
      <!-- Chat Section -->
      <div class="col-md-8 col-sm-12 chat-section d-flex flex-column">
        <div class="chat-header p-3 border-bottom d-flex align-items-center">
            @if ($groupedMessages->first())
                @php $currentUser = $users->find($groupedMessages->keys()->first()); @endphp
                @if ($currentUser)
                    <img src="{{ asset('pics/pottery.jpeg') }}" alt="{{ $currentUser->display_name }}" class="rounded-circle me-3" width="40" height="40">
                    <h5 class="mb-0">{{ $currentUser->display_name }}</h5>
                @endif
            @endif
        </div>

        <div class="messages flex-grow-1 p-3 overflow-auto">
          @foreach($groupedMessages as $messages)
            @foreach ($messages as $message)
              <div class="message {{ $message->sender_id == Auth::id() ? 'user' : 'other' }} mb-3">
                <p class="{{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-dark text-white' }} p-2 rounded">
                  {{ $message->message }}
                </p>
              </div>
            @endforeach
          @endforeach
        </div>

        <div class="input-section p-3 border-top d-flex align-items-center">
        <form action="{{ route('message.store') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $currentUser->id }}">
            <input type="text" name="message" class="form-control me-2 rounded-pill" placeholder="Type a message..." required>
            <button type="submit" class="btn btn-primary rounded-pill">Send</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection