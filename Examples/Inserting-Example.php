
<?php
require_once 'Tables/Food.php';
// Insert a single value 
//Food::insert("name", "Burger");

// Insert multiple values
//Food::insert(["name" => "Pancakes", "type" => "Dessert"]);

// Insert value if "Humus" does not exist 
//Food::insert("name", "Humus")->isNonExistent();

// Insert value if "Burger" does not exist and get bool
//var_dump(Food::insert("name", "Humus")->isNonExistent("name", "Burger")->getBool());

// Insert value if "Pancakes" with type "Dessert" does not exist 
//Food::insert("name", "Humus")->isNonExistent(["name" => "Pancakes", "type" => "Dessert"]);

// Insert a single value ~ returns id of inserted row
//var_dump(Food::insert("name", "Burger")->getID());

?>
