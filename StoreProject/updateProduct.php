<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
?>
<html>
    <head>
        <title>Update Product - Administrator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
    </head>
    <body>
        <?php
        include 'DatabaseClass.php';

        if (isset($_POST['submit'])) {
            $pname = $_POST['name'];
            $desc = $_POST['desc'];
            $price = $_POST['price'];
            $file = $_POST['file'];
            $id = $_SESSION['product_turn'];

            $db->updateProduct($pname, $desc, $price, $file, $id);
        }
        ?>
    </body>
</html>
