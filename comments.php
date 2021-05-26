<html lang="en">
<style>
    <?php include "CSS/style.css" ?>
</style>
<head>
    <?php include ("Shared/navbar.xhtml"); ?>
    <title>College Events - Home Page</title>
</head>
<body>

<h1>Important Information</h1>
<p>This page lets students view comments and comment on events.<br>Only events you have access to can be commented on.</p>

<h1>View Comments on an Event</h1>
<form action="PHP_Scripts/viewcomments.php" method="post">
    <h2>User Credentials:</h2>
    <label for="student_username">Username:</label>
    <input type="text" id="student_username" name="student_username" required><br><br>
    <label for="student_password">Password:</label>
    <input type="password" id="student_password" name="student_password" required><br><br>
    <label for="event_id">Event ID:</label>
    <input type="text" id="event_id" name="event_id" required><br><br>
    <input type="submit" name="submit" value="submit">
</form><br><br>

<h1>Comment on an Event</h1>
<form action="PHP_Scripts/comment.php" method="post">
    <h2>User Credentials:</h2>
    <label for="student_username">Username:</label>
    <input type="text" id="student_username" name="student_username" required><br><br>
    <label for="student_password">Password:</label>
    <input type="password" id="student_password" name="student_password" required><br><br>
    <h2>Comment Details:</h2>
    <label for="event_id">Event ID:</label>
    <input type="text" id="event_id" name="event_id" required><br><br>
    <label for="event_rating">Rating:</label>
    <select name="event_rating" id="event_rating" required>
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
    </select><br><br>
    <label for="event_comment">Comment:</label>
    <input type="text" id="event_comment" name="event_comment" required><br><br>
    <input type="submit" name="submit" value="submit">
</form><br><br>

<h1>Modify or Delete Comment</h1>
<form action="PHP_Scripts/modifycomment.php" method="post">
    <h2>User Credentials:</h2>
    <label for="student_username">Username:</label>
    <input type="text" id="student_username" name="student_username" required><br><br>
    <label for="student_password">Password:</label>
    <input type="password" id="student_password" name="student_password" required><br><br>
    <h2>Comment Details:</h2>
    <label for="comment_id">Comment ID:</label>
    <input type="text" id="comment_id" name="comment_id" required><br><br>
    <label for="action">Action:</label>
    <select name="action" id="action"
            onchange=
            "if (this.value=='Modify') {
                document.getElementById('new_rating').disabled = false;
                document.getElementById('new_comment').disabled = false;
                document.getElementById('new_rating').required = true;
                document.getElementById('new_comment').required = true;
            }
            else {
                document.getElementById('new_rating').disabled = true;
                document.getElementById('new_comment').disabled = true;
                document.getElementById('new_rating').required = false;
                document.getElementById('new_comment').required = false;
            }"
            required>
        <option value="Modify" selected>Modify</option>
        <option value="Delete">Delete</option>
    </select><br><br>
    <label for="new_rating" id="new_rating_label">Modify Rating:</label>
    <select name="new_rating" id="new_rating">
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
    </select><br><br>
    <label for="new_comment" id="new_comment_label">Modify Comment:</label>
    <input type="text" id="new_comment" name="new_comment"><br><br>
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>