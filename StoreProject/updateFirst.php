<?php
/*
 * Author: Omar Lopez Vie 
 *  */
session_start();
    $_SESSION['id_search'] = $_POST['submit'];
?>
<html>
    <head>
        <title>Update User - Administrator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleRegisterPage.css">
    </head>
    <body>
        <div>
            <?php
            echo "<form action='update.php' method='post'>
                <b style='text-align: center; font-size: 25px;'>User Update Form</b><br><br>
                <label for='uid'>USERNAME: </label><br>
                <input type='text' name='uid' value='".$_SESSION["user_alias".$_SESSION['id_search']]."'/><br><br>
                <label for='pwd'>PASSWORD:</label><br>
                <input type='password' name='pwd' value='". $_SESSION["user_password".$_SESSION['id_search']]."'/><br><br>
                <label for='name'>NAME:</label><br>
                <input type='text' name='name' value='". $_SESSION["user_name".$_SESSION['id_search']]."'/><br><br>
                <label for='email'>E-MAIL:</label><br>
                <input type='text' name='email' value='".$_SESSION["user_email".$_SESSION['id_search']]."'/><br><br>
                <button id='btn' type='submit' name='submit'>UPDATE</button><br>
            </form>";  
            ?>
            <button id="btn" style="display:inline;" onclick="window.location.href = 'admin.php'">GO BACK</button>
        </div>
    </body>
</html>