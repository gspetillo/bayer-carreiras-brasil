<?php

require_once 'connectionDAO.php';

$PDO = db_connect();
$PDO->exec('SET CHARACTER SET utf8');
$sql = "SELECT * FROM cidades WHERE estados_id = '".$_POST['id']."'";
$selectCity = $PDO->prepare($sql);
$selectCity->execute();
$aux = $selectCity->fetchAll();

foreach ($aux as $cidades) {
    echo '<option value="'.$cidades['nome'].'">'.$cidades['nome'].'</option>';
}
?>