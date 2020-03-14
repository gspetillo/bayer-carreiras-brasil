<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Rec.php';

// busca os dados do usuário no banco
$PDO = db_connect();
$sql = "SELECT * FROM recruiters";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$sqlj = "SELECT * FROM job_roles";
$stmtj = $PDO->prepare($sqlj);
$stmtj->execute();

$rec_cpf = $_SESSION['email_rec_cpf'];
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
</head>

<body>
  <div class="wrapper ">
    <?php include 'sidebar-Rec.php';?>
    <div class="main-panel">
      <!-- Navbar -->
        <?php include 'navbar.php';?>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
    <div class="content">
    	<div class="row">
    	    <div class ="col-12 mb-3">
    	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJob">Adicionar nova Vaga
    	    </div>
    	    
            <div class="card text-center col-12">
                <table class="table table-hover">
                    <?php if ($auxj = $stmtj->fetch(PDO::FETCH_ASSOC) == 0) {
                        ?><p>Nenhuma vaga encontrada</p><?php
                    } else {?>
                  <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Keywords</th>
                        <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($auxj = $stmtj->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td><?php echo $auxj['title']?></td>
                        <td><?php echo $auxj['description'] ?></td>
                        <td><?php echo $auxj['keywords'] ?></td>
                        <td>
                            <a class="btn btn-outline-danger btn-sm" role="button" href="delete-job-role.php?job_id=<?php echo $auxj['job_id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');"><i class="nc-icon nc-simple-remove"></i> </a>
                        </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
                <div class="modal fade" id="addJob" tabindex="-1" role="dialog" aria-labelledby="addRecLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addJobLabel">Adicionar Nova Vaga</h5>
                  </div>
                  <div class="modal-body">
                    <form action="add-job-role.php" method="post">
                      <div class="form-group">
                        <label for="title">Título:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nome" required>
                      </div>
                      <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Descrição" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="keywords">Keywords:</label>
                        <input class="form-control" type="text" name="keywords" id="keywords" placeholder="#keywords" autocomplete="off" required>
                      </div>
                      <input class="form-control" type="text" name="rec_cpf" id="rec_cpf" value="<?php echo $rec_cpf ?>" hidden>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                      </div>
                    </form>  
                  </div>
                </div>
              </div>
            </div>
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