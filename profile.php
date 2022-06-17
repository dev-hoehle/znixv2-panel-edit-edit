<?php
require_once 'app/require.php';
require_once 'app/controllers/CheatController.php';

$user = new UserController();
$cheat = new CheatController();

Session::init();

if (!Session::isLogged()) {
    Util::redirect('auth/login.php');
}

$username = Session::get('username');
$uid = Session::get('uid');

$suc = @$_GET['suc'];

$sub = $user->getSubStatus();

Util::banCheck();
Util::head($username);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updatePassword'])) {
        $error = $user->updateUserPass($_POST);
    }
    if (isset($_POST['activateSub'])) {
        $error = $user->activateSub($_POST);
        header('location: profile.php?suc=1');
    } else {
        header('location: profile.php?suc=2');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php Util::navbar(); ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content" style="background: #121421;">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars" style="color: rgb(255,255,255);"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small" style="color: #ffffff !important;"><?php Util::display(
                                    Session::get('username')
                                ); ?></span><img class="border rounded-circle img-profile" src="assets/img/avatars/Portrait_Placeholder.png" style="border-color: rgb(255,255,255)!important;"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in" style="background: #252935;border-style: none;margin-top: 11px;box-shadow: 0px 0px 3px 2px rgba(0,0,0,0.16)!important;"><a class="dropdown-item" href="profile.php" style="color: rgb(255,255,255);"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400" style="color: rgb(255,255,255)!important;"></i>&nbsp;Profile</a><a class="dropdown-item" id="logout" href="/auth/logout.php" style="color: rgb(255,255,255);"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400" style="color: rgb(255,255,255)!important;"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4" data-aos="fade-down" data-aos-duration="800">Profile</h3>
                    <div class="row mb-3" data-aos="fade-down" data-aos-duration="600">
                        <div class="col-lg-4">
                            <div class="card mb-3" style="background: #252935;border-style: none;">
                                <div class="card-body text-center shadow" style="background: #252935;border-style: none;"><img class="rounded-circle mb-3 mt-4" src="assets/img/avatars/Portrait_Placeholder.png" width="160" height="160">
                                    <h3 class="text-dark mb-4" style="text-align: center;margin-top: 16px;margin-bottom: 18px;font-weight: bold;"><?php Util::display(
                                        Session::get('username')
                                    ); ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">

                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3" style="border-style: none;background: #252935;">
                                        <div class="card-header py-3" style="border-style: none;background: #252935;">
                                            <p class="text-primary m-0 fw-bold" style="/*color: var(--bs-yellow)!important;*/">Redeem subscription</p>
                                        </div>
                                        <div class="card-body" style="border-style: none;background: #252935;padding-bottom: 0px;">
                                            <form method="POST" action="<?php Util::display(
                                                $_SERVER['PHP_SELF']
                                            ); ?>">
                                                <div class="row">
                                                    <div class="col">
                                                        <?php if (
                                                            $suc == '1'
                                                        ): ?>
                                                            <span style="color: rgb(255,255,255); margin-bottom: 20px;">Activated if key was actually valid.</span>
                                                        <?php endif; ?>
                                                        <?php if (
                                                            isset($error)
                                                        ): ?>
                                                            <span style="color: rgb(255,255,255);"><?php Util::display(
                                                                $error
                                                            ); ?></span>
                                                        <?php endif; ?>
                                                        <div class="mb-3"><span style="color: rgb(255,255,255);">Your code</span><input class="form-control" type="text" name="subCode" autocapitalize="off" autocomplete="off" placeholder="XXX-XXX-XXX-XXX" style="background: #121421;border-style: none;margin-top: 11px;"></div>
                                                    </div>
                                                </div>
                                                <div class="mb-3"><button name="activateSub" type="submit" value="submit" class="btn btn-success btn-sm" style="color: rgb(255,255,255);margin-top: 13px;">Redeem key</button></div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card-body" style="background: #252935;border-style: none;">
                                <div class="row">
                                    <div class="col-md-6" style="width: 100%;">
                                        <form method="POST" action="<?php Util::display(
                                            $_SERVER['PHP_SELF']
                                        ); ?>">
                                            <div class="mb-3">
                                                <div class="col">
                                                    <?php if (isset($error)): ?>
                                                        <span style="color: rgb(255,255,255); margin-bottom: 20px;"><?php Util::display(
                                                            $error
                                                        ); ?></span>
                                                    <?php endif; ?>
                                                    <div class="mb-3"><span style="color: rgb(255,255,255);">Current password</span><input class="form-control" name="currentPassword" type="password" id="username-1" placeholder="********" name="username" style="background: #121421;border-style: none;margin-top: 11px;"></div>
                                                    <div class="mb-3"><span style="color: rgb(255,255,255);">New password</span><input class="form-control" name="newPassword" type="password" id="username-3" placeholder="********" name="username" style="background: #121421;border-style: none;margin-top: 11px;"></div>
                                                    <div class="mb-3"><span style="color: rgb(255,255,255);">Confirm password</span><input class="form-control" name="confirmPassword" type="password" id="username-2" placeholder="********" name="username" style="background: #121421;border-style: none;margin-top: 11px;"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3"><button class="btn btn-success btn-sm" name="updatePassword" type="submit" value="submit" style="color: rgb(255,255,255);margin-top: 25px;">Save Password</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>