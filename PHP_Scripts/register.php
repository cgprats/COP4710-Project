<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        $new_university = $_POST['new_university'];
        $new_rso = $_POST['new_rso'];

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
            //Determine if RSO Exists
            $rso = $conn->query("SELECT * FROM RSO WHERE RSO_Name='$new_rso'");

            if (mysqli_num_rows($rso) > 0) {
                echo "<p>Adding Student to Existing RSO";

                //Create User
                $stmt = $conn->prepare("INSERT INTO Users (UID, Password, University_ID, RSO_Name) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $new_username, $new_password, $new_university, $new_rso);
                if ($stmt->execute()) {
                    echo "<p>Created User</p>";
                }

                else {
                    echo "<p>Failed to Add User, Make Sure it is Unique</p>";
                }
            }

            else {
                //Create RSO
                echo "<p>Creating New RSO</p>";
                $stmt = $conn->prepare("INSERT INTO RSO (RSO_Name, University_ID, Admins, Num_Students, Active) VALUES (?, ?, ?, 0, 0)");
                $stmt->bind_param("sss", $new_rso, $new_university, $new_username);
                if ($stmt->execute()) {
                    echo "<p>Created RSO</p>";

                    //Create User
                    $stmt = $conn->prepare("INSERT INTO Users (UID, Password, University_ID, RSO_Name) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $new_username, $new_password, $new_university, $new_rso);
                    if ($stmt->execute()) {
                        echo "<p>Created User</p>";
                    }

                    else {
                        echo "<p>Failed to Add User, Make Sure it is Unique</p>";
                    }

                    //Set First User as Admin
                    $stmt = $conn->prepare("INSERT INTO Admins (UID, Password, University_ID, RSO_Name) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $new_username, $new_password, $new_university, $new_rso);
                    if ($stmt->execute()) {
                        echo "<p>First Member will be Admin when RSO is Active</p>";
                    }

                    else {
                        echo "<p>Failed to Set Administrator</p>";
                    }
                }

                else {
                    echo "<p>Failed to Create RSO</p>";
                }
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