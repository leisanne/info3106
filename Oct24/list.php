<html>
    <head>
        <title>Products in the store</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
    </head>
    <body>
        <a href="index.php?action=new">Add new product</a>
        <table>
            <tr>
                <th>UPC</th>
                <th>Description</th>
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
            <?php
                foreach (get_all() as $upc => $members) {
                    echo "<tr>";
                    echo "<td>".$members->getUpc()."</td>";
                    echo "<td>".$members->getDescription()."</td>";
                    echo "<td>".$members->getPrice()."</td>";
                    echo "<td><a href='index.php?action=delete&upc=$upc'>Delete</a></td>";
                    echo "<td><a href='index.php?action=edit&upc=$upc'>Edit</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>