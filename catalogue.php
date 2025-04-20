    <?php
    session_start();
    include('db.php');
    $status = "";

    if (isset($_POST['code']) && $_POST['code'] != "") {
        $code = $_POST['code'];
        $result = mysqli_query($con, "SELECT * FROM `products` WHERE `code`='$code'");
        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $code = $row['code'];
        $price = $row['price'];
        $image = $row['image'];

        $cartArray = array(
            $code => array(
                'name' => $name,
                'code' => $code,
                'price' => $price,
                'quantity' => 1,
                'image' => $image
            )
        );

        if (empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='message_box'>Product is added to your cart!</div>";
        } else {
            $array_keys = array_keys($_SESSION["shopping_cart"]);
            if (in_array($code, $array_keys)) {
                $status = "<div class='message_box' style='color:red;'>Product is already added to your cart!</div>";
            } else {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
                $status = "<div class='message_box'>Product is added to your cart!</div>";
            }
        }
    }
    ?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Catalogue</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                background-image: linear-gradient(rgba(20, 4, 30, 0.5), rgba(20, 4, 30, 0.5)), url(bg5.jpg);
                background-size: cover;
                background-position: center;
                color: white;
            }

            .navbar {
                background-color: rgba(63, 4, 53, 0.8);
            }

            h2 {
                text-align: center;
                padding: 15px;
                background-color: rgba(53, 6, 43, 0.8);
                border-radius: 10px;
                margin: 20px auto;
                width: 30%;
            }

            .product_wrapper {
                display: inline-block;
                width: 22%;
                margin: 20px 1%;
                text-align: center;
                background-color: rgba(255, 255, 255, 0.1);
                padding: 15px;
                border-radius: 10px;
                transition: transform 0.3s ease;
                color: white;
            }

            .product_wrapper:hover {
                transform: scale(1.05);
                box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.3);
            }

            .product_wrapper img {
                width: 100%;
                height: auto;
                border-radius: 10px;
            }

            .product_wrapper .name {
                margin-top: 10px;
                font-weight: bold;
                font-size: 18px;
            }

            .product_wrapper .price {
                margin-top: 5px;
                font-size: 16px;
            }

            .buy {
                background-color: rgb(100, 36, 86);
                color: white;
                border: none;
                padding: 8px 15px;
                margin-top: 10px;
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s ease-in-out;
            }

            .buy:hover {
                background-color: rgb(180, 121, 180);
            }

            .cart_div {
                position: fixed;
                top: 10px;
                right: 10px;
                background-color: rgba(63, 4, 53, 0.9);
                padding: 10px 15px;
                border-radius: 5px;
                font-size: 16px;            
                margin-top: 30%;

            }

            .cart_div a {
                color: white;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .cart_div:hover {
                background-color: rgb(180, 121, 180);
                cursor: pointer;
            }

            .cart_div img {
                width: 20px;
                height: 20px;
            }

            .message_box {
                margin: 15px auto;
                padding: 10px;
                background-color: rgba(255, 255, 255, 0.2);
                color: white;
                border-radius: 5px;
                text-align: center;
                width: 60%;
            }
        </style>
        </head>

        <body>

        <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Bakin'Codes Orders</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="PHP-Crud/Dashboard.php">Orders</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

        <h2>Catalogue</h2>

        <?php
        if (!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            echo "<div class='cart_div'>
                    <a href='cart.php'><i class='fas fa-shopping-cart'></i> Cart <span>$cart_count</span></a>
                </div>";
        }

        ?>

        <div class="container text-center">
            <?php
            $result = mysqli_query($con, "SELECT * FROM `products`");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product_wrapper'>
                        <form method='post' action=''>
                            <input type='hidden' name='code' value='" . $row['code'] . "' />
                            <div class='image'><img src='" . $row['image'] . "' alt='Product Image' /></div>
                            <div class='name'>" . $row['name'] . "</div>
                            <div class='price'>$" . $row['price'] . "</div>
                            <button type='submit' class='buy'>Buy Now</button>
                        </form>
                    </div>";
            }
            mysqli_close($con);
            ?>
        </div>

        <div class="message_box"><?php echo $status; ?></div>

        </body>
    </html>
