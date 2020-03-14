<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Rec.php';

// busca os dados do usuário no banco ONDE status = 0
$PDO = db_connect();
$sql0 = "SELECT * FROM candidates WHERE status = 0 ORDER BY first_name ASC";
$stmt0 = $PDO->prepare($sql0);
$stmt0->execute();

// busca os dados do usuário no banco ONDE status = 1
$PDO = db_connect();
$sql1 = "SELECT * FROM candidates WHERE status = 1 ORDER BY first_name ASC";
$stmt1 = $PDO->prepare($sql1);
$stmt1->execute();

// busca os dados do usuário no banco ONDE status = 2
$PDO = db_connect();
$sql2 = "SELECT * FROM candidates WHERE status = 2 ORDER BY first_name ASC";
$stmt2 = $PDO->prepare($sql2);
$stmt2->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./img/apple-icon.png">
  <link rel="icon" type="image/png" href="./img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Bayer Carreiras Brasil
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Arquivos -->
  <link href="./css/bootstrap.min.css" rel="stylesheet" />
  <link href="./css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./demo/demo.css" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/bayer_logo.ico" />
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <style>
      #selecao{
          padding-top:50px;
      }
      
  </style>
</head>

<body class="">
  <div class="wrapper ">
    <?php include 'sidebar-Rec.php';?>
    <div class="main-panel">
      <!-- Navbar -->
        <?php include 'navbar.php';?>
      <!-- End Navbar -->

    <div class="content">
        <!-- SELEÇÃO -->
    	<div class="row justify-content-center">
            <div class="card text-center col-10">
                <h3 id="selecao"><b>SELEÇÃO</b></h3>
                <table class="table table-hover">
                    <?php if ($aux0 = $stmt0->fetch(PDO::FETCH_ASSOC) == 0) {
                        ?><p>Nenhum candidato encontrado</p><?php
                    } else {?>
                  <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden d-none">CPF</th>
                        <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($aux0 = $stmt0->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td><?php echo $aux0['first_name']?> <?php echo $aux0['last_name'] ?></td>
                        <td class="hidden d-none"><?php echo $aux0['cand_cpf'] ?></td>
                        <td>
                            <a class="btn btn-md btn-outline-info" role="button" href="view-Cand.php?cand_cpf=<?php echo $aux0['cand_cpf'] ?>" ><i class="nc-icon nc-zoom-split"></i> </a>
                            <a class="btn btn-md btn-outline-success" role="button" href="aprove-Cand.php?cand_cpf=<?php echo $aux0['cand_cpf'] ?>" onclick="return confirm('Tem certeza de que deseja aprovar?');"><i class="nc-icon nc-check-2"></i> </a>
                            <a class="btn btn-md btn-outline-danger" role="button" href="deny-Cand.php?cand_cpf=<?php echo $aux0['cand_cpf'] ?>" onclick="return confirm('Tem certeza de que deseja reprovar?');"><i class="nc-icon nc-simple-remove"></i> </a>
                        </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- APROVADOS -->
    	<div class="row justify-content-center">
            <div class="card text-center col-10">
                <h3 class="mt-5"><b>APROVADOS</b></h3>
                <table class="table table-hover">
                    <?php if ($aux1 = $stmt1->fetch(PDO::FETCH_ASSOC) == 0) {
                        ?><p>Nenhum candidato encontrado</p><?php
                    } else {?>
                  <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden d-none">CPF</th>
                        <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($aux1 = $stmt1->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td><?php echo $aux1['first_name']?> <?php echo $aux1['last_name'] ?></td>
                        <td class="hidden d-none"><?php echo $aux1['cand_cpf'] ?></td>
                        <td>
                            <a class="btn btn-md btn-outline-info" role="button" href="view-Cand.php?cand_cpf=<?php echo $aux1['cand_cpf'] ?>" ><i class="nc-icon nc-zoom-split"></i> </a>
                            <a class="btn btn-md btn-outline-danger" role="button" href="deny-Cand.php?cand_cpf=<?php echo $aux1['cand_cpf'] ?>" onclick="return confirm('Tem certeza de que deseja reprovar?');"><i class="nc-icon nc-simple-remove"></i> </a>
                        </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
            </div>
        </div>
        <!-- REPROVADOS -->
    	<div class="row justify-content-center">
            <div class="card text-center col-10">
                <h3 class="mt-5"><b>REPROVADOS</b></h3>
                <table class="table table-hover">
                    <?php if ($aux2 = $stmt2->fetch(PDO::FETCH_ASSOC) == 0) {
                        ?><p>Nenhum candidato encontrado</p><?php
                    } else {?>
                  <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden d-none">CPF</th>
                        <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($aux2 = $stmt2->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td><?php echo $aux2['first_name']?> <?php echo $aux2['last_name'] ?></td>
                        <td class="hidden d-none"><?php echo $aux2['cand_cpf'] ?></td>
                        <td>
                            <a class="btn btn-md btn-outline-info" role="button" href="view-Cand.php?cand_cpf=<?php echo $aux2['cand_cpf'] ?>" ><i class="nc-icon nc-zoom-split"></i> </a>
                            <a class="btn btn-md btn-outline-success" role="button" href="aprove-Cand.php?cand_cpf=<?php echo $aux2['cand_cpf'] ?>" onclick="return confirm('Tem certeza de que deseja aprovar?');"><i class="nc-icon nc-check-2"></i> </a>
                        </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
            </div>
        </div>

    </div>
   </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row"> 
            <nav class="footer-nav">
              <ul>
                <li>
                  <a href="https://www.creative-tim.com" target="_blank">Bayer</a>
                </li>
                <li>
                  <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                </li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>
                  document.write(new Date().getFullYear())
                </script> Bayer AG
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Arquivos   -->
  <script src="./js/core/jquery.min.js"></script>
  <script src="./js/core/popper.min.js"></script>
  <script src="./js/core/bootstrap.min.js"></script>
  <script src="./js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./js/plugins/chartjs.min.js"></script>
  <!--  Notificações Plugin    -->
  <script src="./js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Carreiras: parallax effects, scripts for the example pages etc -->
  <script src="./js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Bayerrrrr DEMO methods, don't include it in your project! -->
  <script src="./demo/demo.js"></script>
</body>
</html>