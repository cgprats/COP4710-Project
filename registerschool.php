<html lang="en">
<style>
    <?php include "CSS/style.css" ?>
</style>
<head>
    <?php include ("Shared/navbar.xhtml"); ?>
    <title>College Events - Register School</title>
</head>
<body>

<h1>Important Information</h1>
<p>This page creates both the SuperAdministrator and University.<br>The created SuperAdministrator is assigned to the created University</p>

<form action="PHP_Scripts/registerschool.php" method="post">
    <h2>User Credentials:</h2>
    <label for="new_username">Username:</label>
    <input type="text" id="new_username" name="new_username" required><br><br>
    <label for="new_password">Password:</label>
    <input type="password" id="new_password" name="new_password" required><br><br>
    <label for="new_university">University:</label>
    <input type="text" id="new_university" name="new_university" required><br><br>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>