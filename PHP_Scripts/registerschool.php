<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        $new_university = $_POST['new_university'];

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
            $stmt = $conn->prepare("INSERT INTO University (University_ID, SuperAdmin) VALUES (?, ?)");
            $stmt->bind_param("ss", $new_university, $new_username);

            //Execute Statement and Print Success
            if ($stmt->execute()) {
                echo "<p>University Creation Successful</p>";
                $stmt = $conn->prepare("INSERT INTO SuperAdmins (UID, Password, University_ID) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $new_username, $new_password, $new_university);
                if ($stmt->execute()) {
                    echo "<p>SuperAdministrator Creation Successful</p>";
                }
                else {
                    echo "<p>Failure Creating SuperAdministrator<br>Cleaning University</p>";
                    if ($conn->query("DELETE FROM University WHERE University_ID='$new_university' AND SuperAdmin='$new_username'")) {
                        echo "<p>Successfully Cleaned University.<br>Please Try Creation Again</p>";
                    }
                    else {
                        echo "<p>Failure Clearing University.<br>Database Error: Please Contact the Site Administrator</p>";
                    }
                }
            }

            else {
                echo "<p>Insertion Failure</p>";
                echo "<p>Make Sure the University is Unique</p>";
            }

            $stmt->close();
            $conn->close();
        }
}

    //Return to Previous Page
    $url = $_SERVER['HTTP_REFERER'];
    echo "<p>Redirecting to Previous Page in 5 Seconds</p>";
    header ("Refresh:5; url=$url");
    exit();
?>