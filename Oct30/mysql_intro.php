<?php
/*
 * To begin, you will need to create the proper MySQL database and tables.
 * Skip to tables below if you already have a databased you'd like to use.
 * 
 * SETTING UP A DATABASE:
 *  - Click the WAMP icon and go to MySQL, then "MySQL Console"
 *  - Enter the password you created when you installed WAMP
 *  - Execute the following commands:
 *      CREATE DATABASE class_examples;
 *      CREATE USER 'lamp'@'localhost' IDENTIFIED BY 'lamp';
 *      GRANT ALL PRIVILEGES ON class_examples.* TO 'lamp'@'localhost';
 * 
 * CREATING THE TABLE FOR THIS EXERCISE:
 *  - Execute the following at the MySQL Console (aka CLI):
 *          CREATE TABLE ContactMe(
 *              id INT NOT NULL AUTO_INCREMENT,
 *              name VARCHAR(30),
 *              email VARCHAR(50),
 *              phone VARCHAR(30),
 *              PRIMARY KEY(id)
 *          );
 * 
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Just for convenience...
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Let's begin by writing out our query.
    // Note that string values must be within single quotes in MySQL. You
    // must pay attention to this when writing your queries and be constantly
    // questioning, "Is the value contained in this string valid MySQL?"
    $query = "INSERT INTO ContactMe (name, email, phone) VALUES " . 
        "('$name', '$email', '$phone')";
    
    // We begin by building a connection to the database. This command will
    // connect to the 'class_examples' database (fourth argument) on 'localhost' 
    // (first argument) with a username of 'lamp' and a password of 'lamp'
    // (arguments 2 and 3, respectively).
    // The connection can be referenced using the $connection variable
    $connection = mysqli_connect('localhost', 'lamp', 'lamp', 'class_examples')
            or die('Could not connect to database: ' . $connection->connect_error);
    
    // This will actually execute the query contained in $query over the
    // database connected to in $connection. The $result variable doesn't do 
    // much here. However, for SELECT queries, it will contain a reference to
    // the results from the query. 
    $result = mysqli_query($connection, $query)
            or die('Error querying database');
    
    // A connection should *always* be gracefully closed as follows.
    // This will cleanly break the TCP connection thus saving the server's
    // resources. 
    mysqli_close($connection);
    
    echo "<html><body><p>Uploaded your data to the server!</p></body></html>";
}
else {
?>
<html>
<head>
	<title>Contact us</title>
        <style>
            .error { padding: 2px; margin: 2px; color: #a00; }
        </style>
</head>
<body> 
    <a href="mysql_listall.php">List all submissions</a>
    <h1>Contact us</h1>
    <form action="mysql_intro.php" method="POST">
            <label for="name">Your name: </label>	
            <input type="text" name="name"/><br/>

            <label for="email">Your email: </label>
            <input type="text" name="email"/><br/>

            <label for="phone">Your phone: </label>
            <input type="text" name="phone"/><br/><br/>

            <input type="submit"/>
    </form>
</body>
</html>
<?php
}
?>