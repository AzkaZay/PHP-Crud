<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $sprinkles = $flavour = $price = "";
$name_err = $name_err = $sprinkles_err = $flavour_err = $price_err = "";

 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate address address
    $input_sprinkles = trim($_POST["sprinkles"]);
    if(empty($input_sprinkles)){
        $sprinkles_err = "Please fill this area.";     
    } else{
        $sprinkles = $input_sprinkles;
    }
    
    $input_flavour = trim($_POST["flavour"]);
    if(empty($input_flavour)){
        $flavour_err = "Please fill this area.";     
    } else{
        $flavour = $input_flavour;
    }

    // Validate salary
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price.";     
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please fill this area.";
    } else{
        $price = $input_price;
    }
    
    // Check input errors before inserting in database
    if (empty($name_err) && empty($sprinkles_err) && empty($flavour_err) && empty($price_err)){
        // Prepare an update statement
        $sql = "UPDATE orders SET name=?, sprinkles=?, flavour=?, price=? WHERE id=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param('sssdi', $param_name, $param_sprinkles, $param_flavour, $param_price, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_sprinkles = $sprinkles;
            $param_flavour = $flavour;
            $param_price = $price;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: Dashboard.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM orders WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                    $sprinkles = $row["sprinkles"];
                    $flavour = $row["flavour"];
                    $price = $row["price"];
                    
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(bg5.jpg);
            background-size: cover;
            background-position: center;
            color: white;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
            opacity:80%;
        }

        .wrapper {
            width: 40%;
            max-width: 900px;
            min-height: auto; /* Ensures height adjusts dynamically */
            height: auto; /* Removes fixed height */
            margin: 30px auto; /* Reduce top margin */
            background-color: rgba(255, 255, 255, 0.1);
            padding: 15px; /* Reduce padding */
            border-radius: 10px;
            border: 2px solid white;
        }

        table {
            background-color:white;
            color: white;
        }

        table thead {
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
        }

        table tr td, table tr th {
            border-color: white;
        }

        table tr td a {
            color: white;
            margin-right: 10px;
        }
        H2{
            background-color:rgb(100, 36, 86);
            border-radius: 50%;
            margin-left:10%;
            margin-right: 10%;
            padding-top: 1%;
            padding-bottom: 1%;
            opacity: 80%;
            text-align: center;
        }

        .btn.btn.btn-primary {
            background-color:rgb(100, 36, 86);
            border-color:rgb(180, 121, 180); 
            opacity: 80%;
            align-items: center;
        }

        .btn.btn-primary:hover {
            background-color:rgb(180, 121, 180);
            transition: 0.3s ease-in-out;
        }
        .btn.btn-secondary.ml-2:hover{
            background-color:rgb(180, 121, 180);
            transition: 0.3s ease-in-out;
        }

        .container-fluid{
            padding: 5px;
        }

        .form-group{
            margin-bottom: 10px;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.3);
            color: white;
            border: 1px solid red;
        }
        .viewcss{
            color:rgba(63, 4, 53, 0.8);
            transition: 0.3s ease-in-out;
        }
        .viewcss:hover{
            color:lightpink;
            cursor: pointer;
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
                    <h2 class="mt-1 mb-2">Update Record</h2>
                    <p style="font-size: 12px;">Please edit the input values and submit to update the orders record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Sprinkles</label>
                            <input type="text" name="sprinkles" class="form-control <?php echo (!empty($sprinkles_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sprinkles; ?>">
                            <span class="invalid-feedback"><?php echo $sprinkles_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Flavour</label>
                            <input type="text" name="flavour" class="form-control <?php echo (!empty($flavour_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $flavour; ?>">
                            <span class="invalid-feedback"><?php echo $flavour_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err;?></span>
                        </div>
                        <div class="col-12 text-center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="Dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
