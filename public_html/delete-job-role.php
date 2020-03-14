<?php

session_start();
require_once 'connectionDAO.php';
include 'azure/FunctionJSON.php';

// pega o ID da URL
$job_id = isset($_GET['job_id']) ? $_GET['job_id'] : null;
 
// valida o ID
if (empty($job_id))
{
    echo "ID não informado";
    exit;
}
 
// remove do banco
$PDO = db_connect();
$sql = "DELETE FROM job_roles WHERE job_id = :job_id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':job_id', $job_id, PDO::PARAM_INT);
 
if ($stmt->execute()){
    header('Location: job-roles.php');
} else {
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}

        $fileOpen = fopen("azure/jsonFiles/JobRoles.json", "r");
        $content  = json_decode(fread($fileOpen, filesize("azure/jsonFiles/JobRoles.json")));
        fclose($fileOpen);

        $arrayJobRoles = $content->JobRoles;
        $newArr = array();

        foreach ($arrayJobRoles as $k) {
            if (!(strcasecmp($k->job_ID, $job_id) == 0)) {
                array_push($newArr, $k);
            }
        }

        $document = array('JobRoles' => $newArr);

        // Abre o arquivo para gravação, adicionado os candidatos
        $fileClose = fopen("azure/jsonFiles/JobRoles.json", "w");
        $escreve = fwrite($fileClose, json_encode(new ArrayValue($document), JSON_PRETTY_PRINT));
        fclose($fileClose);