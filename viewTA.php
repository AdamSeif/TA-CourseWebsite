<!DOCTYPE html>
<html>
<head>
    <title>View TA</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>View Teaching Assistant</h1>

    <?php
    include 'connectdb.php';

    // Get the TAs' IDs and full names.
    $taQuery = "SELECT tauserid, firstname, lastname FROM ta";
    $taResult = mysqli_query($connection, $taQuery);

    // Form to choose the TA.
    echo "<form method='post'>";
    echo "<label for='taid'>Select TA:</label><br>";
    echo "<select name='taid'>";
    while ($row = mysqli_fetch_assoc($taResult)) {
        echo "<option value='" . $row['tauserid'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
    }
    echo "</select><br><br>";
    echo "<input type='submit' class='button' value='View TA'>";
    echo "</form>";

    // Check if form is submitted i.e., a TA is selected.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tauserid = $_POST['taid'];

        // Query to get course offerings for the selected TA.
        $courseQuery = "SELECT h.tauserid, h.coid, h.hours, c.coursenum, c.coursename, co.term, co.year,
            IFNULL(l.lcoursenum, '') AS loved_course, IFNULL(ha.hcoursenum, '') AS hated_course
            FROM hasworkedon h
            JOIN courseoffer co ON h.coid = co.coid
            JOIN course c ON co.whichcourse = c.coursenum
            LEFT JOIN loves l ON h.tauserid = l.ltauserid AND c.coursenum = l.lcoursenum
            LEFT JOIN hates ha ON h.tauserid = ha.htauserid AND c.coursenum = ha.hcoursenum
            WHERE h.tauserid = '$tauserid'";

        $result = mysqli_query($connection, $courseQuery);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Course Offerings for Selected TA</h2>";
            echo "<table border='1' style='margin: 0 auto;'>";
            echo "<tr class='row'><th>Course Number</th><th>Course Name</th><th>Term</th><th>Year</th><th>Hours</th><th>Loved</th><th>Hated</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='row'>";
                echo "<td>" . $row['coursenum'] . "</td>";
                echo "<td>" . $row['coursename'] . "</td>";
                echo "<td>" . $row['term'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>" . $row['hours'] . "</td>";

                // Display appropriate emoji for love and hate.
                echo "<td>" . ($row['loved_course'] !== '' ? '😊' : '') . "</td>";
                echo "<td>" . ($row['hated_course'] !== '' ? '☹️' : '') . "</td>";

                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No course offerings found for the selected TA.</p>";
        }
    }

    mysqli_close($connection);
    ?>
</body>
</html>
