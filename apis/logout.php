<?php
session_start();
unset($_SESSION['loggedin']);
unset($_SESSION['username']);
if (session_destroy()) {
    header("location: /" . ADMIN_SLUG . "/login");
} else {
    header("location: /404");
}
