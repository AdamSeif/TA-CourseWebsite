<!DOCTYPE html>
<html>
<head>
    <title>View TAs</title>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
    <h1>View Teaching Assistants</h1>
    <form method="post">
        <div class="radios">
            <input type="radio" name="sort" value="lname_asc">Last Name Ascending                                                              
        </div>
        <div class="radios">
            <input type="radio" name="sort" value="lname_desc">Last Name Descending
        </div>
        <div class="radios">
            <input type="radio" name="sort" value="degree_asc">Degree Ascending    
        </div>
        <div class="radios">
            <input type="radio" name="sort" value="degree_desc">Degree Descending  
        </div>
        <input type="submit" name="submit" value="Go" class="button" style="background-color: yellow; color: black;">
    </form>
    <?php
    // database connector
    include 'connectdb.php';

    // function to select sorting type
function sortTAs($sortOption) {
    global $connection;

    $query = "";

    // query sort options
    switch ($sortOption) {
        case "lname_asc":
            $query = "SELECT * FROM ta ORDER BY lastname ASC";
            break;
        case "lname_desc":
            $query = "SELECT * FROM ta ORDER BY lastname DESC";
            break;
        case "degree_asc":
            $query = "SELECT * FROM ta ORDER BY degreetype ASC";
            break;
        case "degree_desc":
            $query = "SELECT * FROM ta ORDER BY degreetype DESC";
            break;
        default:
            $query = "SELECT * FROM ta";
    }

    $result = $connection->query($query);

    if (!$result) {
        echo "Error: " . $connection->error;
        return;
    }

    // Display TAs as clickable rows linking to display.php
    if ($result->num_rows > 0) {
        echo "<table border='1' style='margin: 0 auto;'>";
        echo "<tr class='row'><th>TA User ID</th><th>First Name</th><th>Last Name</th><th>Student Number</th><th>Degree</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr class='row'>";
            echo "<td><a href='display.php?id=".$row['tauserid']."'>".$row['tauserid']."</a></td>";
            echo "<td><a href='display.php?id=".$row['tauserid']."'>".$row['firstname']."</a></td>";
            echo "<td><a href='display.php?id=".$row['tauserid']."'>".$row['lastname']."</a></td>";
            echo "<td><a href='display.php?id=".$row['tauserid']."'>".$row['studentnum']."</a></td>";
            echo "<td><a href='display.php?id=".$row['tauserid']."'>".$row['degreetype']."</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Database is empty.";
    }
}

    if (isset($_POST['submit'])) {
        $sortOption = $_POST['sort'];
        sortTAs($sortOption);
    }

    $connection->close();
    ?>
</body>
</html>
