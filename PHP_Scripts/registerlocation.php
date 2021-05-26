<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];
        $location_name = $_POST['location_name'];
        $location_address = $_POST['location_address'];
        $location_longitude = $_POST['location_longitude'];
        $location_latitude = $_POST['location_latitude'];

        //Set Connection Data
        $servername = "localhost";
        $username = "root";
        $password = "db_password";
        $database = "EventsSite";

        //Create Connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        //Print Error Message if Connection Fails
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //Continue if Connection Succeeds
        else {
            //Determine if User is a SuperAdministrator
            $result = $conn->query("SELECT * FROM SuperAdmins WHERE UID='$admin_username' AND Password='$admin_password'");
            if (mysqli_num_rows($result) > 0) {
                echo "<p>User is a SuperAdministrator</p>";

                //Create Location
                $stmt = $conn->prepare("INSERT INTO Location (L_name, Address, Longitude, Latitude) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssdd", $location_name, $location_address, $location_longitude, $location_latitude);

                if ($stmt->execute()) {
                    echo "<p>Location Creation Successful</p>";
                }
                else {
                    echo "<p>Failure Creating Location<br>Make Sure Its Unique</p>";
                }
            }

            else {
                echo "<p>User is Not SuperAdministrator</p>";
            }
        }
    }

    //Return to Previous Page
    $url = $_SERVER['HTTP_REFERER'];
    echo "<p>Redirecting to Previous Page in 5 Seconds</p>";
    header ("Refresh:5; url=$url");
    exit();
?>