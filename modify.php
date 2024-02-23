<!DOCTYPE html>
<html>
<head>
    <title>Modify TA</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
    <style>
        /* Add your CSS styles here */
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
    <h1>Modify Teaching Assistant</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
        <label for="tauserid">Enter TA User ID:</label><br>
        <input type="text" id="tauserid" name="tauserid"><br><br>
        <label for="imageurl">Enter Image URL:</label><br>
        <input type="text" id="imageurl" name="imageurl"><br><br>
        <input type="submit" value="Submit" class="button">
    </form>
    
    <?php
        include 'connectdb.php';

        // Check if the input is not empty
        if(isset($_POST['tauserid'], $_POST['imageurl']) && !empty($_POST['tauserid']) && !empty($_POST['imageurl'])) {
            $tauserid = $_POST['tauserid'];
            $imageurl = $_POST['imageurl'];

            // query to update tuple with the corresponding 'tauserid' with the new 'imageurl'
            $query = "UPDATE ta SET image='$imageurl' WHERE tauserid='$tauserid'";
            if(mysqli_query($connection, $query)) {
                echo "<div class='success-msg'>New image URL assigned to TA with ID: $tauserid.</div>";
            } else {
                echo "<div class='error-msg'>Error: " . mysqli_error($connection) . "</div>";
            }
        } else {
            echo "<div class='error-msg'>Neither field may be null.</div>";
        }

        mysqli_close($connection);
    ?>
</body>
</html>
