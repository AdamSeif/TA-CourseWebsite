<!DOCTYPE html>
<html>
<head>
    <title>View Course Offering</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>View Course Offering</h1>

    <?php
    include 'connectdb.php';

    // Get all the course offerings.
    $courseQuery = "SELECT coid, term, year, whichcourse FROM courseoffer";
    $courseResult = mysqli_query($connection, $courseQuery);


	// Display the offerings.
    echo "<form method='post'>";
    echo "<label for='courseid'>Select Course Offering:</label><br>";
    echo "<select name='courseid'>";
    while ($row = mysqli_fetch_assoc($courseResult)) {
        echo "<option value='" . $row['coid'] . "'>" . $row['term'] . " " . $row['year'] . " - " . $row['whichcourse'] . "</option>";
    }
    echo "</select><br><br>";
    // Lets the user select an offering.
	echo "<input type='submit' class='button' value='View TAs'>";
    echo "</form>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $courseid = $_POST['courseid'];

        // Get all the TA information for the selected offering.
        $taQuery = "SELECT ta.tauserid, ta.firstname, ta.lastname FROM ta
                    JOIN hasworkedon ON ta.tauserid = hasworkedon.tauserid
                    WHERE hasworkedon.coid = '$courseid'";
        $taResult = mysqli_query($connection, $taQuery);

        if (mysqli_num_rows($taResult) > 0) {
            echo "<h2>TA Information for Selected Course Offering</h2>";
            echo "<table border='1' style='margin: 0 auto;'>";
            echo "<tr class='row'><th>TA User ID</th><th>First Name</th><th>Last Name</th></tr>";

			// Display the TA info for the offering.
            while ($row = mysqli_fetch_assoc($taResult)) {
                echo "<tr class='row'>";
                echo "<td>" . $row['tauserid'] . "</td>";
                echo "<td>" . $row['firstname'] . "</td>";
                echo "<td>" . $row['lastname'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No TAs for selected offering.</p>";
        }
    }

    mysqli_close($connection);
    ?>
</body>
</html>
