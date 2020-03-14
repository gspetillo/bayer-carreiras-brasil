<?php

require_once 'connectionDAO.php';

if (!isLoggedIn()) {
    header('Location: form-login.php');
}

if (!isRec()) {
echo "<script type='text/javascript'>
window.location='logout.php';
alert('Você não tem permissão para acessar esta página.');
</script>";
}
