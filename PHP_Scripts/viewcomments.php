<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get Variables from POST
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];
    $event_id = $_POST['event_id'];

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
            //Determine if User Have Access to the Event
            $result_student_info = $conn->query("SELECT University_ID, RSO_Name FROM Users WHERE UID='$student_username' AND Password='$student_password'");
            $student_info = $result_student_info->fetch_assoc();
            $student_university = $student_info["University_ID"];
            $student_rso = $student_info["RSO_Name"];
            $result_public = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='public'");
            $result_private = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='$student_university'");
            $result_rso = $conn->query("SELECT * FROM Events WHERE Events_ID='$event_id' AND E_type='$student_rso'");
            if (mysqli_num_rows($result_public) > 0 || mysqli_num_rows($result_private) > 0 || mysqli_num_rows($result_rso) > 0) {
                //Show Event Comments
                $event_comments = $conn->query("SELECT * FROM Comments WHERE Events_ID='$event_id'");
                if ($event_comments->num_rows > 0) {
                    echo "<h2>Comments for Event " . $event_id . "</h2>";
                    while ($row = $event_comments->fetch_assoc()) {
                        echo "<p>Poster: " . $row["UID"]. "<br>Comment ID: " . $row["Comment_ID"]. "<br>Rating: " . $row["Rating"]. "<br>Comment: " . $row["Event_Comment"]. "</p>";
                    }
                }
            }
            else {
                echo "<p>Student Does Not Have Access To This Event!</p>";
            }
        }
        else {
            echo "<p>Invalid Login Credentials</p>";
        }
    }
}
echo "<form><input type='button' value='Return to Previous Page' onClick='javascript:history.go(-1)'</form>";
?>