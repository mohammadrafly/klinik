<?= $this->extend('layout/HomeLayout') ?>

<?= $this->section('content') ?>
    <!-- Hotline Area Starts -->
    <section class="hotline-area text-center section-padding">
        <div class="container">
            <div class="row">
                <!-- User List -->
                <div class="col-md-3">
                    <ul class="user-list">
                        <?php foreach($users as $data): ?>
                            <li class="user" data-id="<?= $data['id'] ?>" data-user="<?= $data['name'] ?>"><?= $data['name'] ?></li>
                        <?php endforeach ?>
                        <!-- Add more users here -->
                    </ul>
                </div>

                <!-- Chat Box -->
                <div class="col-md-9">
                    <div class="chat-box">
                        <div class="chat-messages">
                            <!-- Chat messages will be displayed here -->
                        </div>
                        <!-- Add chat input and send button here -->
                        <div class="chat-input">
                            <input type="text" id="message-input" placeholder="Type your message...">
                            <button type="button" id="send-button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hotline Area End -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userList = document.querySelectorAll('.user');
        const chatMessages = document.querySelector('.chat-messages');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-button');

        userList.forEach(function(user) {
            user.addEventListener('click', function() {
                const selectedUser = this.dataset.user;
                const senderId = 1; // Assuming you have the logged-in user's ID in the session
                const receiverId = this.dataset.id;

                userList.forEach(function(user) {
                    user.classList.remove('active');
                });

                this.classList.add('active');

                loadChat(senderId, receiverId);
            });
        });

        sendButton.addEventListener('click', function() {
            const message = messageInput.value.trim();
            if (message !== '') {
                const selectedUser = document.querySelector('.user.active');
                const receiverId = selectedUser.dataset.id;
                sendMessage(message, receiverId);
                messageInput.value = '';
            }
        });

        function sendMessage(message, receiverId) {
            const data = {
                message: message,
                receiver_id: receiverId,
                sender_id: <?= session()->get('id') ?> // Assuming you have the logged-in user's ID in the session
            };

            $.ajax({
                type: 'POST',
                url: `${base_url}chat/send`, // Update the URL based on your server route
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    // Handle the success response, if needed
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        }

        function loadChat(senderId, receiverId) {
            $.ajax({
                type: 'GET',
                url: `${base_url}chat/message`, // Update the URL based on your server route
                data: {
                    sender_id: senderId,
                    receiver_id: receiverId
                },
                success: function(response) {
                    chatMessages.innerHTML = ''; // Clear existing messages

                    response.forEach(function(message) {
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('message');

                        if (message.sender_id == <?= session()->get('id') ?>) {
                            messageElement.classList.add('sent');
                        } else {
                            messageElement.classList.add('received');
                        }

                        messageElement.textContent = message.message;
                        chatMessages.appendChild(messageElement);
                    });
                },
                error: function(error) {
                    // Handle the error response, if needed
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>
