<?php

require_once 'connectionDAO.php';

if (!isLoggedIn()) {
    echo "<script type='text/javascript'>
        window.location='form-login.php';
    </script>";
}

if (!isADM()) {
echo "<script type='text/javascript'>
window.location='logout.php';
alert('Você não tem permissão para acessar esta página.');
</script>";
}
