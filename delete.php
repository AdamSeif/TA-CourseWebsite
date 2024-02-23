<!DOCTYPE html>
<html>
<head>
    <title>Delete a TA</title>
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
    <h1>Delete Teaching Assistant</h1>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
        <label for="tauserid">Enter TA User ID to delete:</label><br>
        <input type="text" id="tauserid" name="tauserid"><br><br>
        <input type="submit" value="Delete" class="button">
    </form>
    
    <?php
        include 'connectdb.php';

        // Check if the input is not empty
        if(isset($_GET['tauserid']) && !empty($_GET['tauserid'])) {
            $tauserid = $_GET['tauserid'];

            // query that deletes the tuple
            $query = "DELETE FROM ta WHERE tauserid='$tauserid'";
            if(mysqli_query($connection, $query)) {
                echo "<div class='success-msg'>TA with ID: $tauserid has been deleted from the database.</div>";
            } else {
                echo "<div class='error-msg'>Error: " . mysqli_error($connection) . "</div>";
            }
        } else {
            echo "<div class='error-msg'>No TA User ID provided to delete.</div>";
        }

        mysqli_close($connection);
    ?>
</body>
</html>
