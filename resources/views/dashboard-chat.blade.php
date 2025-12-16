<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Conversation - Full Screen</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-7.1.0-web/css/all.min.css') }}">
    
    <style>
        :root {
            /* Define a modern palette */
            --primary-color: #558b2f; /* Teal 600 */
            --secondary-bg: #f9fff5; /* Emerald 50 - light background for messages */
            --dark-text: #1F2937; /* Gray 800 */
        }

        body {
            background: #E5E7EB; /* Light gray background */
            font-family: 'Inter', sans-serif;
            /* Changed to align to top and center horizontally */
            display: flex;
            justify-content: center;
            /* Removed align-items: center to let container sit at the top */
            min-height: 100vh;
            padding: 1rem;
        }

        /* Custom Scrollbar */
        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background: #D1D5DB; /* Gray 300 */
            border-radius: 4px;
        }
        .chat-messages::-webkit-scrollbar-track {
            background: var(--secondary-bg);
        }

        /* Message Specific Styles */
        .chat-bubble {
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }

        .chat-header {
            position: sticky;
            top: 0;
        }
    </style>
</head>
<body>

<!-- Increased max-w-lg to max-w-4xl for a wider screen presence -->
<!-- Changed height to min-h-[95vh] to take up most of the vertical space -->
<div class="chat-container w-full max-w-4xl mx-auto bg-white rounded-xl shadow-2xl flex flex-col min-h-[95vh] overflow-hidden">

    <!-- Chat Header -->
    <div class="chat-header flex items-center p-4 border-b border-gray-200 bg-white sticky top-0 z-10">
        <!-- Back Button Mockup -->
        <a href="@if(auth()->user()->role === 'student')
                                        {{ route('student.dashboard') }}
                                    @else
                                        {{ route('tutor.dashboard') }}
                                    @endif" class="text-gray-500 hover:text-[var(--primary-color)] transition mr-3 p-2 rounded-full hover:bg-gray-100">
            <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <!-- Profile Picture -->
        <img 
            src="{{ asset($receiver) }}" 
            alt="{{ $receiver_name ?? 'Profile Picture' }}"
            class="w-12 h-12 rounded-full object-cover mr-3 border-2 border-[var(--primary-color)]"
        >
        <div class="flex flex-col">
            <div class="chat-name font-extrabold text-lg text-[var(--dark-text)]">{{ $receiver_name ?? "sup" }}</div>
            <div class="text-sm text-gray-500 flex items-center">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-1 animate-pulse"></span>
                Online
            </div>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="chat-messages flex-1 p-5 overflow-y-auto bg-[var(--secondary-bg)]" id="chatMessages">

        
        <!-- Received Message Example -->
        @forelse($messages as $message)
            @if($message->sender_id != auth()->user()->id)
                <div class="chat-message flex justify-start mb-4 " data-id="{{ $message->id }}">
                    <div class="max-w-[80%] md:max-w-[70%] flex flex-col items-start">
                        <div class="chat-bubble bg-white text-[var(--dark-text)] p-3 rounded-t-xl rounded-br-xl shadow-md">
                            {{ $message->message }}
                        </div>
                        <div class="chat-timestamp text-xs text-gray-500 mt-1 ml-2">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</div>
                    </div>
                </div>
            @else
                <div class="chat-message flex justify-end mb-4">
                    <div class="max-w-[80%] md:max-w-[70%] flex flex-col items-end">
                        <div class="chat-bubble bg-[var(--primary-color)] text-white p-3 rounded-t-xl rounded-bl-xl shadow-lg">
                            {{ $message->message }}
                        </div>
                        <div class="chat-timestamp text-xs text-gray-400 mt-1 mr-2">{{ \Carbon\Carbon::parse($message->created_at)->format('g:i A') }}</div>
                    </div>
                </div>
            @endif
    @empty
    <div class="text-center text-gray-500 mt-10" id="noMessages">
        No messages yet. Start the conversation!   
    </div> 
    @endforelse

       
    </div>

    <!-- Chat Input -->
    <div class="chat-input flex p-4 border-t border-gray-200 bg-white">
        <input 
            type="text" 
            id="messageInput" 
            placeholder="Type a message..."
            class="flex-1 border-2 border-gray-200 focus:border-[var(--primary-color)] focus:ring-1 focus:ring-[var(--primary-color)] rounded-full py-3 px-5 text-gray-700 transition duration-150 outline-none"
        >
        <button 
            onclick="sendMessage()"
            class="ml-3 w-12 h-12 bg-[var(--primary-color)] hover:bg-teal-700 text-white rounded-full flex items-center justify-center text-xl shadow-lg hover:shadow-xl transition duration-200 transform hover:scale-105"
        >
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>

    <input type="hidden" id="currentBookingId" name="currentBookingId" value="{{ $bookingId }}">
    <input type="hidden" id="senderId" name="senderId" value="{{ auth()->user()->id }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</div>

