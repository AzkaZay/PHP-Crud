<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $sprinkles = $flavour = $price = "";
$name_err = $name_err = $sprinkles_err = $flavour_err = $price_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    //// Validate sprinkles
    $input_sprinkles = trim($_POST["sprinkles"]);
    if (empty($input_sprinkles)) {
        $sprinkles_err = "Please use '-' if sprinkles are not required.";
    } else {
        $sprinkles = $input_sprinkles;
    }
    //// Validate flavour
    $input_flavour = trim($_POST["flavour"]);
    if (empty($input_flavour)) {
        $flavour_err = "Please use '-' if flavour is not required.";
    } else {
        $flavour = $input_flavour;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price.";
    } elseif (!ctype_xdigit($input_price)) {
        $price_err = "Please enter a positive integer value.";
    } else {
        $price = $input_price;
    }

 
    if (empty($name_err) && empty($sprinkles_err) && empty($flavour_err) && empty($price_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO orders (name, sprinkles, flavour, price) VALUES (?, ?, ?, ?)";

 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('sssd', $param_name, $param_sprinkles, $param_flavour, $param_price);
            
            $param_name = $name;
                    $param_sprinkles = $sprinkles;
                    $param_flavour = $flavour;
                    $param_price = $price;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: Dashboard.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    
        $stmt->close();
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        body {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(bg2.jpg);
            background-size: cover;
            background-position: center;
            color: white;
        }
        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
            opacity:80%;
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
                            <li class="nav-item"><a class="nav-link" href="Dashboard.php">Orders</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add pastry record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>* Name :</label>
                            <input type="text" name="name"
                                class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $name; ?>">
                            <span class="invalid-feedback">
                                <?php echo $name_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>* Sprinkles :</label>
                            <input type="text" name="sprinkles"
                                class="form-control <?php echo (!empty($sprinkles_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $sprinkles; ?>">
                            <span class="invalid-feedback">
                                <?php echo $sprinkles_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>* Flavour :</label>
                            <input type="text" name="flavour"
                                class="form-control <?php echo (!empty($flavour_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $flavour; ?>">
                            <span class="invalid-feedback">
                                <?php echo $flavour_err; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>* Price$ :</label>
                            <input type="text" name="price"
                                class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $price; ?>">
                            <span class="invalid-feedback">
                                <?php echo $price_err; ?>
                            </span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit" href="Dashboard.php">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>