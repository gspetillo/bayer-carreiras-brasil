<?php
 
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', 'localhost');
define('DB_USER', 'id11042283_admin');
define('DB_PASS', 'conta2sib');
define('DB_NAME', 'id11042283_bayercarreiras');
 
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
// inclui o arquivo de funçõees
require_once 'functions.php';

date_default_timezone_set("America/Sao_Paulo");
?>