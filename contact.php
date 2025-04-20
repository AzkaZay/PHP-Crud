<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us | Bakin'Codes</title>
  
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-image: linear-gradient(rgba(20, 4, 30, 0.5), rgba(20, 4, 30, 0.5)), url(bg4.jpg);
            background-size: cover;
            background-position: center;
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
        }

        .container {
            margin-top: 60px;
            background-color: rgba(255, 255, 255, 0.08);
            padding: 30px;
            border-radius: 12px;
            border: 1.5px solid white;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        .contact-heading {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .contact-text {
            text-align: center;
            font-size: 1.2rem;
        }

        .social-icons {
            text-align: center;
            margin-top: 30px;
        }

        .social-icons a {
            color: white;
            margin: 0 15px;
            font-size: 2rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ffc0cb;
            transform: scale(1.2);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bakin'Codes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="catalogue.php">Catalogue</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- CONTACT SECTION -->
<div class="container text-center">
    <h2 class="contact-heading"><i class="fas fa-envelope-open-text me-2"></i>Contact Us</h2>
    <p class="contact-text">
        Welcome to Bakin'Codes, where sweet cravings meet clean code!<br>
    </p>
    <p>
    What started as a small passion project blending the love for baking and web development has grown into a cozy online bakery. Here, every order is made with care, creativity, and just the right amount of sugar. Whether you're celebrating something special or just need a pick-me-up treat, we've got you covered.

        At Bakin'Codes, we bake everything fresh to order using quality ingredients. 
        From soft, gooey cookies to beautifully frosted cupcakes, each item is handcrafted with love. And yes — we also run this whole bakery experience through a custom-built PHP web app. Geeky? Absolutely.<br>
        We're all about good vibes, good food, and great service. Thank you for being part of our sweet little journey.
    </p>
    <p><strong>Happy snacking & stay sweet!<br>– The Bakin'Codes Team 🍰</strong></p>
    <p>We'd love to hear from you! Whether it's a baking tip, tech chat, or just to say hi — reach out anytime.</p>
</div>

    
    <div class="social-icons">
        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://wa.me/yourphonenumber" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
</div>

</body>
</html>
