<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once 'Food.php';
        Food::insert("name", "hans")->dontExist()->execute();
        Food::insert("name", "klaus")->dontExist()->execute();
        ?>
    </body>
</html>