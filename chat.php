<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
    <link rel="stylesheet" href="chatstyle.css">
</head>
<body>
    <div id="container1">
        <div id="side-container">
            <div class="dropdown">
                <button class="dropbtn">Meny</button>
                <div class="dropdown-content">
                    <a href="login.html">Login</a>
                    <a href="friend.php">Friends</a>
                    <a href="FAQ.html">FAQ</a>
                    <a href="contact.html">Contact us</a>
                    <a href="friendlist.php">friendlist</a>
                    <a href="delete.php">Delete users</a>
                </div>
            </div>
            <div id="friendlist">
                <?php include 'friendlist.php'; ?>
            </div>
        </div>
        <div id="chat-container">
            <h2>Chat System</h2>
            <div id="chat-messages">
                <?php include 'fetch_messages.php'; ?>
            </div>
            <p id="scrollTarget"></p>
            <form action="send_message.php" method="post">
                <div id="message-container">
                    <textarea name="message" id="chat-input" placeholder="Type your message..."></textarea>
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // After the content is loaded, scroll to the bottom of the chat-messages div
        window.addEventListener('load', function() {
            var chatMessages = document.getElementById('chat-messages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    </script>
</body>
</html>
