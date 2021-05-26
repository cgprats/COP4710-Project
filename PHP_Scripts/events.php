<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $student_username = $_POST['student_username'];
        $student_password = $_POST['student_password'];

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

        //Create User if Connection Succeeds
        else {
            //Check if Student Exists
            $result_student = $conn->query("SELECT * FROM Users WHERE UID='$student_username' AND Password='$student_password'");
            if (mysqli_num_rows($result_student) > 0) {
                echo "<h1>Events List:</h1>";
                //Find Student University
                $result_university_name = $conn->query("SELECT University_ID FROM Users WHERE UID='$student_username' AND Password='$student_password'");
                $university_name = mysqli_fetch_row($result_university_name)[0];

                //Find Student RSO
                $result_rso_name = $conn->query("SELECT RSO_Name FROM Users WHERE UID='$student_username' AND Password='$student_password'");
                $rso_name = mysqli_fetch_row($result_rso_name)[0];


                //Show Public Events
                $public_events = $conn->query("SELECT * FROM Events WHERE E_type='public'");
                if ($public_events->num_rows > 0) {
                    echo "<h2>Public Events:</h2>";
                    while ($row = $public_events->fetch_assoc()) {
                        echo "<p>Event ID: " . $row["Events_ID"] . "<br>Event Name: " . $row["E_name"]. "<br>Description: " . $row["Description"]. "<br>Email: " . $row["Email"]. "<br> Phone: " . $row["Phone"]. "<br>Time: " . $row["Time"]. ":00<br>Day: " . $row["Day"] . "<br>Location: " . $row["L_name"] . "</p>";
                    }
                }

                //Show Private Events
                $private_events = $conn->query("SELECT * FROM Events WHERE E_type='$university_name'");
                if ($private_events->num_rows > 0) {
                    echo "<h2>Private (University) Events:</h2>";
                    while ($row = $private_events->fetch_assoc()) {
                        echo "<p>Event ID: " . $row["Events_ID"] . "<br>Event Name: " . $row["E_name"]. "<br>Description: " . $row["Description"]. "<br>Email: " . $row["Email"]. "<br> Phone: " . $row["Phone"]. "<br>Time: " . $row["Time"]. ":00<br>Day: " . $row["Day"] . "<br>Location: " . $row["L_name"] . "</p>";
                    }
                }

                //Show RSO Events
                $rso_active = $conn->query("SELECT * FROM RSO WHERE RSO_Name='$rso_name' AND Active=1");
                $rso_events = $conn->query("SELECT * FROM Events WHERE E_type='$rso_name'");
                if ($rso_active && $rso_events->num_rows > 0) {
                    echo "<h2>$rso_name RSO Events:</h2>";
                    while ($row = $rso_events->fetch_assoc()) {
                        echo "<p>Event ID: " . $row["Events_ID"] . "<br>Event Name: " . $row["E_name"]. "<br>Description: " . $row["Description"]. "<br>Email: " . $row["Email"]. "<br> Phone: " . $row["Phone"]. "<br>Time: " . $row["Time"]. ":00<br>Day: " . $row["Day"] . "<br>Location: " . $row["L_name"] . "</p>";
                    }
                }
            }
            else {
                echo "<p>Invalid Login Credentials</p>";
            }
        }
    }
    echo "<form><input type='button' value='Return to Previous Page' onClick='javascript:history.go(-1)'</form>";
?>