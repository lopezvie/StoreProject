<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
$_SESSION['product_turn'] = $_POST['submit'];
?>
<html>
    <head>
        <title>Update Product - Administrator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleRegisterPage.css">
    </head>
    <body>
        <div>
            <?php
            echo "<form action='updateProduct.php' method='post' enctype='multipart/form-data'>
                <b style='text-align: center; font-size: 25px;'>Product Update Form</b><br><br>
                <label for='uid'>PRODUCT NAME: </label><br>
                <input type='text' name='name' value='" . $_SESSION["product_name".$_SESSION['product_turn'] ] . "'/><br><br>
                <label for='pwd'>DESCRIPTION:</label><br>
                <input type='text' name='desc' value='" . $_SESSION["product_desc".$_SESSION['product_turn'] ] . "'/><br><br>
                <label for='name'>PRICE:</label><br>
                <input type='text' name='price' value='" . $_SESSION["product_price".$_SESSION['product_turn'] ] . "'/><br><br>
                <label for='email'>IMAGE FILE:</label><br>
                <input type='text' name='file' value='" . $_SESSION["product_img".$_SESSION['product_turn'] ] . "'/><br><br>
                <button id='btn' type='submit' name='submit'>UPDATE</button><br>
            </form>";
            ?>
            <button id="btn" style="display:inline;" onclick="window.location.href = 'admin.php'">GO BACK</button>
        </div>
    </body>
</html>

