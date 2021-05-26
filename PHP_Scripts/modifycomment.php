<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get Variables from POST
    $student_username = $_POST['student_username'];
    $student_password = $_POST['student_password'];
    $comment_id = $_POST['comment_id'];
    $action = $_POST['action'];
    if (!strcmp($action, "Modify")) {
        $new_rating = $_POST['new_rating'];
        $new_comment = $_POST['new_comment'];
    }

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
        //Determine if Student Exists and Wrote the Comment
        $result_student = $conn->query("SELECT * FROM Users WHERE UID='$student_username' AND Password='$student_password'");
        $result_author = $conn->query("SELECT * FROM Comments WHERE Comment_ID='$comment_id' AND UID='$student_username'");
        if (mysqli_num_rows($result_student) > 0 && mysqli_num_rows($result_author) > 0) {
            //Modify the Comment
            if (!strcmp($action, "Modify")) {
                if ($conn->query("UPDATE Comments SET Rating='$new_rating', Event_Comment='$new_comment' WHERE Comment_ID='$comment_id' AND UID='$student_username'")) {
                   echo "<p>Successfully Updated Comment</p>";
                }
                else {
                    echo "<p>Failure Updating Comment</p>";
                }
            }
            //Delete the Comment
            else {
                if ($conn->query("DELETE FROM Comments WHERE Comment_ID='$comment_id' AND UID='$student_username'")) {
                    echo "<p>Successfully Deleted Comment</p>";
                }
                else {
                    echo "<p>Failure Deleting Comment</p>";
                }
            }
        }
        else {
            echo "<p>Invalid Credentials or Student Did Not Write Comment</p>";
        }
    }
}

//Return to Previous Page
$url = $_SERVER['HTTP_REFERER'];
echo "<p>Redirecting to Previous Page in 5 Seconds</p>";
header ("Refresh:5; url=$url");
exit();
?>