<script>
    
    let bookingId = document.getElementById('currentBookingId').value;
    let senderId = document.getElementById('senderId').value;
    let lastMessageId = 0;

// READ existing messages rendered by Blade
    document.querySelectorAll('#chatMessages .chat-message').forEach(msgDiv => {
        const msgId = parseInt(msgDiv.getAttribute('data-id'));
        if (msgId > lastMessageId) {
            lastMessageId = msgId;
        }
    });


    function getCurrentTime() {
        return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function sendMessage() 
    {

        let messageInput = document.getElementById('messageInput');
        let chatMessages = document.getElementById('chatMessages');
        const message = messageInput.value.trim();
        if(message === '') return;

        // Remove "no messages" placeholder if exists
        document.getElementById('noMessages')?.remove(); 

        // Optional: optimistically append the message to DOM
        const msgDiv = document.createElement('div');
        msgDiv.classList.add('chat-message', 'flex', 'justify-end', 'mb-4');
        
        const wrapper = document.createElement('div');
        wrapper.classList.add('max-w-[80%]', 'md:max-w-[70%]', 'flex', 'flex-col', 'items-end');

        const bubble = document.createElement('div');
        bubble.classList.add('chat-bubble', 'bg-[var(--primary-color)]', 'text-white', 'p-3', 'rounded-t-xl', 'rounded-bl-xl', 'shadow-lg');
        bubble.textContent = message;

        const timestamp = document.createElement('div');
        timestamp.classList.add('chat-timestamp', 'text-xs', 'text-gray-400', 'mt-1', 'mr-2');
        timestamp.textContent = getCurrentTime();

        wrapper.appendChild(bubble);
        wrapper.appendChild(timestamp);
        msgDiv.appendChild(wrapper);
        chatMessages.appendChild(msgDiv);

        chatMessages.scrollTop = chatMessages.scrollHeight;
        messageInput.value = '';
        messageInput.focus();

        // Send message to Laravel via AJAX
        bookingId = document.getElementById('currentBookingId').value; // conversation ID
        senderId = document.getElementById('senderId').value; // your user ID

        fetch('/messages/store', { // Make sure your route matches
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                booking_id: bookingId,
                sender_id: senderId,
                message: message
            })
        })
        .then(res => res.json())
        .then(data => {
            console.log('Message saved:', data);
            // You could optionally update the timestamp from server here
        })
        .catch(err => console.error('Error saving message:', err));

}


function appendMessage(msg) {
    if(msg.sender_id == senderId) return;

    const msgDiv = document.createElement('div');
    msgDiv.classList.add('chat-message','flex','justify-start','mb-4');

    const wrapper = document.createElement('div');
    wrapper.classList.add('max-w-[80%]','md:max-w-[70%]','flex','flex-col','items-start');

    const bubble = document.createElement('div');
    bubble.classList.add('chat-bubble','p-3','shadow-md','bg-white','text-[var(--dark-text)]','rounded-t-xl','rounded-br-xl');
    bubble.textContent = msg.message;

    const timestamp = document.createElement('div');
    timestamp.classList.add('chat-timestamp','text-xs','mt-1');
    timestamp.textContent = new Date(msg.created_at).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});

    wrapper.appendChild(bubble);
    wrapper.appendChild(timestamp);
    msgDiv.appendChild(wrapper);
    chatMessages.appendChild(msgDiv);

    chatMessages.scrollTop = chatMessages.scrollHeight;
    lastMessageId = Math.max(lastMessageId, msg.id);
}
// Example: append a random message every 3 seconds


function fetchMessages() {
    fetch(`/messages/fetch?booking_id=${bookingId}&last_id=${lastMessageId}`)
        .then(res => res.json())
        .then(messages => {
            if(messages.length && document.getElementById('noMessages')){
                document.getElementById('noMessages').remove();
            
            }
            messages.forEach(msg => {
                if(msg.id > lastMessageId) {
                  
                    appendMessage(msg);
                }
                
            });
        })
        .catch(err => console.error(err));
}



    document.addEventListener('DOMContentLoaded', () => {
       setInterval(fetchMessages, 3000); // Fetch new messages every second
        messageInput.focus();
    });
</script>

</body>
</html>