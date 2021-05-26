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
<p>This page lets students view and comment on events.<br>Only events you have access to can be seen.</p>

<h1>View Events</h1>
<form action="PHP_Scripts/events.php" method="post">
    <h2>User Credentials:</h2>
    <label for="student_username">Username:</label>
    <input type="text" id="student_username" name="student_username" required><br><br>
    <label for="student_password">Password:</label>
    <input type="password" id="student_password" name="student_password" required><br><br>
    <input type="submit" name="submit" value="submit">
</form><br><br>

</body>
</html>