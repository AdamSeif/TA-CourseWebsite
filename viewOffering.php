<!DOCTYPE html>
<html>
<head>
    <title>View Course Offerings</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>View Course Offerings</h1>

    <?php
    include 'connectdb.php';

    // Get courses.
    $courseQuery = "SELECT DISTINCT coursenum, coursename FROM course";
    $courseResult = mysqli_query($connection, $courseQuery);

    // Form to select a course.
    echo "<form method='post'>";
    echo "<label for='coursenum'>Select Course:</label><br>";
    echo "<select name='coursenum'>";
    while ($row = mysqli_fetch_assoc($courseResult)) {
        echo "<option value='" . $row['coursenum'] . "'>" . $row['coursenum'] . " - " . $row['coursename'] . "</option>";
    }
    echo "</select><br><br>";

    // Form to input start and end years.
    echo "<label for='startyear'>Start Year:</label>";
    echo "<input type='number' name='startyear'><br><br>";
    echo "<label for='endyear'>End Year:</label>";
    echo "<input type='number' name='endyear'><br><br>";

    echo "<input type='submit' class='button' value='View Offerings'>";
    echo "</form>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $coursenum = $_POST['coursenum'];
        $startyear = $_POST['startyear'];
        $endyear = $_POST['endyear'];

        // Query that finds course offerings in the desired range of years.
        $courseOfferingQuery = "SELECT coid, numstudent, term, year FROM courseoffer 
                                WHERE whichcourse='$coursenum' AND year BETWEEN '$startyear' AND '$endyear'";
        // Running the query.
		$courseOfferingResult = mysqli_query($connection, $courseOfferingQuery);

        if (mysqli_num_rows($courseOfferingResult) > 0) {
            echo "<h2>Course Offerings for Selected Course</h2>";
            echo "<table border='1' style='margin: 0 auto;'>";
            echo "<tr class='row'><th>Course Offering ID</th><th>Number of Students</th><th>Term</th><th>Year</th></tr>";

			// Displays the course offerings.
            while ($row = mysqli_fetch_assoc($courseOfferingResult)) {
                echo "<tr class='row'>";
                echo "<td>" . $row['coid'] . "</td>";
                echo "<td>" . $row['numstudent'] . "</td>";
                echo "<td>" . $row['term'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No course offerings found in these years.</p>";
        }
    }

    mysqli_close($connection);
    ?>
</body>
</html>
