<?php
session_start(); // Start the session

// Initialize the cart if it's not set
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = [];
}

// Add product to the cart when the form is submitted
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $productQuantity = $_POST['quantity'];

    // Add product to cart or update quantity if it's already in the cart
    if (isset($_SESSION['shopping_cart'][$productId])) {
        $_SESSION['shopping_cart'][$productId]['quantity'] += $productQuantity; // Increase quantity
    } else {
        $_SESSION['shopping_cart'][$productId] = [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQuantity
        ];
    }
}

// Remove product from the cart
if (isset($_GET['remove'])) {
    $productIdToRemove = $_GET['remove'];
    unset($_SESSION['shopping_cart'][$productIdToRemove]); // Remove the item from the cart
}

// Calculate the total price
$totalPrice = 0;
foreach ($_SESSION['shopping_cart'] as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap 5 JS (Bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        body {
            background-image: url('bg4.jpg');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .container {
            margin-top: 60px;
            box-shadow: #333, 30px;
        }

        .btn-checkout {
            background-color:rgb(61, 9, 52);
            color: white;
            border: none;
        }

        .btn-checkout:hover {
            background-color:rgb(58, 8, 51);
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            font-size: 1.5rem;
            color: white;
        }

        .cart-heading {
            color: white;
            margin-bottom: 30px;
            text-align: center;
        }
        body {
            background-image: linear-gradient(rgba(20, 4, 30, 0.5), rgba(20, 4, 30, 0.5)), url(bg4.jpg);
            background-size: cover;
            background-position: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.85);
        }

        .container {
            margin-top: 60px;
        }

        .cart-heading {
            color: white;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;

        }
        .table tbody tr {
            background-image: linear-gradient(rgba(20, 4, 30, 0.5), rgba(20, 4, 30, 0.5)), url(bg4.jpg);
            color: black;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;

        }

        .table tbody tr:hover {
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }


        .table th {
            background-color: rgba(89, 6, 69, 0.85); /* Deep burgundy header */
            color: white;
            font-weight: 500;
        }

        .table td {
            background-color: rgba(255, 255, 255, 0.8);
            vertical-align: middle;
        }

        .btn-checkout {
            background-color:rgb(59, 6, 55);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            background-color:rgb(99, 28, 87);
            transform: scale(1.05);
        }

        .btn-danger {
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .empty-cart {
            text-align: center;
            padding: 40px;
            font-size: 1.5rem;
            color: white;
        }

        .btn-outline-light {
            border-radius: 8px;
            font-weight: 500;
        }
        .table {
    border-collapse: separate;
    border-spacing: 0 10px;
    background: transparent;
    color: white;
}

.table thead th {
    background-color: rgba(89, 6, 69, 0.9); /* Burgundy with a soft glow */
    color: white;
    border: none;
    padding: 16px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.table tbody tr {
    background-image: linear-gradient(rgba(36, 7, 45, 0.7), rgba(36, 7, 45, 0.7));
    background-size: cover;
    background-position: center;
    color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.table tbody tr:hover {
    transform: scale(1.015);
    box-shadow: 0 6px 16px rgba(0,0,0,0.35);
}

.table td {
    background: transparent;
    border: none;
    padding: 16px;
    vertical-align: middle;
}

.table td:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

.table td:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}


    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bakin'Codes Cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogue.php">Catalogue</a></li>
                <li class="nav-item"><a class="nav-link active" href="cart.php">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="cart-heading"><i class="fas fa-shopping-cart"></i> Your Cart</h2>

    <?php if (!empty($_SESSION['shopping_cart'])) : ?>
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-secondary text-center">
                    <th scope="col">Item</th>
                    <th scope="col">Price (Rs)</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total (Rs)</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                foreach ($_SESSION['shopping_cart'] as $id => $item) :
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                ?>
                    <tr class="text-center">
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= number_format($item['price'], 2) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($total, 2) ?></td>
                        <td>
                            <a href="cart.php?remove=<?= $id ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Remove
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="table-secondary text-center fw-bold">
                    <td colspan="3">Total</td>
                    <td colspan="2">Rs <?= number_format($grandTotal, 2) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="checkout.php" class="btn btn-checkout btn-lg">
                <i class="fas fa-credit-card"></i> Checkout
            </a>
        </div>
    <?php else : ?>
        <div class="empty-cart">
            <p>Your cart is currently empty 😢</p>
            <a href="catalogue.php" class="btn btn-outline-light mt-3">
                <i class="fas fa-shopping-bag"></i> Browse Products
            </a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
