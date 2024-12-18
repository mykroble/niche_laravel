@extends('layouts.layout')

@section('title', 'Messages')

@section('content')
<div class="d-flex bg-dark flex-column align-items-center main-content py-3 text-light">
  <div class="container-fluid chat-container">
    <div class="row w-100">
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-12 sidebar p-3" style="height: 80vh; overflow-y: auto;">
        <ul class="list-group chat-list" id="chat-users">
          @foreach ($users as $user)
            <li class="list-group-item d-flex align-items-center user-item" data-user-id="{{ $user->id }}">
              <img src="{{ asset($user->icon_file_path) }}" alt="{{ $user->display_name }}" class="rounded-circle me-3" width="40" height="40">
              <div>
                <strong>{{ $user->display_name }}</strong>
                <p class="mb-0 text-muted" style="font-size: 0.85rem;" id="last-message-{{ $user->id }}">
                  @php
                    
                    $lastMessage = $messages->where('receiver_id', $user->id)->last()?->message ?? 'No recent messages';
                  @endphp
                  {{ $lastMessage }}
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>

      
      <!-- Chat Section -->
      <div class="col-md-8 col-sm-12 chat-section d-flex flex-column">
        <div class="chat-header p-3 border-bottom d-flex align-items-center">
          @if ($currentUser)
            <img src="{{ asset($currentUser->icon_file_path) }}" alt="{{ $currentUser->display_name }}" class="rounded-circle me-3" width="40" height="40">
            <h5 class="mb-0">{{ $currentUser->display_name }}</h5>
          @endif
        </div>

        <div class="messages flex-grow-1 p-3 overflow-auto" id="chat-messages" style="max-height:70vh;">
          @foreach ($messages as $message)
            <div class="message {{ $message->sender_id == Auth::id() ? 'user' : 'other' }} mb-3" data-message-id="{{ $message->id }}">
              <p class="{{ $message->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-dark text-white' }} p-2 rounded">
                {{ $message->message }}
              </p>
            </div>
          @endforeach
        </div>

        <div class="input-section p-3 border-top d-flex align-items-center">
          <form id="message-form">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $currentUser->id }}">
            <input type="text" name="message" class="form-control me-2 rounded-pill" placeholder="Type a message..." required id="message-input">
            <button type="submit" class="btn btn-primary rounded-pill">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function () {
    // Handle user item click to load messages dynamically
    $('.user-item').on('click', function () {
      var userId = $(this).data('user-id'); // Get the clicked user's ID

      // Send AJAX request to fetch messages for the selected user
      $.ajax({
        url: "{{ route('message.user') }}", // Create this route for fetching user messages
        type: "GET",
        data: { user_id: userId },
        success: function (response) {
          // Update the chat header
          var chatHeader = `
            <img src="${response.user_image}" alt="${response.user_name}" class="rounded-circle me-3" width="40" height="40">
            <h5 class="mb-0">${response.user_name}</h5>
          `;
          $('.chat-header').html(chatHeader);

          // Clear the previous messages and load new ones
          var messagesHTML = '';
          response.messages.forEach(function (message) {
            var senderClass = message.sender_id === {{ Auth::id() }} ? 'user' : 'other';
            var messageClass = senderClass === 'user' ? 'bg-primary text-white' : 'bg-dark text-white';
            messagesHTML += `
              <div class="message ${senderClass} mb-3">
                <p class="${messageClass} p-2 rounded">${message.message}</p>
              </div>
            `;
          });
          
          $('#chat-messages').html(messagesHTML);

          // Update the hidden input for receiver_id
          $('input[name="receiver_id"]').val(userId);

          // Scroll to the bottom of the messages
          $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        },
        error: function (xhr, status, error) {
          console.error("Failed to fetch messages:", error);
          alert("Unable to load messages.");
        },
      });
    });
  });
  // Send message via AJAX
  $('#message-form').on('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    var formData = {
      '_token': $('input[name="_token"]').val(),
      'receiver_id': $('input[name="receiver_id"]').val(),
      'message': $('#message-input').val()
    };

    $.ajax({
      url: "{{ route('message.store') }}", // Your route to store the message
      type: 'POST',
      data: formData,
      success: function(response) {
  // Append new message to chat
  var message = response.message;
  var sender = message.sender_id === {{ Auth::id() }} ? 'user' : 'other';
  var messageHTML = '<div class="message ' + sender + ' mb-3" data-message-id="' + message.id + '">' +
                    '<p class="' + (sender === 'user' ? 'bg-primary text-white' : 'bg-dark text-white') + ' p-2 rounded">' +
                    message.message +
                    '</p></div>';

  // Append to messages container
  $('#chat-messages').append(messageHTML);

  // Update last message in sidebar
  if (message.receiver_id === {{ Auth::id() }}) {
    $('#last-message-' + message.sender_id).text(message.message);  // sender_id = last message's sender
  } else {
    $('#last-message-' + message.receiver_id).text(message.message);  // receiver_id = last message's receiver
  }

  // Scroll to the bottom of the messages
  $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);

  // Clear the input field
  $('#message-input').val('');
},
      error: function(xhr, status, error) {
        console.error("Message sending failed:", error);
        alert('There was an error sending the message.');
      }
    });
  });

  // Listen for new messages every 5 seconds
  setInterval(function() {
  var lastMessageId = $('#chat-messages .message').last().data('message-id');

  if (lastMessageId) {
    $.ajax({
      url: "{{ route('message.new') }}", // Your route to fetch new messages
      type: 'GET',
      data: { last_message_id: lastMessageId },
      success: function(response) {
        if (response.length > 0) {
          response.forEach(function(message) {
            var sender = message.sender_id === {{ Auth::id() }} ? 'user' : 'other';
            var messageHTML = '<div class="message ' + sender + ' mb-3" data-message-id="' + message.id + '">' +
                              '<p class="' + (sender === 'user' ? 'bg-primary text-white' : 'bg-dark text-white') + ' p-2 rounded">' +
                              message.message +
                              '</p></div>';

            // Append to messages container
            $('#chat-messages').append(messageHTML);

            // Update last message in sidebar
            if (message.receiver_id === {{ Auth::id() }}) {
              $('#last-message-' + message.sender_id).text(message.message);
            } else {
              $('#last-message-' + message.receiver_id).text(message.message);
            }
          });

          // Scroll to the bottom of the messages
          $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        }
      },
      error: function(xhr, status, error) {
        console.error("Failed to fetch new messages:", error);
      }
    });
  }
}, 1000); // Poll every 2.5 seconds for new messages

</script>

@endsection
