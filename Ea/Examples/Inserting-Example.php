
<?php
require_once 'Class/Food.php';
// Insert a single value ~ returns success as bool
Food::insert("name", "Burger")->execute();

// Insert multiple values ~ returns success as bool
Food::insert(["name" => "Pancakes", "type" => "Dessert"])->execute();

// Insert value if "Humus" does not exist ~ returns success as bool
//Food::insert("name", "Humus")->isNonExistent()->execute();

// Insert value if "Burger" does not exist ~ returns success as bool
//Food::insert("name", "Humus")->isNonExistent("name", "Burger")->execute();

// Insert value if "Pancakes" with type "Dessert" does not exist ~ returns success as bool
//Food::insert("name", "Humus")->isNonExistent(["name" => "Pancakes", "type" => "Dessert"])->execute();

// Insert a single value ~ returns id of inserted row
//echo Food::insert("name", "Burger")->returnId()->execute();

?>
