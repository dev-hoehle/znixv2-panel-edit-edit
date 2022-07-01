<?php
require_once '../app/require.php';
require_once '../app/controllers/AdminController.php';

$user = new UserController();
$admin = new AdminController();

Session::init();

$userList = $admin->getUserArray();
$username = Session::get('username');
$uid = Session::get('uid');

$userList = $admin->getUserArray();

Util::adminCheck();
Util::banCheck();
Util::head('Admin Panel');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['resetHWID'])) {
        $rowUID = $_POST['resetHWID'];
        $admin->resetHWID($rowUID);
    }

    if (isset($_POST['setBanned'])) {
        $rowUID = $_POST['setBanned'];
        $admin->setBanned($rowUID);
    }

    if (isset($_POST['setAdmin'])) {
        $rowUID = $_POST['setAdmin'];
        $admin->setAdmin($rowUID);
    }

    header('location: table.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="../assets/css/untitled.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php Util::adminNavbar(); ?>
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
                                ); ?></span><img class="border rounded-circle img-profile" src="../assets/img/avatars/Portrait_Placeholder.png" style="border-color: rgb(255,255,255)!important;"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in" style="background: #252935;border-style: none;margin-top: 11px;box-shadow: 0px 0px 3px 2px rgba(0,0,0,0.16)!important;"><a class="dropdown-item" href="profile.php" style="color: rgb(255,255,255);"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400" style="color: rgb(255,255,255)!important;"></i>&nbsp;Profile</a><a class="dropdown-item" id="logout" href="/auth/logout.php" style="color: rgb(255,255,255);"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400" style="color: rgb(255,255,255)!important;"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4" data-aos="fade-down" data-aos-duration="800">Users</h3>
                    <br>
					
                    <button onclick="window.location.href = 'table.php?min=1&max=99999';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;All</button>
                    <button onclick="window.location.href = 'table.php?min=1&max=10';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;1-10</button>
                    <button onclick="window.location.href = 'table.php?min=10&max=20';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;10-20</button>
                    <button onclick="window.location.href = 'table.php?min=20&max=30';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;20-30</button>
                    <button onclick="window.location.href = 'table.php?min=30&max=40';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;30-40</button>
                    <button onclick="window.location.href = 'table.php?min=40&max=50';" class="btn btn-primary" style="font-size: 11px;"> &nbsp;40-50</button>
				 <br>
				 <br>
				 <input autocomplete="off" type="text" id="min" name="min"  maxlength="255" placeholder="10" required style="background: #151515;border-style: none;outline: none;color: rgb(255,255,255);border-radius: 5px;padding-left: 5px;padding-right: 5px;margin-top: -4px;">
				 -
				 <input autocomplete="off" type="text" id="max" name="max"  maxlength="255" placeholder="20" required style="background: #151515;border-style: none;outline: none;color: rgb(255,255,255);border-radius: 5px;padding-left: 5px;padding-right: 5px;margin-top: -4px;">
				 <p onclick="redirect()"  class="btn btn-primary"  style="font-size: 11px;">
                 &nbsp;Submit custom range</p>
                    <div class="card shadow" data-aos="fade-down" data-aos-duration="600" style="background: #252935;border-style: none;">
                        <div class="card-header py-3" style="color: rgb(133, 135, 150);background: #252935;border-style: none;">
                            <p class="text-primary m-0 fw-bold">User information</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="color: rgb(255,255,255);">Username</th>
                                            <th style="color: rgb(255,255,255);">UID</th>
                                            <th style="color: rgb(255,255,255);">Admin</th>
                                            <th style="color: rgb(255,255,255);">Banned</th>
                                            <th style="color: rgb(255,255,255);">Last-IP</th>
                                            <th style="color: rgb(255,255,255);">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($userList as $row): ?>
                                            <?php if (
                                                !isset($_GET['max']) ||
                                                !isset($_GET['min'])
                                            ) {
                                                $_GET['min'] = 1;
                                                $_GET['max'] = 10;
                                            } ?>
										<?php if ($row->uid <= $_GET['max'] && $row->uid >= $_GET['min']): ?>
                                            <tr>


                                                <td style="color: rgb(255,255,255);"><?php Util::display(
                                                    $row->username
                                                ); ?></td>
                                                <td style="color: rgb(255,255,255);"><?php Util::display(
                                                    $row->uid
                                                ); ?></td>
                                                <td style="color: rgb(255,255,255);">
                                                    <?php if (
                                                        $row->admin == 1
                                                    ): ?>
                                                        <i class="fa fa-check"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-times"></i>
                                                    <?php endif; ?>
                                                </td>

                                                <td style="color: rgb(255,255,255);">
                                                    <?php if (
                                                        $row->banned == 1
                                                    ): ?>
                                                        <i class="fas fa-check"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-times"></i>
                                                    <?php endif; ?>
                                                </td>

                                                <td title="Click to copy" data-toggle="tooltip" data-placement="top" onclick="setClipboard('<?php echo $row->lastIP; ?>')" style="color: rgb(255,255,255);">
                                                    <?php Util::display(
                                                        $row->lastIP
                                                    ); ?>
                                                </td>


                                                <td style="color: rgb(255,255,255);max-width: 100px;">
                                                    <form method="POST" action="<?php Util::display(
                                                        $_SERVER['PHP_SELF']
                                                    ); ?>">

                                                        <button value="<?php Util::display(
                                                            $row->uid
                                                        ); ?>" name="resetHWID" class="btn btn-primary" type="submit" style="font-size: 11px;">
                                                            <i class="fas fa-microchip"></i>&nbsp;Reset</button>


                                                        <button value="<?php Util::display(
                                                            $row->uid
                                                        ); ?>" name="setBanned" class="btn btn-danger" type="submit" style="font-size: 11px;margin-left: 10px;">
                                                            <i class="fas fa-ban"></i>&nbsp;Ban</button>

                                                        <button value="<?php Util::display(
                                                            $row->uid
                                                        ); ?>" name="setAdmin" class="btn btn-success" type="submit" style="font-size: 11px;margin-left: 10px;color: rgb(255,255,255);">
                                                            <i class="fas fa-key"></i>&nbsp;Admin</button>

                                                    </form>
                                                </td>

                                            </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>



                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="../assets/js/theme.js"></script>
    <script>
        function setClipboard(value) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = value;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
        }
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        function redirect() {
						var min = document.getElementById("min");
						min = min.value;
						var max = document.getElementById("max");
						max = max.value;
						window.location.href = 'table.php?min=' + min + '&max=' + max;

					}
    </script>
</body>

</html>