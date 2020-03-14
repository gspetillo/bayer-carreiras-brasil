<html>

<body style="font-family:'Open Sans';">
    <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">

    <?php

    // inclui o arquivo de inicialização
    require_once 'connectionDAO.php';
    include 'vendor/autoload.php';
    include 'azure/azure.php';
    
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    
    // resgata variáveis do formulário
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $cand_cpf = isset($_POST['cand_cpf']) ? $_POST['cand_cpf'] : null;
    $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : null;
    $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $uf = isset($_POST['uf']) ? $_POST['uf'] : null;
    $city = isset($_POST['city']) ? $_POST['city'] : null;
    $mobile_number = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : null;
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $cv_path = isset($_POST['cv_path']) ? $_POST['cv_path'] : null;
    
    // busca os dados do usuário no banco
    $PDO = db_connect();
    $sqli = "SELECT cv_path FROM candidates WHERE cand_cpf = $cand_cpf";
    $stmti = $PDO->prepare($sqli);
    $stmti->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);
    $stmti->execute();
    $auxi = $stmti->fetch(PDO::FETCH_ASSOC);

    //Upload do arquivo
    $path = $_FILES['cv_path']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $cv_path = 'curriculos/' . $first_name . $last_name . $cand_cpf . "." . $ext;
    $arquivo_tmp = $_FILES['cv_path']['tmp_name'];
    move_uploaded_file($arquivo_tmp, $cv_path);

    if ($ext != "") {
        if(empty($auxi)){
            // UPDATE STEP
            $step = 1;
            $sqlb = "UPDATE candidates SET step = :step WHERE cand_cpf = :cand_cpf";
            $stmtb = $PDO->prepare($sqlb);
            $stmtb->bindParam(':step', $step);
            $stmtb->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);
            $stmtb->execute();
        }
        // UPDATE CURRICULO
        $sqla = "UPDATE curriculums SET cv_path = :cv_path WHERE cand_cpf = :cand_cpf";
        $stmta = $PDO->prepare($sqla);
        $stmta->bindParam(':cv_path', $cv_path);
        $stmta->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);
        $stmta->execute();
        
        azureCandidate($cv_path, $cand_cpf);
        
    }

    $sql = "UPDATE candidates SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, gender = :gender, uf = :uf, city = :city, mobile_number = :mobile_number, phone_number = :phone_number, email = :email WHERE cand_cpf = :cand_cpf";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':birth_date', $birth_date);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':uf', $uf);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':mobile_number', $mobile_number);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<script>
    Swal.fire({   
        type: 'success',
        title: 'Dados atualizados com sucesso',
        showConfirmButton: false,
        timer: 2500
        }).then(function() {
        window.location.href = 'profile-Cand.php';
    })
    </script>";
    } else {
        echo "Erro ao atualizar dados, tente novamente mais tarde";
        print_r($stmt->errorInfo());
    }
    ?>
</body>

</html>