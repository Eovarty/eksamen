<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friend System</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <div class="search-container">
        <form action="search.php" method="GET">
        <h2>Friend System</h2>
            <input type="text" name="searchInput" placeholder="Search for a user...">
            <button type="submit" name="search-button">Search</button>
            <a href="view_requests.php" class="btn">View requests</a>
            <a href="chat.php" class="btn">Back to chat</a>
        </form>     
    </div>
    <div id="searchResults">
        <?php
        include 'search.php';
        ?>
    </div>
</body>
</html>
