<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
?>

<html>
    <head>
        <title>Database Administration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/tables.css">
    </head>
    <body>
        <?php
        include 'DatabaseClass.php';
        $db->dataProduct();
        ?>
        <div id="buttons">
            <button class="btn" onclick="window.location.href = 'destroySession.php'">SIGN OUT</button>
            <button class="btn" style="display:inline;" onclick="window.location.href = 'insertPage.html'">INSERT NEW PRODUCT</button>
            <button class="btn" style="display:inline;" onclick="window.location.href = 'admin.php'">HOME</button>
        </div>
    </body>
</html>

