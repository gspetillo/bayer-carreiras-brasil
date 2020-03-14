<html>
    <body style="font-family:'Open Sans';">
        <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">

<?php 

// inclui o arquivo de inicialização
require_once 'connectionDAO.php';


// resgata variáveis do formulário
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$rec_cpf = isset($_POST['rec_cpf']) ? $_POST['rec_cpf'] : null;
$uf = isset($_POST['uf']) ? $_POST['uf'] : null;
$city = isset($_POST['city']) ? $_POST['city'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

 //Upload do arquivo

$PDO = db_connect();
$sql = "UPDATE recruiters SET first_name = :first_name, last_name = :last_name, uf = :uf, city = :city, email = :email WHERE rec_cpf = :rec_cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':uf', $uf);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':rec_cpf', $rec_cpf, PDO::PARAM_STR);

if ($stmt->execute()){
    echo"<script>
    Swal.fire({   
        type: 'success',
        title: 'Dados atualizados com sucesso',
        showConfirmButton: false,
        timer: 2500
        }).then(function() {
        window.location.href = 'profile-Rec.php';
    })
    </script>";
}else {
    echo "Erro ao atualizar dados, tente novamente mais tarde";
    print_r($stmt->errorInfo());
}
?>
    </body>
</html>