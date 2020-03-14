<?php

session_start();
require_once 'connectionDAO.php';

// pega o ID da URL
$rec_cpf = isset($_GET['rec_cpf']) ? $_GET['rec_cpf'] : null;
 
// valida o ID
if (empty($rec_cpf))
{
    echo "ID não informado";
    exit;
}
 
// remove do banco
$PDO = db_connect();
$sql = "DELETE FROM recruiters WHERE rec_cpf = :rec_cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':rec_cpf', $rec_cpf, PDO::PARAM_INT);
 
if ($stmt->execute()){
    header('Location: form-add-Rec.php');
} else {
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}