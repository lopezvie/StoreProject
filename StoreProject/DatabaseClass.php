<?php

/*
 * Author: Omar Lopez Vie 
 *  */

class Database {

    private $admin = 'admin';
    private $adminPwd = '2525';
    private $host = '209.129.8.7';
    private $user = 'lopezvie';
    private $pass = 'Anthony1';
    private $dbname = 'lopezvie_48947';
    private $userT = 'users';
    private $productT = 'product';
    private $cartT = 'cart';
    private $conn;

    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        //Check connection
        if ($this->conn->connect_error) {
            die("Data Base Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }

    public function insertDB($n, $e, $p, $u) {
        $query = "INSERT INTO " . $this->userT . "
                       (user_name,user_email,user_password,
                        user_initDate,user_alias) VALUES ('" . $n . "' , '" . $e . "' , '" . $p . "' , '" . date('Ymd') . "' , '" . $u . "');";
        if ($this->conn->query($query) === TRUE) {
            echo "<h1>User Registered in " . $this->dbname . "</h1>";
            header("Location: loginPage.html");
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function selectU($uid, $pwd) {
        $sql = "SELECT * FROM users WHERE user_name='$uid' AND user_password='$pwd'";
        $result = $this->conn->query($sql);

        if (!$row = $result->fetch_assoc()) {
            echo "Invalid User";
            header("Location: loginPage.html");
        } else {
            $_SESSION["id_user"] = $row["id_user"]; //****************** Redirect User to Home Page ->header("Location: loginPage.php");
            $_SESSION["user_name"] = $row["user_name"];
            $_SESSION["user_email"] = $row["user_email"];
            $_SESSION["user_password"] = $row["user_password"];
            $_SESSION["user_initDate"] = $row["user_initDate"];
            $_SESSION["user_alias"] = $row["user_alias"];
            header("Location: storeHome.php");
        }
    }

    public function selectDB() {
        $query = "SELECT id_user, user_name, user_email, user_password, user_initDate, user_alias FROM " . $this->userT;
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Date</th><th>User Name</th><th>Update User</th><th>Delete User</th></tr>";
            // output data of each row
            while ($re = $result->fetch_assoc()) {
                echo "<tr><td>" . $re["id_user"] . "</td>";
                echo "<td>" . $re["user_name"] . "</td> ";
                $_SESSION["user_name" . $re["id_user"]] = $re["user_name"];
                echo "<td>" . $re["user_email"] . "</td>";
                $_SESSION["user_email" . $re["id_user"]] = $re["user_email"];
                echo "<td>" . $re["user_password"] . "</td>";
                $_SESSION["user_password" . $re["id_user"]] = $re["user_password"];
                echo "<td>" . $re["user_initDate"] . "</td>";
                echo "<td>" . $re["user_alias"] . "</td>";
                $_SESSION["user_alias" . $re["id_user"]] = $re["user_alias"];
                echo '<td><form action="updateFirst.php" method="post"><div id="buttons"><button id="update" type="submit" name="submit" value="' . $re["id_user"] . '">update</button></div></form></td>';
                echo '<td><form action="delete.php" method="post"><div id="buttons"><button id="delete" type="submit" name="submit" value="' . $re["id_user"] . '">delete</button></div></form></td></tr>';
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    public function displayCart($ui) {
        $_SESSION["user_total"] = 0.0;
        $sum = 0.0;
        if (isset($_GET['product'])) {
            $name = $_GET["product"];
            $q1 = "SELECT product_name,product_price FROM " . $this->productT . " WHERE product_name='" . $name . "';";
            $r1 = $this->conn->query($q1);
            if ($r1->num_rows > 0) {
                while ($re = $r1->fetch_assoc()) {
                    $pn = $re["product_name"];
                    $pr = $re["product_price"];
                }
            }
            $q2 = "INSERT INTO " . $this->cartT . "
                       (id_user,product_name,product_price) VALUES ('" . $ui . "' , '" . $pn . "' , '" . $pr . "');";
            $this->conn->query($q2);
        }
        $q3 = "SELECT id_cart, id_user, product_name, product_price FROM " . $this->cartT . " WHERE id_user='" . $ui . "';";
        $r8 = $this->conn->query($q3);
        if ($r8->num_rows > 0) {
            echo "<table><tr><th>Product</th><th>Price</th><th>Delete</th></tr>";
            while ($re = $r8->fetch_assoc()) {
                echo "<tr><td>" . $re["product_name"] . "</td>";
                echo "<td>" . $re["product_price"] . "</td>";
                $sum += $re["product_price"] * 1;
                $_SESSION["user_total"] += $re["product_price"] * 1;
                echo "<td style='width:19%;'><form action='deleteItem.php' method='post'><button style='width:25%;' id='delete' type='submit' name='submit' value='" . $re["id_cart"] . "'>delete</button></form></td></tr>";
            }
            echo "<tr><td style='text-align:right;'>Total:</td>";
            echo "<td style='text-align:left;'>" . $sum . "</td><td> + tax</td></tr>";
            echo "</table>";
        } else {
            echo "<table><tr><th>Product</th><th>Price</th><th>Delete</th></tr>";
            echo "<tr><td>0 Items</td><td>. . .</td><td>. . .</td></tr></table>";
        }
    }

    public function displayProduct() {
        $query = "SELECT product_name, product_desc, product_price, product_img FROM " . $this->productT . ";";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($re = $result->fetch_assoc()) {
                echo "<div class='case'>";
                echo "<h1>" . $re["product_name"] . "</h1><br>";
                echo "<img class='imgCase' src='" . $re["product_img"] . "'>";
                echo "<p>" . $re["product_desc"] . "</p>";
                echo "<form action='cart.php' method='get'><button name='product' value='" . $re["product_name"] . "' class='btn'>"
                . $re["product_price"] . "</button></form></div>";
            }
        } else {
            echo "0 results";
        }
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getadminPWD() {
        return $this->adminPwd;
    }

    public function creteTable($tableName) {
        $argUsers = "CREATE TABLE " . $tableName . "(
        id_user int(11) not null AUTO_INCREMENT PRIMARY KEY,
        user_name varchar(256) not null,
        user_email varchar(256) not null,
        user_password varchar(256) not null,
        user_initDate date not null,
        user_alias varchar(256) not null
        );";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "Table Created Remotely";
        } else {
            echo "Error: Table was NOT Created " . $this->conn->error . "<br>";
        }
    }

    public function createDB($database) {
        $argUsers = "CREATE DATABASE " . $database . ";";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "Database Created Remotely";
        } else {
            echo "Error: Database was NOT Created " . $this->conn->error . "<br>";
        }
    }

    public function deleteUser($user_id) {
        $argUsers = "DELETE FROM " . $this->userT . " WHERE id_user='" . $user_id . "';";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Deleted";
            header("Location: admin.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function deleteCart($user) {
        $argUsers = "DELETE FROM " . $this->cartT . " WHERE id_user='" . $user . "';";

        if ($this->conn->query($argUsers) === TRUE) {
            header("Location: done.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function deleteItem($cart_id) {
        $argUsers = "DELETE FROM " . $this->cartT . " WHERE id_cart='" . $cart_id . "';";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Deleted";
            header("Location: cart.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function updateUser($user_id, $user_name, $user_email, $user_password, $user_alias) {
        $argUsers = "UPDATE " . $this->userT . " SET "
                . " user_name='" . $user_name . "',"
                . " user_email='" . $user_email . "',"
                . " user_password='" . $user_password . "',"
                . " user_alias='" . $user_alias . "'"
                . " WHERE id_user = '" . $user_id . "';";

        echo $argUsers;
        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Updated";
            header("Location: admin.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function createUser($n, $e, $p, $u) {
        $query = "INSERT INTO " . $this->userT . "
                       (user_name,user_email,user_password,
                        user_initDate,user_alias) VALUES ('" . $n . "' , '" . $e . "' , '" . $p . "' , '" . date('Ymd') . "' , '" . $u . "');";
        if ($this->conn->query($query) === TRUE) {
            echo "<h1>User Registered in " . $this->dbname . "</h1>";
            header("Location: admin.php");
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function insertProduct($n, $d, $p) {
        $target_dir = "css/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        if (isset($_POST["submit"])) {
            $query = "INSERT INTO " . $this->productT . "
                       (product_name,product_desc,product_price,
                        product_img) VALUES ('" . $n . "' , '" . $d . "' , '" . $p . "' ,  'css/img/" . basename($_FILES["fileToUpload"]["name"]) . "');";
            if ($this->conn->query($query) === TRUE) {
                echo "<h1>User Registered in " . $this->dbname . "</h1>";
                $this->dataProduct();
            } else {
                echo "Error: " . $query . "<br>" . $this->conn->error;
            }
        }
    }

    public function dataProduct() {
        $query = "SELECT id_product, product_name, product_desc, product_price, product_img FROM " . $this->productT;
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>File Path</th><th>Update User</th><th>Delete User</th></tr>";
            // output data of each row
            while ($re = $result->fetch_assoc()) {
                echo "<tr><td>" . $re["id_product"] . "</td>";
                echo "<td>" . $re["product_name"] . "</td> ";
                $_SESSION["product_name" . $re["id_product"]] = $re["product_name"];
                echo "<td>" . $re["product_desc"] . "</td>";
                $_SESSION["product_desc" . $re["id_product"]] = $re["product_desc"];
                echo "<td>" . $re["product_price"] . "</td>";
                $_SESSION["product_price" . $re["id_product"]] = $re["product_price"];
                echo "<td>" . $re["product_img"] . "</td>";
                $_SESSION["product_img" . $re["id_product"]] = $re["product_img"];
                echo '<td><form action="updateProductFirst.php" method="post"><div id="buttons"><button id="update" type="submit" name="submit" value="' . $re["id_product"] . '">update</button></div></form></td>';
                echo '<td><form action="deleteProduct.php" method="post"><div id="buttons"><button id="delete" type="submit" name="submit" value="' . $re["id_product"] . '">delete</button></div></form></td></tr>';
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    public function deleteProduct($p_id) {
        $argUsers = "DELETE FROM " . $this->productT . " WHERE id_product='" . $p_id . "';";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Deleted";
            header("Location: showProduct.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function updateProduct($pname, $desc, $price, $file, $id) {
        $argUsers = "UPDATE " . $this->productT . " SET "
                . " product_name ='" . $pname . "',"
                . " product_desc='" . $desc . "',"
                . " product_price='" . $price . "',"
                . " product_img='" . $file . "'"
                . " WHERE id_product = '" . $id . "';";

        echo $argUsers;
        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Updated";
            header("Location: showProduct.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

}

$db = new Database();

