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
            <h1>Hei</h1>
        </div>
        <div id="chat-container">
            <h2>Chat System</h2>
            <div id="chat-messages">
                <?php include 'fetch_messages.php'; ?>
            </div>
            <form action="send_message.php" method="post">
                <div id="message-container">
                    <textarea name="message" id="chat-input" placeholder="Type your message..."></textarea>
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
