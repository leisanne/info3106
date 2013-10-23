<?php
// Start with the query that retrieves all submissions
$query = "SELECT name, email, phone FROM ContactMe";

// Same as before: make a connection
$connection = mysqli_connect('localhost', 'lamp', 'lamp', 'class_examples')
            or die('Could not connect to database: ' . $connection->connect_error);

// And execute the query
$result = mysqli_query($connection, $query)
            or die('Error querying database');

// Now, let's complete some HTML to output the submissions
?>
<html>
    <head><title>Submissions</title></head>
    <body>
        <h1>Submissions</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            <?php
            // This is different that what we've seen thusfar.
            // First, mysqli_fetch_array($result) will return a single
            // array for the next available row in the result set. Note that
            // after each mysqli_fetch_array operation, the current row 
            // increments by 1. Therefore, each iteration through the while loop
            // is actually the next row.
            // 
            // The while loop will continue as long as what's inside the 
            // conditon does not evaluate to FALSE. When mysqli_fetch_array 
            // has no more rows to move to, it will return FALSE and the loop
            // will stop.
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                // The 0th (1st) column (name). If unsure, see the SELECT
                // query at the top.
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "</tr>";
                
                // Note that $row['name'] can also be used for $row[0].
                // And that $row['email'] can also be used instead of $row[1].
                // And that $row['phone'] can also be used instead of $row[2].
            }
            ?>
        </table>
    </body>
</html>
<?php
// Don't forget to close the database connection!
mysqli_close($connection);
?>