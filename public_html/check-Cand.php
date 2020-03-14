<?php

require_once 'connectionDAO.php';

if (!isLoggedIn()) {
    echo "<script type='text/javascript'>
        window.location='form-login.php';
    </script>";
}
?>