<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Adm.php';

// busca os dados do usuário no banco
$PDO = db_connect();
$sql = "SELECT * FROM recruiters";
$stmt = $PDO->prepare($sql);
$stmt->execute();

$PDO->exec('SET CHARACTER SET utf8');
$sqlC = "SELECT * FROM estados ORDER BY nome ASC";
$stmtC = $PDO->prepare($sqlC);
$stmtC->execute();
$fetchAll = $stmtC->fetchAll();
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
  
  <script src="vendor/jquery/jquery-1.7.1.min.js"></script>
  <script language="JavaScript" src="vendor/uf-city.js"></script>
</head>

<body class="">
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
    	        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRec">Adicionar novo Recrutador
    	    </div>
    	    
            <div class="card text-center col-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($aux = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $aux['first_name']?> <?php echo $aux['last_name'] ?></td>
                        <td><?php echo $aux['email'] ?></td>
                        <td>
                            <a class="btn btn-outline-danger btn-sm" role="button" href="delete-Rec.php?rec_cpf=<?php echo $aux['rec_cpf'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');"><i class="nc-icon nc-simple-remove"></i> </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
                <div class="modal fade" id="addRec" tabindex="-1" role="dialog" aria-labelledby="addRecLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addRecLabel">Adicionar Novo Recrutador</h5>
                  </div>
                  <div class="modal-body">
                    <form action="add-Rec.php" method="post">
                      <div class="form-group">
                        <label for="rec_cpf">CPF:</label>
                        <input type="text" class="form-control" id="rec_cpf" name="rec_cpf" placeholder="CPF" minlength="11" maxlength="11" required>
                      </div>
                      <div class="form-group">
                        <label for="first_name">Primeiro Nome:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nome" required>
                      </div>
                      <div class="form-group">
                        <label for="last_name">Último Sobrenome:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Sobrenome" required>
                      </div>
                      <div class="form-group">
                        <label for="uf">Estado:</label>
                        <select class="form-control" type="text" name="uf" id="uf" placeholder="Estado" autocomplete="off" required>
                             <?php 
                                foreach($fetchAll as $estados){
                                     echo '<option value="'.$estados['id'].'">'.$estados['nome'].'</option>';
                                }
                            ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="city">Cidade:</label>
                        <select disabled class="form-control" type="text" name="city" id="city" placeholder="Cidade" autocomplete="off" required></select>
                      </div>
                      <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                      </div>
                      <div class="form-group">
                        <label for="rec_password">Senha:</label>
                        <input type="password" class="form-control" id="rec_password" name="rec_password" placeholder="Senha" required>
                      </div>
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
  <script>
        $("#uf").on("change",function(){
            var idEstado = $("#uf").val();
            $.ajax({
                url: 'selectCity.php',
                type: 'POST',
                data: {id:idEstado},
                beforeSend: function(){
                    $("#city").removeAttr("disabled");
                    $("#city").html("Carregando...");
                 },
                success: function(data){
                    $("#city").removeAttr("disabled");
                    $("#city").html(data);
                },
                error: function(data){
                    $("#city").removeAttr("disabled");
                    $("#city").html("Houve um erro ao carregar");
                }   
            })
        });
  </script>
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