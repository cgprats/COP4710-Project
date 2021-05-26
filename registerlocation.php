<html lang="en">
<style>
    <?php include "CSS/style.css" ?>
</style>
<head>
    <?php include ("Shared/navbar.xhtml"); ?>
    <title>College Events - Create Location</title>
</head>
<body>

<h1>Important Information</h1>
<p>This page creates a Location<br>Only a SuperAdministrator may create a Location</p>

<form action="PHP_Scripts/registerlocation.php" method="post">
    <h2>User Credentials:</h2>
    <label for="admin_username">Username:</label>
    <input type="text" id="admin_username" name="admin_username" required><br><br>
    <label for="admin_password">Password:</label>
    <input type="password" id="admin_password" name="admin_password" required><br><br>
    <h2>Location Details:</h2>
    <label for="location_name">Location Name:</label>
    <input type="text" id="location_name" name="location_name" required><br><br>
    <label for="location_address">Address:</label>
    <input type="text" id="location_address" name="location_address" required><br><br>
    <label for="location_longitude">Longitude:</label>
    <input type="text" id="location_longitude" name="location_longitude" required><br><br>
    <label for="location_latitude">Latitude:</label>
    <input type="text" id="location_latitude" name="location_latitude" required><br><br>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>