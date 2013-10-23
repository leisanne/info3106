<?php

require_once 'FoodItem.php';
require_once 'database.php';


/*
 * File contents:
 *  A: View helpers (assist in the creation of the views)   LINE 12
 *  B: Operation implementations (business logic)           LINE 44
 *  C: Routing logic                                        LINE 103
 */

/*
 * A: VIEW HELPERS
 * 
 * Some views (product.php in particular) require some parameters to be
 * set before they can be used. These functions capture that logic
 * 
 */

function display_new_product_page() {
    $editing = 0;
    $upc = "";
    $description = "";
    $price = "";

    include('product.php');
}

function display_edit_product_page($item_to_edit) {
    // Note that $item_to_edit is the product array, not just the UPC
    
    // $editing and $upc are the same
    $editing = $upc = $item_to_edit->getUpc();
    $description = $item_to_edit->getDescription();
    $price = $item_to_edit->getPrice();
    
    include('product.php');
}

function display_main_page() {
    include('list.php');
}

/*
 * B: WEB APPLICATION OPERATION IMPLEMENTATION
 * 
 * The following six functions are implementations of the six different
 * operations that this web application supports. They are called by the routing
 * logic below this.
 * 
 * 
 */

function get_list_all_products() {
    // Display the main page (which will include main.php)
    display_main_page();
}

function get_delete_product() {
    // We need a upc for this operation
    if (!isset($_GET['upc'])) 
        die("Expected upc for the delete operation");
    
    // Go to the database and delete the product
    delete_product($_GET['upc']);
    
    // Now, list all products
    get_list_all_products();
}

function get_new_product() {
    // Display the new product page
    display_new_product_page();
}

function get_edit_product() {
    // We need a upc specified for this operation
    if (!isset($_GET['upc'])) 
        die("Expected upc for the edit operation");
    
    // First, retrieve the item identified by the UPC
    $item = get_product($_GET['upc']);
    // Then, display the edit page for this item
    display_edit_product_page($item);
}

function post_new_product() {
    // Add the product
    add_product(new FoodItem(
            $_POST['upc'], 
            $_POST['description'], 
            $_POST['price']
            ) 
    );
    
    // Now, list all products
    get_list_all_products();
}

function post_edit_product() {
    // Edit the product
    edit_product($_POST['editing'], new FoodItem(
            $_POST['upc'], 
            $_POST['description'], 
            $_POST['price']
            )
    );
    
    
    // Now, list all products
    get_list_all_products();
}

/*
 * 
 * C: ROUTING LOGIC
 * 
 * The following are for routing the request. We first use the request method
 * and then either $_GET['action'] (for GET requests) or $_POST['editing'] 
 * (for POST requests)
 * 
 */

// If we are using GET, this means that we need to display some 
// sort of content.
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // The default action is list
    $action = "list";
    // But if one is specified, then let's extract it
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    
    
    
    // If the action is 'list'
    if ($action == "list") {
        get_list_all_products();
    }
    // If the action is 'delete'
    else if ($action == "delete") {
        get_delete_product();
    }
    // If the action is 'new'
    else if ($action == "new") {
        get_new_product();
    }
    // If the action is 'edit'
    else if ($action == "edit") {
        get_edit_product();
    }
    // Or if the action is invalid
    else {
        get_list_all_products();
    }
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If we are editing (as signified by the hidden 'editing' field
    // in the form being non-zero), then execute the update_product function
    if ($_POST['editing'] > 0) {
        // Edit the product
        post_edit_product();
    }
    else {
        // Add the new product
        post_new_product();
    }

}


?>
