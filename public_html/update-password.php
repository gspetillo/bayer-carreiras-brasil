<html>
    <body style="font-family:'Open Sans';">
        <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
<?php 
// inclui o arquivo de inicialização
require_once 'connectionDAO.php';

// resgata variáveis do formulário
$password = isset($_POST['password']) ? $_POST['password'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

// cria o hash da senha
$passwordHash = make_hash($password);

$nulo = '';

$PDO = db_connect();

$sql = "SELECT email, class FROM candidates WHERE email = '$email' UNION SELECT email, class FROM recruiters WHERE email = '$email'";
$stmt = $PDO->prepare($sql);
$stmt->execute(array($email));
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// atualiza o banco
if ($users[0]["class"]=='cand'){
    $sqlm = "UPDATE candidates SET cand_password = '$passwordHash', password_key = '$nulo' WHERE email = '$email'";
}else {
    $sqlm = "UPDATE recruiters SET rec_password = '$passwordHash', password_key = '$nulo' WHERE email = '$email'";
}
$stmtm = $PDO->prepare($sqlm);
if ($stmtm->execute()){
    echo"<script>
    Swal.fire({   
        type: 'success',
        title: 'Dados atualizados com sucesso',
        showConfirmButton: false,
        timer: 2500
        }).then(function() {
        window.location.href = 'form-login.php';
    })
    </script>";
}else {
    echo $sqlm;
    echo "Erro ao atualizar dados, tente novamente mais tarde";
    print_r($stmtm->errorInfo());
}
?>
</body>
</html>