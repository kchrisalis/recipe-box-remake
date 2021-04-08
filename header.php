<?php
?>

<head>
    <!-- Bootstrap Component -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- style sheet -->
    <style type="text/css">
        .forms {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
            background-color: #a1c6cc;
        }

        .previews {
            background-color: #b0cad1;
        }

        .bg {
            background-image: url('https://images.pexels.com/photos/3186654/pexels-photo-3186654.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        table {
            background-color: #a1c6cc;
        }

        .submitbtn {
            background-color: #fafcfc;
        }

        .title {
            color: white;
            text-align: center;
            padding: 10px;
            text-decoration: underline;
        }
        
    </style>
</head>

<body class="bg">
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex sticky-top justify-content-lg-between px-4">

        <a class="h3 text-white mx-3" href="index.php">Recipe Box</a>
        <!-- Nav Bar Dropdown-->
        <?php
        if (isset($_SESSION['userID'])) :
            $userNavBar = $_SESSION['userID'];
            if ($userNavBar != 'Admin') : ?>
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Welcome, " . $_SESSION['userID']; ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="user-page.php">User Homepage</a>
                        <a class="dropdown-item" href="recipe-form.php">Create Recipe</a>
                        <a class="dropdown-item" href="favourites.php">Favourite Recipes</a>
                        <a class="dropdown-item" href="endSession.php">Log Out</a>
                    </div>
                </div>


            <?php elseif ($userNavBar == 'Admin') : ?>
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Welcome, " . $_SESSION['userID']; ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="admin-page.php">Admin Page</a>
                        <a class="dropdown-item" href="recipe-form.php">Create Recipe</a>
                        <a class="dropdown-item" href="endSession.php">Log Out</a>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <a class="btn btn-primary mx-3" href="signin.php" role="button">Sign In</a>
            <?php endif; ?>

    </nav>