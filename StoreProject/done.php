<?php
session_start();

include 'DatabaseClass.php';
$user = strtoupper($_SESSION['user']);
?>
<html>
    <head>
        <title>CART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/menu.css">
        <link rel="stylesheet" href="css/styleRegisterPage.css">
        <link rel="stylesheet" href="css/caseStyle.css">
        <link rel="stylesheet" href="css/tables.css">
    </head>
    <body>
        <ul>
            <li><a class="active" href="#home"><?php echo $user; ?></a></li>
            <li><a href="storeHome.php">HOME</a></li>
            <li><a href="destroySession.php">SIGN OUT</a></li>
        </ul>
        <?php
        echo $_SESSION["id_user"];
        ?>
        <h1 style="text-align: center">YOUR PURCHASED HAS BEEN PROCESSED</h1><br><br>
        <h1 style="text-align: center">THANK YOU!</h1><br><br>
        <button style="float: right;" class="btn" onclick="window.location.href = 'storeHome.php'">HOME</button><br><br><br><br>
    </body>
</html>