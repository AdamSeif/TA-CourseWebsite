<!DOCTYPE html>
<html>
<head>
    <title>Insert TA Information</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
	<style>
	form {
		margin: 0px auto;
		padding: 20px 20px;
		font-size: 12px;
		text-align: center;
		background-color: black;
		color: yellow;
		border: none;
		border-radius: 5px;
		font-size: 20px;
		width: 400px;
    }
	</style>
</head>
<body>
    <?php
    include 'connectdb.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Assigning user input to  PHP variables.
        $tauserid = $_POST['tauserid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $studentnum = $_POST['studentnum'];
        $degreetype = $_POST['degreetype'];
        $image = $_POST['image'];

        // Validating that the fields are non-null (except image).
        if (!empty($tauserid) && !empty($firstname) && !empty($lastname) && !empty($studentnum) && !empty($degreetype)) {
            // Query that inserts the data creating a new tuple.
            $query = "INSERT INTO ta (tauserid, firstname, lastname, studentnum, degreetype, image) 
                      VALUES ('$tauserid', '$firstname', '$lastname', '$studentnum', '$degreetype', '$image')";

            // Perform the query.
            if (mysqli_query($connection, $query)) {
                echo "New TA added!";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($connection);
            }
        } else {
            echo "Fields cannot be null.";
        }
    }
    ?>
    <h1>Insert TA Information</h1>
	
	<!-- Form for user to enter fields. -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
        TA User ID: <input type="text" name="tauserid" required><br><br>
        First Name: <input type="text" name="firstname" required><br><br>
        Last Name: <input type="text" name="lastname" required><br><br>
        Student Number: <input type="text" name="studentnum" required><br><br>
        Degree Type: <input type="text" name="degreetype" required><br><br>
        Image Link: <input type="text" name="image"><br><br>
        <input class='button' type="submit" value="Submit">
    </form>
    <?php
    mysqli_close($connection);
    ?>
</body>
</html>
