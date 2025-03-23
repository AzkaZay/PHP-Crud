<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(bg4.jpg);
            background-size: cover;
            background-position: center;
            color: white;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
            opacity:80%;
        }

        .wrapper {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
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

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.3);
            color: white;
            border: 1px solid red;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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

    <table>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 style="text-align:center">Bakin Codes</h2>
                        <br></br>
                        <p style="text-align:center">Welcome to the Bakin'Codes php website</p>
                        <p style="text-align:center">This webApp was built with PHP, HTML, CSS</p>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</table>
</body>
</html>
