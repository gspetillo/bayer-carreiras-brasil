<html>
    <body style="font-family:'Open Sans';">
        <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">

<?php 

// inclui o arquivo de inicialização
require 'connectionDAO.php';
 
// resgata variáveis do formulário
$rec_cpf = isset($_POST['rec_cpf']) ? $_POST['rec_cpf'] : null;
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
$uf = isset($_POST['uf']) ? $_POST['uf'] : null;
$city = isset($_POST['city']) ? $_POST['city'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$rec_password = isset($_POST['rec_password']) ? $_POST['rec_password'] : null;


// busca os dados na tabela recrutadores para ver se o email ja não esta cadastrado
$PDO = db_connect();
$sqle = "SELECT email FROM candidates WHERE email = '$email' UNION SELECT email FROM recruiters WHERE email = '$email'";
$stmte = $PDO->prepare($sqle);
$stmte->bindParam(':email', $email, PDO::PARAM_STR);
$stmte->execute();
$auxe = $stmte->fetch(PDO::FETCH_ASSOC);
// se o método fetch() retornar um array, significa que o email existe na tabela
if (is_array($auxe)){
    echo"<script>
    Swal.fire({   
        type: 'error',
        title: 'Email já está em uso',
        showConfirmButton: false,
        timer: 2500
        }).then(function() {
        window.location.href = 'recruiters.php';
    })
    </script>";
    exit;
} //endif

// busca os dados na tabela recrutadores para ver se o cpf ja não esta cadastrado
$PDO = db_connect();
$sqle = "SELECT cand_cpf FROM candidates WHERE cand_cpf = '$rec_cpf' UNION SELECT rec_cpf FROM recruiters WHERE rec_cpf = '$rec_cpf'";
$stmte = $PDO->prepare($sqle);
$stmte->bindParam(':rec_cpf', $rec_cpf, PDO::PARAM_STR);
$stmte->execute();
$auxe = $stmte->fetch(PDO::FETCH_ASSOC);
// se o método fetch() retornar um array, significa que o email existe na tabela
if (is_array($auxe)){
    echo"<script>
    Swal.fire({   
        type: 'error',
        title: 'Este CPF já está cadastrado',
        showConfirmButton: false,
        timer: 2500
        }).then(function() {
        window.location.href = 'recruiters.php';
    })
    </script>";
    exit;
} //endif

// cria o hash da senha
$passwordHash = make_hash($rec_password);

$type = '2';
$class = 'rec';

// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO recruiters(rec_cpf, first_name, last_name, uf, city, rec_password, email, type, class) VALUES(:rec_cpf, :first_name, :last_name, :uf, :city, :rec_password, :email, :type, :class)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':rec_cpf', $rec_cpf);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':uf', $uf);
$stmt->bindParam(':city', $city);
$stmt->bindParam(':rec_password', $passwordHash);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':type', $type);
$stmt->bindParam(':class', $class);
 
if ($stmt->execute()) {
    echo"<script>
        window.location.href = 'recruiters.php';
    </script>";
}else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
</body>
</html>