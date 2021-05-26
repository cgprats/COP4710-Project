<html lang="en">
<style>
    <?php include "CSS/style.css" ?>
</style>
<head>
    <?php include ("Shared/navbar.xhtml"); ?>
    <title>College Events - Create Event</title>
</head>
<body>

<h1>Important Information</h1>
<p>This page creates an event.<br>Only an administrator can create an event.</p>

<form action="PHP_Scripts/newevent.php" method="post">
    <h2>User Credentials:</h2>
    <label for="new_username">Username:</label>
    <input type="text" id="admin_username" name="admin_username" required><br><br>
    <label for="new_password">Password:</label>
    <input type="password" id="admin_password" name="admin_password" required><br><br>
    <h2>Event Details:</h2>
    <label for="new_eventname">Event Name:</label>
    <input type="text" id="new_eventname" name="new_eventname" required><br><br>
    <label for="new_eventdescription">Description:</label>
    <input type="text" id="new_eventdescription" name="new_eventdescription" required><br><br>
    <p>Event Type:
    <input type="radio" id="public" name="new_eventtype" value="public" required>
    <label for="public">Public</label>
    <input type="radio" id="private" name="new_eventtype" value="private">
    <label for="private">Private</label>
    <input type="radio" id="rso" name="new_eventtype" value="rso">
        <label for="rso">RSO Only</label><br><br></p>
    <label for="new_eventemail">Contact Email:</label>
    <input type="text" id="new_eventemail" name="new_eventemail" required><br><br>
    <label for="new_eventphone">Contact Phone:</label>
    <input type="text" id="new_eventphone" name="new_eventphone" required><br><br>
    <label for="new_eventtime">Time:</label>
    <input type="text" id="new_eventtime" name="new_eventtime" required><br><br>
    <label for="new_eventdate">Date:</label>
    <input type="date" id="new_eventdate" name="new_eventdate" required><br><br>
    <label for="new_eventlocation">Location:</label>
    <input type="text" id="new_eventlocation" name="new_eventlocation" required><br><br>
    <input type="submit" name="submit" value="submit">
</form>

<?php
    //Set Connection Data
    $servername = "localhost";
    $username = "root";
    $password = "Chris._02182001";
    $database = "EventsSite";

    //Create Connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    //Find Locations
    $locations = $conn->query("SELECT L_name, Address FROM Location");

    //Print Available Locations
    echo "<h2>Available Locations:</h2>";
    if ($locations->num_rows > 0) {
        while ($row = $locations->fetch_assoc()) {
            echo "<p>Location Name: " . $row["L_name"]. " <br>Address: " . $row["Address"]. "</p>";
        }
    }
    else {
        echo "<p>No Locations Defined</p>";
    }
?>

</body>
</html>