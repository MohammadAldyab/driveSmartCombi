<?php
session_start();
$currentURL = $_SERVER['REQUEST_URI'];

// Function to check if the current page is active
function isActive($url)
{
    global $currentURL;
    if ($url === $currentURL) {
        return "active";
    } else {
        return "";
    }
}

// Check if the user is logged in
if (isset($_SESSION['email']['voornaam'])) {
    $loginLogoutText = "Logout";
    $loginLogoutLink = "/DriverSmart/views/loginsysteem/logout.php";
} else {
    $loginLogoutText = "Login";
    $loginLogoutLink = "/DriverSmart/views/loginsysteem/login.php";
}
if (isset($_SESSION['email'])) {
    $loginLogoutText = "Logout";
    $loginLogoutLink = "/DriverSmart/views/loginsysteem/logout.php";
} else {
    $loginLogoutText = "Login";
    $loginLogoutLink = "/DriverSmart/views/loginsysteem/login.php";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../../static/css/index.css">
</head>

<body>

    <div class="container-fluid bg-dark p-2 mb-3">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/DriverSmart/index.php">DriverSmart</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (isset($_SESSION['email'])) : ?>
                    <!-- Check that the session variable 'email' is set, which means the user is logged in -->
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <?php if (isset($_SESSION['email']['is_admin']) && $_SESSION['email']['is_admin'] == 1) : ?>
                                <!-- Only show these links if the user is an administrator -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link <?php echo isActive('/DriverSmart/views/dashboards/instructure_dashboard.php'); ?>" href="/DriverSmart/views/dashboards/instructure_dashboard.php" role="button">
                                        Admin Dashboard
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link <?php echo isActive('/DriverSmart/views/strippenkaart/index.php'); ?>" href="/DriverSmart/views/strippenkaart/index.php" role="button">
                                        stampcard
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link <?php echo isActive('/DriverSmart/views/lessbloack/index.php'); ?>" href="/DriverSmart/views/lessbloack/index.php" role="button">
                                        lessonblock
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Always show this link -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link <?php echo isActive('/DriverSmart/views/contact/contact_form.php'); ?>" href="/DriverSmart/views/contact/contact_form.php" role="button">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?php echo $loginLogoutLink; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $loginLogoutText; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/DriverSmart/views/loginsysteem/logout.php"> <?php echo $loginLogoutText; ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>