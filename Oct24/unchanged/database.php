<?php

session_start();

function add_product($upc, $description, $price) {
    if (isset($_SESSION['db'][$upc]))
        die("Cannot add a product with a UPC code that is the same");
    
    $_SESSION['db'][$upc] = array(
        'upc' => $upc,
        'description' => $description,
        'price' => $price
    );
}

function edit_product($currentUpc, $newUpc, $description, $price) {
    if (!isset($_SESSION['db'][$currentUpc]))
        die("Cannot edit a product with a UPC code that does not exist");
    
    // Delete what currently exists
    delete_product($currentUpc);
    
    // And then replace it
    add_product($newUpc, $description, $price);
}

function delete_product($upc) {
    unset($_SESSION['db'][$upc]);
}

function get_product($upc) {
    return $_SESSION['db'][$upc];
}

function get_all() {
    return $_SESSION['db'];
}

if (!isset($_SESSION['db'])) {
    $_SESSION['db'] = array();
    
    add_product("123", "Chicken", "4.99");
    add_product("456", "Potatoes", "4.99");
    add_product("789", "Beef", "4.99");
    
}

?>
