<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $student_username = $_POST['student_username'];
        $student_password = $_POST['student_password'];
        $event_id = $_POST['event_id'];
        $event_rating = $_POST['event_rating'];
        $event_comment = $_POST['event_comment'];

        //Set Connection Data
        $servername = "localhost";
        $username = "root";
        $password = "db_password";
        $database = "EventsSite";

        //Create Connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        //Print Error Message if Connection Fails
        if (!conn) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        else {
            //Determine if Student Exists
            $result_student = $conn->query("SELECT * FROM Users WHERE UID='$student_username' AND Password='$student_password'");
            if (mysqli_num_rows($result_student) > 0) {
                //Determine if User Have Access to the Event
                $result_student_info = $conn->query("SELECT University_ID, RSO_Name FROM Users WHERE UID='$student_username' AND Password='$student_password'");
                $student_info = $result_student_info->fetch_assoc();
                $student_university = $student_info["University_ID"];
                $student_rso = $student_info["RSO_Name"];
                $result_public = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='public'");
                $result_private = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='$student_university'");
                $result_rso = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='$student_rso'");
                if (mysqli_num_rows($result_public) > 0 || mysqli_num_rows($result_private) > 0 || mysqli_num_rows($result_rso) > 0) {
                    //Insert Comment
                    echo "<p>Inserting Comment</p>";
                    $stmt = $conn->prepare("INSERT INTO Comments (Events_ID, Rating, Event_Comment, UID) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiss", $event_id, $event_rating, $event_comment, $student_username);
                    if ($stmt->execute()) {
                        echo "<p>Successfully Added Comment";
                    }
                    else {
                        echo "<p>$stmt->error</p>";
                    }
                }
                else {
                    echo "<p>Student Does Not Have Access to this Event";
                }
            }
            else {
                echo "<p>Invalid Credentials</p>";
            }
        }
    }

    //Return to Previous Page
    $url = $_SERVER['HTTP_REFERER'];
    echo "<p>Redirecting to Previous Page in 5 Seconds</p>";
    header ("Refresh:5; url=$url");
    exit();
?>
