<?php
 
// inclui o arquivo de inicialização
require 'connectionDAO.php';
 session_start();
// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$cand_password = isset($_POST['cand_password']) ? $_POST['cand_password'] : '';
$email_session = $email;

// cria o hash da senha
$passwordHash = make_hash($cand_password);

$pessoa='3';

// busca os dados do candidato no banco
$PDO = db_connect();
$sql = "SELECT * FROM candidates WHERE email = :email AND cand_password = :cand_password";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':cand_password', $passwordHash);
$stmt->execute();
$candidates = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($candidates) <= 0) {
    $pessoa='2';
    // busca os dados do recrutador no banco
    $PDO = db_connect();
    $sqlr = "SELECT * FROM recruiters WHERE email = :email AND rec_password = :rec_password";
    $stmtr = $PDO->prepare($sqlr);
    $stmtr->bindParam(':email', $email);
    $stmtr->bindParam(':rec_password', $passwordHash);
    $stmtr->execute();
    $recruiters = $stmtr->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($recruiters) <= 0) {
        echo '
        <html>
        <body style="font-family:Open Sans;">
            <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
            <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
        </body>
        </html>
        ';
        echo "<script>
        Swal.fire({   
            type: 'error',
            title: 'Usuário ou senha incorreto',
            showConfirmButton: false,
            timer: 3500
            }).then(function() {
            window.location.href = 'logout.php';
        })
        </script>";
        exit;
    }
}
 if ($pessoa=='3'){
// pega o primeiro candidato
    $email = $candidates[0];
    $_SESSION['logged_in'] = true;
    $_SESSION['email_cand_cpf'] = $email['cand_cpf'];
    $_SESSION['email_first_name'] = $email['first_name'];
    $_SESSION['email_email'] = $email_session;
    $_SESSION['email_nivel'] = '3';
 }else {
    // pega o primeiro recrutador
    $emailr = $recruiters[0];
    $_SESSION['logged_in'] = true;
    $_SESSION['email_rec_cpf'] = $emailr['rec_cpf'];
    $_SESSION['email_first_name'] = $emailr['first_name'];
    $_SESSION['email_email'] = $email_session;
    if ($emailr['type']=='1'){
        $_SESSION['email_nivel'] = '1';
    }else{
        $_SESSION['email_nivel'] = '2';
    }
    
 }

if ($_SESSION['email_nivel']=='3'){
    echo"<script>
        window.location.href = 'dashboard-Cand.php';
    </script>";
}else{
    echo"<script>
        window.location.href = 'dashboard-Rec.php';
    </script>";
}

?>