<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
?>
<html>
    <head>
        <title>CHECK OUT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleRegisterPage.css">
    </head>
    <body>
        <div>
            <?php
            echo "<form action='deleteCart.php' method='post'>
                <b style='text-align: center; font-size: 25px;'>CHECK OUT</b><br><br>
                <label for='name'>NAME: </label><br>
                <input type='text' name='name' value='".$_SESSION["user_name"]."'/><br><br>
                <label for='email'>E-MAIL:</label><br>
                <input type='text' name='pwd' value='". $_SESSION["user_email"]."'/><br><br>
                <label for='address'>DELIVERING ADDRESS:</label><br>
                <input type='text' name='address' placeholder='Delivering Address'/><br><br>
                <label for='form'>FORM OF PAYMENT:</label><br>
                <select name='form'><option value='visa'>VISA</option><option value='masterCard'>MASTER CARD</option><option value='bitcoin'>BITCOIN</option><option value='paypal'>PAYPAL</option></select><br><br>
                <label for='account'>ACCOUNT NUMBER:</label><br>
                <input type='text' name='account' placeholder='Account Number'/><br><br>
                <label for='total'>TOTAL :</label><br>
                <input type='text' name='total' value='".$_SESSION["user_total"]."' disabled/><br><br>
                <button id='btn' type='submit' name='submit'>PLACE ORDER</button><br>
            </form>";
            ?>
            <button id="btn" style="display:inline;" onclick="window.location.href = 'cart.php'">GO BACK</button>
        </div>
    </body>
</html>
