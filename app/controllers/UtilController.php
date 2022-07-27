<?php

// Extends to NO classes
// Only Public methods

class Util
{
    public static function redirect($location)
    {
        header('location:' . SUB_DIR . $location);
        exit();
    }

    public static function head($title)
    {
        include SITE_ROOT . '/includes/head.inc.php';
    }

    public static function navbar()
    {
        include SITE_ROOT . '/includes/navbar.inc.php';
    }

    public static function adminNavbar()
    {
        include SITE_ROOT . '/includes/admin.navbar.inc.php';
    }

    public static function footer()
    {
        include SITE_ROOT . '/includes/footer.inc.php';
    }

    public static function display($string)
    {
        echo $string;
    }

    // Returns random string
    public static function randomCode($int)
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $int; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    // ban check
    public static function banCheck()
    {
        // If user is banned
        if (Session::isBanned()) {
            // Prevents infinite redirect loop
            if (basename($_SERVER['PHP_SELF']) != 'banned.php') {
                header('location: banned.php');
            }
        }
    }

    public function getSubStatus()
    {
        // Bind data
        $username = Session::get('username');
        return $this->subActiveCheck($username);
    }

    // admin check
    public static function adminCheck()
    {
        if (!Session::isAdmin()) {
            Util::redirect('/index.php');
        }
    }

    public static function getjoin()
    {
        $joindate = Session::get("createdAt");
        $now = time();
        $date = strtotime($joindate);
        $datediff = $now - $date;

        return round($datediff / (60 * 60 * 24));
    }
}
