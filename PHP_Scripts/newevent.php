<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get Variables from POST
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];
        $new_eventname = $_POST['new_eventname'];
        $new_eventdescription = $_POST['new_eventdescription'];
        $new_eventtype = $_POST['new_eventtype'];
        $new_eventemail = $_POST['new_eventemail'];
        $new_eventphone = $_POST['new_eventphone'];
        $new_eventtime = $_POST['new_eventtime'];
        $new_eventdate = date('Y-m-d', strtotime($_POST['new_eventdate']));
        $new_eventlocation = $_POST['new_eventlocation'];

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

        else {
            //Determine if User is an Administrator of an Active RSO
            $result_admin = $conn->query("SELECT * FROM Admins WHERE UID='$admin_username' AND Password='$admin_password'");
            $result_rso = $conn->query("SELECT * FROM RSO WHERE Admins='$admin_username' AND Active=1");
            if (mysqli_num_rows($result_admin) > 0 && mysqli_num_rows($result_rso) > 0) {
                echo "<p>User is an Administrator of an Active RSO</p>";
                echo "<p>Creating $new_eventtype Event On $new_eventdate at $new_eventtime:00</p>";

                //Create RSO Event
                if (!strcmp($new_eventtype, "rso")) {
                    $result_rso_name = $conn->query("SELECT RSO_Name FROM Admins WHERE UID='$admin_username' AND Password='$admin_password'");
                    $rso_name = mysqli_fetch_row($result_rso_name)[0];
                    $stmt = $conn->prepare("INSERT INTO Events (E_name, Description, E_type, Email, Phone, Time, Day, L_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssiiss",$new_eventname, $new_eventdescription, $rso_name, $new_eventemail, $new_eventphone, $new_eventtime, $new_eventdate, $new_eventlocation);
                    if ($stmt->execute()) {
                        echo "<p>Successfully Created Event</p>";
                    }
                    else {
                        echo "<p>Failure Creating Event<br>Make Sure there are No Time/Date/Location Overlaps with Another Event</p>";
                        echo "<p>$stmt->error</p>";
                    }
                }

                //Create Private Event
                else if (!strcmp($new_eventtype, "private")) {
                    $result_university_name = $conn->query("SELECT University_ID FROM Admins WHERE UID='$admin_username' AND Password='$admin_password'");
                    $university_name = mysqli_fetch_row($result_university_name)[0];
                    $stmt = $conn->prepare("INSERT INTO Events (E_name, Description, E_type, Email, Phone, Time, Day, L_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssiiss",$new_eventname, $new_eventdescription, $university_name, $new_eventemail, $new_eventphone, $new_eventtime, $new_eventdate, $new_eventlocation);
                    if ($stmt->execute()) {
                        echo "<p>Successfully Created Event</p>";
                    }
                    else {
                        echo "<p>Failure Creating Event<br>Make Sure there are No Time/Date/Location Overlaps with Another Event</p>";
                        echo "<p>$stmt->error</p>";
                    }
                }

                //Create Public Event
                else {
                    $stmt = $conn->prepare("INSERT INTO Events (E_name, Description, E_type, Email, Phone, Time, Day, L_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssiiss",$new_eventname, $new_eventdescription, $new_eventtype, $new_eventemail, $new_eventphone, $new_eventtime, $new_eventdate, $new_eventlocation);
                    if ($stmt->execute()) {
                        echo "<p>Successfully Created Event</p>";
                    }
                    else {
                        echo "<p>Failure Creating Event<br>Make Sure there are No Time/Date/Location Overlaps with Another Event</p>";
                    }
                }
            }

            else {
                echo "<p>User is Not an Administrator of an Active RSO</p>";
            }
        }
    }

    //Return to Previous Page
    $url = $_SERVER['HTTP_REFERER'];
    echo "<p>Redirecting to Previous Page in 5 Seconds</p>";
    header ("Refresh:5; url=$url");
    exit();
?>