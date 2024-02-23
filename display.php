<!DOCTYPE html>
<html>
<head>
    <title>TA Information</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
    <style>
        /* CSS to somewhat center the image */
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .image-container img {
            max-width: 400px;
            max-height: 400px;
        }
		/* I'm recycling the button CSS to make the fields more legible.*/
        .button {
            align-items: center;
            background: black;
            width: 400px;
        }
    </style>
</head>
<body>
<?php
    include 'connectdb.php';
	
	// Recieving the tauserid of the previously clicked TA.
    if(isset($_GET['id'])) {
        $taID = $_GET['id'];

        $query = "SELECT * FROM ta WHERE tauserid='$taID'";
        $result = mysqli_query($connection, $query);
		
		// Displaying fields.
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>TA Information</h1>";
            echo "<div class='button'>TA User ID: " . $row['tauserid'] . "</div>";
            echo "<div class='button'>First Name: " . $row['firstname'] . "</div>";
            echo "<div class='button'>Last Name: " . $row['lastname'] . "</div>";
            echo "<div class='button'>Student Number: " . $row['studentnum'] . "</div>";
            echo "<div class='button'>Degree: " . $row['degreetype'] . "</div>";

            // Display the silhouette of Stewie's head if the link is null.
            $imageLink = $row['image'];
            if ($imageLink !== null) {
                echo "<div class='image-container'>";
                echo "<img src='" . $imageLink . "' alt='TA Image'>";
                echo "</div>";
            } else {
                echo "<div class='image-container'>";
                echo "<img src='https://i.imgur.com/SAMAAih.jpg' alt='Default Image'>";
                echo "</div>";
            }
        } else {
            echo "Invalid tauserid.";
        }
    } else {
        echo "Invalid tauserid.";
    }

    mysqli_close($connection);
?>
</body>
</html>
