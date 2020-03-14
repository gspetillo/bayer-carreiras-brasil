<?php
if( empty($_GET['email']) || empty($_GET['password_key'])) {
    die('<p>Não é possível alterar a senha: dados em falta</p>');
} else {
    // inclui o arquivo de inicialização
    require 'connectionDAO.php';
    // resgata variáveis do link
    $email = isset($_GET['email']) ? $_GET['email'] : null;
    $chave = isset($_GET['password_key']) ? $_GET['password_key'] : null;
    //conecta no banco
    $PDO = db_connect();
    $sql = "SELECT email, class, first_name FROM candidates WHERE email = '$email' AND password_key = '$chave' UNION SELECT email, class, first_name FROM recruiters WHERE email = '$email' AND password_key = '$chave'";
    $stmt = $PDO->prepare($sql);
    $stmt->execute(array($email, $chave));
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $first_name = $users[0]["first_name"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Insightek">

  <title>Bayer Carreiras Brasil</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- SweetAlert -->
  <script src="sweetalert2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.min.css">   

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="./img/bayer_logo.ico" />
  <style>
      #logo-bayer{
        padding-right:10px;
      }
  </style>
</head>

<body>

  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
        <div class="col-md-11">
            <img id="logo-bayer" src="./img/bayer_logo-01-02.png">
            <a class="navbar-brand text-secondary" href="index.html">Bayer Carreiras Brasil</a>
      </div>
    </div>
  </nav>
<?php if ($stmt->rowCount()) { ?>
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Recuperar Senha</h1>
      </div>
      <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <h5 class="mb-1 text-center"><?php echo $first_name ?>,</h5>
                        <h4 class="mb-1 text-center">Digite a nova senha:</h4>
                        <br>
         <form action="update-password.php" method="post">
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mb-2 mb-md-0">
                <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Senha" minlength="6" required>
                <input type="hidden" name="email" value="<?php echo $email ?>">
              </div>
            </div>
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mt-3">
                <button type="submit" name="submit" id="submit" class="btn btn-block btn-lg btn-primary">Alterar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </header>
  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">Sobre</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contato</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Termos de Uso</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Política de Privacidade</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; Última atualização: 28/set/2019 Copyright © Bayer AG</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="https://www.facebook.com/bayerjovensBR/?__tn__=%2Cd%2CP-R&eid=ARCdCZez5c3wpT035tF9EctiN3tKOVIHJhZXaN5BwIp3H7W10jldpL0tnkBHFPlhfjj2uTdJSenFNikl&brand_redir=147568762110829">
                <i class="fab fa-facebook fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item mr-3">
              <a href="https://twitter.com/BayerCarreiras">
                <i class="fab fa-twitter-square fa-2x fa-fw"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/bayerbrasil/">
                <i class="fab fa-instagram fa-2x fa-fw"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php }else {
    echo"<script>
        Swal.fire({   
        title: 'Não é possível alterar a senha: dados incorretos',   
        type: 'error',
        confirmButtonColor: '#d33',   
        confirmButtonText: 'Voltar',   
        closeOnConfirm: true 
        }).then((result) => {
        if (result.value) {
            window.location.href = 'form-login.php'; 
        }
        })
    </script>";
} ?>
</html>