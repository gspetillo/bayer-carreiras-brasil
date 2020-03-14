<html>
    <body style="font-family:'Open Sans';">
        <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">

<?php 

// inclui o arquivo de inicialização
require 'connectionDAO.php';
include "azure/FunctionJSON.php";
include "azure/azure.php";
include 'vendor/autoload.php';
    
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();
 
// resgata variáveis do formulário
$rec_cpf = isset($_POST['rec_cpf']) ? $_POST['rec_cpf'] : null;
$title = isset($_POST['title']) ? $_POST['title'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : null;

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO job_roles(rec_cpf, title, description, keywords) VALUES(:rec_cpf, :title, :description, :keywords)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':rec_cpf', $rec_cpf);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':keywords', $keywords);

if ($stmt->execute()) {
    echo"<script>
    Swal.fire({   
        type: 'success',
        title: 'Vaga cadastrada com sucesso',
        showConfirmButton: false,
        timer: 1200
        }).then(function() {
        window.location.href = 'job-roles.php';
    })
    </script>"; 
    
    $job_id = $PDO->lastInsertId();
    
    // Separando keywords

    $keywords = str_replace(", ",",",$keywords);
    $keywords = str_replace("#","",$keywords);
    $arrayKey = explode(",",$keywords); 
    
    
    $keysDescription = azureJobs($job_id, $description );
    $newArrayKeys = array_merge($arrayKey, $keysDescription);
    
    $newArrayKeys = remove_accent($newArrayKeys);
    $description = remove_accent($description);
    $title = remove_accent($title);

    // Gravando vagas em JSON para comparação no Azure

    $fileOpen = fopen("azure/jsonFiles/JobRoles.json", "r");
    $content  = json_decode(fread($fileOpen, filesize("azure/jsonFiles/JobRoles.json")));
    fclose($fileOpen); 

    $arrayJobs = $content->JobRoles;
    $newJob =  array('job_ID'=> $job_id, 'title'=> $title,'description'=>$description,'keywords'=> $newArrayKeys); 
    array_push($arrayJobs , $newJob);
    $document = array('JobRoles' => $arrayJobs ); 

    // Abre o arquivo para gravação, adicionado os candidatos
    $fileClose = fopen("azure/jsonFiles/JobRoles.json", "w");
    $escreve = fwrite($fileClose, json_encode(new ArrayValue($document),JSON_PRETTY_PRINT));
    fclose($fileClose);
    
    
}else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
</body>
</html>