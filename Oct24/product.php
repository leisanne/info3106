<html>
    <head>
        <title>Products in the store</title>
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
    </head>
    <body>
        <h2>Enter the new product</h2>
        <form action="index.php" method="post">
            <input type="hidden" name="editing" value="<?php echo $editing; ?>"/>
            
            <label for="upc">UPC: </label>
            <input type="text" name="upc" value="<?php echo $upc; ?>"/><br/>
            
            <label for="description">Description: </label>
            <input type="text" name="description" value="<?php echo $description; ?>"/><br/>
            
            <label for="price">Price: </label>
            <input type="text" name="price" value="<?php echo $price; ?>"/><br/>
            
            <input type="submit"/>
        </form>
    </body>
</html>