const chatBox = document.getElementById('chat-box');
        const infoBox = document.getElementById('info');

        setInterval(() => {
            fetchMessages();
        }, 2000);

        function fetchMessages() {
            $.ajax({
                url: 'fetch_messages.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    chatBox.innerHTML = '';
                    data.forEach(msg => {
                        const div = document.createElement('div');
                        const sender_type = msg.sender_type === 'admin' ? 'Admin' : '<?php echo htmlspecialchars($user->name); ?>';
                        div.innerHTML = `<time>${msg.created_at}</time>: ${sender_type}: ${msg.message}`;
                        chatBox.appendChild(div);
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                },             
            });
        }

        function displayMessage(message) {
            infoBox.textContent = message;
            infoBox.style.opacity = 1;
            setTimeout(() => {
                infoBox.style.opacity = 0;
            }, 5000);
        }