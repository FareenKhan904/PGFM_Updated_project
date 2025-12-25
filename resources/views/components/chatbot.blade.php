<!-- Chatbot Component -->
<div id="chatbot-container">
    <!-- Chatbot Icon Button -->
    <button id="chatbot-toggle" class="chatbot-icon-btn" title="Ask a question">
        <i class="fas fa-comments"></i>
        <span class="chatbot-notification" id="chatbot-notification"></span>
    </button>
    
    <!-- Chatbot Window -->
    <div id="chatbot-window" class="chatbot-window">
        <div class="chatbot-header">
            <div class="d-flex align-items-center">
                <div class="chatbot-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="ms-2">
                    <h6 class="mb-0 fw-bold">PGIFM Assistant</h6>
                    <small class="text-muted">Ask me anything about your courses</small>
                </div>
            </div>
            <button id="chatbot-close" class="chatbot-close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="chatbot-messages" id="chatbot-messages">
            <div class="chatbot-message bot-message">
                <div class="message-content">
                    <p class="mb-0">Hello! I'm your PGIFM assistant. I can help you with information about your enrolled courses, classes, materials, and library resources. How can I assist you today?</p>
                </div>
            </div>
        </div>
        
        <div class="chatbot-input-area">
            <div class="input-group">
                <input type="text" id="chatbot-input" class="form-control" placeholder="Type your message..." autocomplete="off">
                <button id="chatbot-send" class="btn btn-send">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <small class="text-muted d-block mt-2">
                <i class="fas fa-info-circle me-1"></i>Powered by Gemini AI
            </small>
        </div>
    </div>
</div>

<style>
#chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
}

.chatbot-icon-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.chatbot-icon-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
}

.chatbot-notification {
    position: absolute;
    top: -5px;
    right: -5px;
    width: 20px;
    height: 20px;
    background: #ef4444;
    border-radius: 50%;
    display: none;
    font-size: 10px;
    color: white;
    align-items: center;
    justify-content: center;
}

.chatbot-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    max-width: calc(100vw - 40px);
    height: 600px;
    max-height: calc(100vh - 100px);
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: none;
    flex-direction: column;
    overflow: hidden;
}

.chatbot-window.active {
    display: flex;
}

.chatbot-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.chatbot-close-btn {
    background: transparent;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 5px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.chatbot-close-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.chatbot-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    background: #f8fafc;
}

.chatbot-message {
    margin-bottom: 1rem;
    display: flex;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chatbot-message.user-message {
    justify-content: flex-end;
}

.chatbot-message.bot-message {
    justify-content: flex-start;
}

.message-content {
    max-width: 80%;
    padding: 0.75rem 1rem;
    border-radius: 15px;
    word-wrap: break-word;
}

.user-message .message-content {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border-bottom-right-radius: 5px;
}

.bot-message .message-content {
    background: white;
    color: #1f2937;
    border: 1px solid #e5e7eb;
    border-bottom-left-radius: 5px;
}

.chatbot-input-area {
    padding: 1rem;
    background: white;
    border-top: 1px solid #e5e7eb;
}

.chatbot-input-area .input-group {
    display: flex;
    gap: 0.5rem;
}

.chatbot-input-area .form-control {
    border: 1px solid #e5e7eb;
    border-radius: 25px;
    padding: 0.75rem 1rem;
    font-size: 14px;
}

.chatbot-input-area .form-control:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
}

.btn-send {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-send:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.btn-send:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: #f8fafc;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 10px;
}

/* Loading indicator */
.typing-indicator {
    display: flex;
    gap: 5px;
    padding: 0.75rem 1rem;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%, 60%, 100% {
        transform: translateY(0);
    }
    30% {
        transform: translateY(-10px);
    }
}

@media (max-width: 768px) {
    .chatbot-window {
        width: calc(100vw - 20px);
        right: 10px;
        bottom: 90px;
    }
    
    #chatbot-container {
        bottom: 15px;
        right: 15px;
    }
    
    .chatbot-icon-btn {
        width: 55px;
        height: 55px;
        font-size: 22px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const chatbotMessages = document.getElementById('chatbot-messages');
    
    // Toggle chatbot window
    toggleBtn.addEventListener('click', function() {
        chatbotWindow.classList.toggle('active');
        if (chatbotWindow.classList.contains('active')) {
            chatbotInput.focus();
        }
    });
    
    closeBtn.addEventListener('click', function() {
        chatbotWindow.classList.remove('active');
    });
    
    // Send message
    function sendMessage() {
        const message = chatbotInput.value.trim();
        if (!message) return;
        
        // Add user message to chat
        addMessage(message, 'user');
        chatbotInput.value = '';
        
        // Show typing indicator
        const typingId = showTypingIndicator();
        
        // Disable input
        chatbotInput.disabled = true;
        chatbotSend.disabled = true;
        
        // Send to backend
        fetch('{{ route("chatbot.chat") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error || 'Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            removeTypingIndicator(typingId);
            
            if (data.success) {
                addMessage(data.reply, 'bot');
            } else {
                const errorMsg = data.error || 'Sorry, I encountered an error. Please try again later.';
                addMessage(errorMsg, 'bot');
                console.error('Chatbot error:', data);
            }
        })
        .catch(error => {
            removeTypingIndicator(typingId);
            let errorMsg = 'Sorry, I encountered an error. Please try again later.';
            
            if (error.message) {
                if (error.message.includes('API key')) {
                    errorMsg = 'Chatbot API key not configured. Please contact the administrator.';
                } else if (error.message.includes('Connection')) {
                    errorMsg = 'Connection error. Please check your internet connection.';
                } else {
                    errorMsg = error.message;
                }
            }
            
            addMessage(errorMsg, 'bot');
            console.error('Chatbot fetch error:', error);
        })
        .finally(() => {
            chatbotInput.disabled = false;
            chatbotSend.disabled = false;
            chatbotInput.focus();
        });
    }
    
    // Add message to chat
    function addMessage(text, type) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${type}-message`;
        
        const contentDiv = document.createElement('div');
        contentDiv.className = 'message-content';
        
        const p = document.createElement('p');
        p.className = 'mb-0';
        p.textContent = text;
        
        contentDiv.appendChild(p);
        messageDiv.appendChild(contentDiv);
        chatbotMessages.appendChild(messageDiv);
        
        // Scroll to bottom
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }
    
    // Show typing indicator
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'chatbot-message bot-message typing-indicator';
        typingDiv.id = 'typing-' + Date.now();
        
        typingDiv.innerHTML = '<span></span><span></span><span></span>';
        chatbotMessages.appendChild(typingDiv);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        
        return typingDiv.id;
    }
    
    // Remove typing indicator
    function removeTypingIndicator(id) {
        const typingDiv = document.getElementById(id);
        if (typingDiv) {
            typingDiv.remove();
        }
    }
    
    // Send on button click
    chatbotSend.addEventListener('click', sendMessage);
    
    // Send on Enter key
    chatbotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
});
</script>

