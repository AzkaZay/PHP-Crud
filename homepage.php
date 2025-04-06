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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
        body {
            background-image:  url(bg4.jpg);
            background-size: cover;
            background-position: center;
            color: white;
        }

        .navbar {
            background-color: rgba(63, 4, 53, 0.8);
            opacity:80%;
        }

        .wrapper, .wrapper2, .wrapper3 {
            width: 30%;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid white;
            background-size: cover;  
            background-position: center;
            background-repeat: no-repeat;
            transition: box-shadow 0.3s ease-in-out; /* Smooth transition */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;

        }

        /* Box shadow effect on hover */
        .wrapper:hover, .wrapper2:hover, .wrapper3:hover {
            box-shadow: 10px 30px 70px rgba(241, 237, 237, 0.86);
        }

        .wrapper {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(home.jpg);
        }

        .wrapper2 {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(home1.jpg);
        }

        .wrapper3 {
            background-image: linear-gradient(rgba(20,4,30,0.5), rgba(20,4,30,0.5)), url(home2.jpg);
        }
        .wrapper:hover, .wrapper2:hover, .wrapper3:hover {
            transform: scale(1.1); /* Zoom effect */
            box-shadow: 10px 10px 20px rgba(255, 255, 255, 0.5); 
            transition-duration: 0.5s ease-in-out;
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
        #searchpad{
            opacity: 60%;
            display: flex;
            justify-content: center;
            padding-left: 30%;
            padding-right: 30%;
            opacity: 0.8;
            margin-top: 20px;
            position: relative;
            z-index: 100;
        }

        #searchpad input[type="search"] {
            border: none;
            outline: none;
            box-shadow: none;
            border-bottom: 2px solid #ccc; /* Optional: add a subtle line instead */
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
        }

        #search-addon {
            background-color: white;
            border: none;
        }
        #search-container {
            position: relative;
            width: 100%;
            margin: 20px auto;
        }
        .suggestion-box {
            list-style-type: none;
            padding: 0;
            margin-left: 30%;
            width: 40%;
            background-color: white;
            border: 1px solid #ccc;
            position: absolute;
            top: 100%; /* Directly below the input */
            left: 0;
            z-index: 1000;
            color: black;
            max-height: 150px;
            overflow-y: auto;
            overflow-x: auto;
            border-radius: 0 0 8px 8px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }

        .suggestion-box li {
            padding: 8px 10px;
            cursor: pointer;
        }

        .suggestion-box li:hover {
            background-color: #eee;
        }


    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
        <script>
        const pages = {
            "Home": "homepage.php",
            "Homepage": "homepage.php",
            "Dashboard": "Dashboard.php",
            "Orders": "Dashboard.php",
            "catalogue": "catalogue.php",
            "Contact": "contact.php",
            "Contact Us": "contact.php",
            "About": "contact.php"
        };

        function showSuggestions() {
            const input = document.getElementById("siteSearch").value.toLowerCase();
            const suggestionBox = document.getElementById("suggestions");
            suggestionBox.innerHTML = "";

            if (input.length === 0) {
                return;
            }

            for (let key in pages) {
                if (key.toLowerCase().includes(input)) {
                    const li = document.createElement("li");
                    li.textContent = key;
                    li.onclick = function() {
                        document.getElementById("siteSearch").value = key;
                        suggestionBox.innerHTML = "";
                        window.location.href = pages[key];
                    };
                    suggestionBox.appendChild(li);
                }
            }
        }

        function searchPage() {
            const query = document.getElementById("siteSearch").value.toLowerCase();
            for (let key in pages) {
                if (key.toLowerCase() === query) {
                    window.location.href = pages[key];
                    return;
                }
            }
            alert("Page not found!");
        }
        </script>


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
            <br/>
            <div class="container mt-3">
        <div class="row">
            <div class="wrapper" id="hov">
            <h2 class="text-center">
            <a href="Dashboard.php" style="text-decoration: none; color: inherit;">List</a>
            </h2>
                <p class="text-center">List of Orders</p>
                <p class="text-center">Click here to view Muliple Orders of the Website.</p>
            </div>
            <div class="wrapper2" id="hov">
            <h2 class="text-center">
            <a href="create.php" style="text-decoration: none; color: inherit;">Orders</a>
            </h2>                
            <p class="text-center">Add Record</p>
                <p class="text-center">Add your details to the form for a registered record.</p>
            </div>
            <div class="wrapper3" id="hov">
            <h2 class="text-center">
            <a href="catalogue.php" style="text-decoration: none; color: inherit;">Catalogue</a>
            </h2>
                <p class="text-center">Gallery of our Products</p>
                <p class="text-center">Browse through our catalogue to order with ease.</p>
            </div>
        </div>
    </div>
</div>
    <div id="search-container">
        <div class="input-group rounded" id="searchpad">
            <input type="search" id="siteSearch" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" oninput="showSuggestions()" onkeydown="if(event.key === 'Enter') searchPage()" autocomplete="off"/>
            <span class="input-group-text border-0" id="search-addon" onclick="searchPage()" style="cursor: pointer;">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <ul id="suggestions" class="suggestion-box"></ul>
    </div>

</body>
</html>
