<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM orders WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
                // URL doesn't contain valid id parameter. Redirect to error page
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
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
        }

        .wrapper {
            width: 40%;
            height: 400px;
            max-width: 900px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid white;
        }

        table {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            opacity: 90%;
        }

        table thead {
            background-color: rgba(255, 255, 255, 0.3);
            color: black;
        }


        table tr td a {
            color: white;
            margin-right: 10px;
            
        }
        h2{
            background-color:rgb(100, 36, 86);
            border-radius: 50%;
            margin-left:10%;
            margin-right: 10%;
            padding-top: 1%;
            padding-bottom: 1%;
            opacity: 80%;
        }

        .btn.btn.btn-primary {
            background-color:rgb(100, 36, 86);
            border-color:rgb(180, 121, 180); 
            opacity: 80%;
        }

        .btn.btn-primary:hover {
            background-color:rgb(180, 121, 180);
            transition: 0.3s ease-in-out;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.3);
            color: white;
            border: 1px solid red;
        }
        .viewcss{
            color:rgba(63, 4, 53, 0.8);
            transition: 0.3s ease-in-out;
            font-weight: bold;
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
                    <li class="nav-item"><a class="nav-link" href="PHP-Crud/homepage.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="PHP-Crud/Dashboard.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="PHP-Crud/contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="mt-3 mb-3">View Record</h2>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td class="viewcss"><?php echo $row["name"]; ?></td>
                        </tr>
                        <tr>
                            <th>Sprinkles</th>
                            <td class="viewcss"><?php echo $row["sprinkles"]; ?></td>
                        </tr>
                        <tr>
                            <th>Flavour</th>
                            <td class="viewcss"><?php echo $row["flavour"]; ?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td class="viewcss"><?php echo $row["price"]; ?></td>
                        </tr>
                    </table>

                    <a href="Dashboard.php" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>