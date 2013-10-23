<?php

require_once 'FoodItem.php';
session_start();

function add_product($foodItem) {
    if (isset($_SESSION['db'][$foodItem->getUpc()]))
        die("Cannot add a product with a UPC code that is the same");
    
    $_SESSION['db'][$foodItem->getUpc()] = $foodItem;
}

function edit_product($currentUpc, $foodItem) {
    if (!isset($_SESSION['db'][$currentUpc])) {
        die("Cannot edit a product with a UPC code that does not exist");
    }
    
    get_product($currentUpc)->edit($foodItem);
}

function delete_product($upc) {
    unset($_SESSION['db'][$upc]);
}

function get_product($upc) {
    if (isset($_SESSION['db'][$upc])) {
        return $_SESSION['db'][$upc];
    }
    else {
        return NULL;
    }
}

function get_all() {
    return $_SESSION['db'];
}

if (!isset($_SESSION['db'])) {
    $_SESSION['db'] = array();
    
    add_product(new FoodItem("123", "Chicken", "4.99"));
    add_product(new FoodItem("456", "Potatoes", "5.99"));
    add_product(new FoodItem("789", "Beef", "7.99"));
}

?>
