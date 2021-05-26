<html lang="en" xmlns="http://www.w3.org/1999/html">
<style>
    <?php include "CSS/style.css" ?>
</style>
<head>
    <?php include ("Shared/navbar.xhtml"); ?>
    <title>College Events - Register</title>
</head>
<body>

<h1>Important Information</h1>
<p>If an RSO has less than 5 members, it will be considered inactive!</p>
<p>When an RSO meets the activation threshold (of 5 members),<br>it will be activated and assigned an administrator.</p>
<p>If your institution does not exist,<br>please go to the Register School page to create the institution and its SuperAdministrator!</p>

<form action="PHP_Scripts/register.php" method="post">
    <h2>User Credentials:</h2>
    <label for="new_username">Username:</label>
    <input type="text" id="new_username" name="new_username" required><br><br>
    <label for="new_password">Password:</label>
    <input type="password" id="new_password" name="new_password" required><br><br>
    <label for="new_university">Associated University:</label>
    <input type="text" id="new_university" name="new_university" required><br><br>
    <label for="new_rso">Associated RSO:</label>
    <input type="text" id="new_rso" name="new_rso" required><br><br>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>
