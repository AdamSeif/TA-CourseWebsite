<!DOCTYPE html>
<html>
<head>
    <title>Assign TA to Course Offering</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>Assign Teaching Assistant to Course Offering</h1>

    <?php
    include 'connectdb.php';

    // Get the TAs' IDs and full names.
    $taQuery = "SELECT tauserid, firstname, lastname FROM ta";
    $taResult = mysqli_query($connection, $taQuery);

    // Get all the course offerings.
    $courseQuery = "SELECT coid, term, year, whichcourse FROM courseoffer";
    $courseResult = mysqli_query($connection, $courseQuery);

    // Form to choose the TA.
    echo "<form method='post'>";
    echo "<label for='taid'>Select TA:</label><br>";
    echo "<select name='taid'>";
    while ($row = mysqli_fetch_assoc($taResult)) {
        echo "<option value='" . $row['tauserid'] . "'>" . $row['firstname'] . " " . $row['lastname'] . "</option>";
    }
    echo "</select><br><br>";

	// Form to choose the course offering.
    echo "<label for='coid'>Select Course Offering:</label><br>";
    echo "<select name='coid'>";
    while ($row = mysqli_fetch_assoc($courseResult)) {
        echo "<option value='" . $row['coid'] . "_" . $row['whichcourse'] . "'>" . $row['term'] . " " . $row['year'] . " - " . $row['whichcourse'] . "</option>";
    }
    echo "</select><br><br>";

	// Form for the user to enter the number of hours.
    echo "<label for='hours'>Enter Hours:</label><br>";
    echo "<input type='text' id='hours' name='hours'><br><br>";

    echo "<input type='submit' class='button' value='Assign TA'>";
    echo "</form>";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tauserid = $_POST['taid'];
        $coid = explode("_", $_POST['coid'])[0]; //idk why this only works with the explode
		$whichcourse = explode("_", $_POST['coid'])[1];
        $hours = $_POST['hours'];

        // Check if the relationship already exists.
        $checkQuery = "SELECT * FROM hasworkedon WHERE tauserid='$tauserid' AND coid='$coid'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "<p>TA is already assigned to this course.</p>";
        } else {
            // Query to insert into the hasworkedon table.
            $insertQuery = "INSERT INTO hasworkedon (tauserid, coid, hours) VALUES ('$tauserid', '$coid', '$hours')";
            // Running the insert query.
			if (mysqli_query($connection, $insertQuery)) {
                echo "<p>TA assigned to course!</p>";
            } else {
                echo "<p>Error: " . mysqli_error($connection) . "</p>";
            }
        }
    }

    mysqli_close($connection);
    ?>
</body>
</html>
