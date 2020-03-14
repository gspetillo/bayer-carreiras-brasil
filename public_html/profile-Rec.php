<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Rec.php';

$rec_cpf = $_SESSION['email_rec_cpf'];
// busca os dados do usuário no banco
$PDO = db_connect();
$sql = "SELECT * FROM recruiters WHERE rec_cpf = $rec_cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':rec_cpf', $rec_cpf, PDO::PARAM_STR);
$stmt->execute();
$aux = $stmt->fetch(PDO::FETCH_ASSOC);

$PDO->exec('SET CHARACTER SET utf8');
$sqlE = "SELECT * FROM estados ORDER BY nome ASC";
$stmt = $PDO->prepare($sqlE);
$stmt->execute();
$fetchAll = $stmt->fetchAll();
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
      #avatar{
        background:#51bcda;
        color:#fff;
        width:125px;
        height:125px;
        line-height:300px;
        vertical-align:middle;
        text-align:center;
        font-family: arial;
        font-size:30px;
        
        border-radius:50%;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;
        
        }
  </style>
   <script language="JavaScript" src="vendor/uf-cityUpdate.js"></script>
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
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
              </div>
              <div class="card-body">
                <div class="author d-flex justify-content-center text-center">
                    <div id="avatar">
                        <h2 class="pt-3">
                          <?php echo substr($aux['first_name'],0,1); ?>
                        </h2>
                   </div>
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <h5 class="title text-info"><?php echo $aux['first_name']?> <?php echo $aux['last_name'] ?></h5>
                </div>
                <!-- FORMULARIO CURRICULUM -->
              </div>
            </div>
          </div>
        <!-- INICIO FORMULARIO-->
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Editar Perfil</h5>
              </div>
            <form action="update-Rec.php" method="post" enctype="multipart/form-data">
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Primeiro Nome</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nome" value="<?php echo $aux['first_name']?>" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Último Sobrenome</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Sobrenome" value="<?php echo $aux['last_name']?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>CPF</label>
                    <input type="text" class="form-control" placeholder="CPF" id="rec_cpf" name="rec_cpf" value="<?php echo $aux['rec_cpf']?>" readonly required>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control form-control-md" type="text" name="uf" id="uf" placeholder="Estado" autocomplete="off" required>
                            <?php 
                                foreach($fetchAll as $estados){
                                    if($estados['id'] ==$aux['uf'] )
                                        echo '<option selected value="'.$estados['id'].'">'.$estados['nome'].'</option>';
                                    else
                                        echo '<option value="'.$estados['id'].'">'.$estados['nome'].'</option>';
                                }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Cidade</label>
                        <select type="text" class="form-control" placeholder="Cidade" id="city" name="city" autocomplete="off" required>
                            <option selected  value="<?php echo $aux['city']?>"><?php echo $aux['city']?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" placeholder="Celular" id="email" name="email" value="<?php echo $aux['email']?>" required>
                      </div>
                    </div>
                  </div>

                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" id="submit" name="submit" class="btn btn-primary btn-round mb-4">Atualizar</button>
                    </div>
                  </div>
                </form>
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
    <script src="vendor/jquery/jquery.js"></script>
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