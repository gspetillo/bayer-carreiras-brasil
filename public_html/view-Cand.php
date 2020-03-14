<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Rec.php';

// pega o ID da URL
$cand_cpf = isset($_GET['cand_cpf']) ? $_GET['cand_cpf'] : null;
 
// valida o ID
if (empty($cand_cpf)) {
    echo "ID não informado";
    exit;
}

// busca os dados do usuário no banco
$PDO = db_connect();
$sql = "SELECT * FROM candidates as R INNER JOIN curriculums as C ON R.cand_cpf = C.cand_cpf WHERE R.cand_cpf = $cand_cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);
$stmt->execute();
$aux = $stmt->fetch(PDO::FETCH_ASSOC);
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
      .pt-3{
          -webkit-touch-callout: none;
           -webkit-user-select: none;
           -khtml-user-select: none;
           -moz-user-select: none;
           -ms-user-select: none;
           user-select: none;
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
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
              </div>
              <div class="card-body">

                <!-- FORMULARIO CURRICULUM -->
                <br>
                <hr>
                <form enctype="multipart/form-data">
                  <p class="text-center">Currículo</p>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="cv_path" name="cv_path" accept="application/msword, application/pdf" readonly disabled>
                    <?php if($aux['cv_path']==""){?>
                        <label class="custom-file-label" for="cv_path">Selecionar arquivo</label>
                    <?php }else{ ?>
                        <label class="custom-file-label" for="cv_path"><?php echo substr($aux['cv_path'], 11)?></label>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-success btn-sm text-center w-100" href="<?php echo $aux['cv_path']?>" role="button">Visualizar Currículo</a>
                        </div>
                    <?php } ?>
                  </div>
                <script>
                // Add the following code if you want the name of the file appear on select
                $(".custom-file-input").on("change", function() {
                  var fileName = $(this).val().split("\\").pop();
                  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
                </script> 
                <br><p> </p>
              </div>
            </div>
          </div>
        <!-- INICIO FORMULARIO-->
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Visualizar Perfil</h5>
              </div>
              <!-- FORM ERA AQUI -->
              <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group input-group-md">
                        <label>Primeiro Nome</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nome" value="<?php echo $aux['first_name']?>" readonly disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group input-group-md">
                        <label>Último Sobrenome</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Sobrenome" value="<?php echo $aux['last_name']?>" readonly disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group input-group-md">
                    <label>CPF</label>
                    <input type="text" class="form-control" placeholder="CPF" id="cand_cpf" name="cand_cpf" value="<?php echo $aux['cand_cpf']?>" readonly disabled>
                  </div>
                  <div class="row">
                      <div class="col-md-6 form-group input-group-md">
                        <label>Data de Nascimento</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Data de Nascimento" value="<?php echo $aux['birth_date']?>" readonly disabled>
                      </div>
                      <div class="col-md-6 form-group input-group-md">
                        <label>Sexo</label>
                        <select class="form-control form-control-md" type="text" name="gender" id="gender" placeholder="Sexo" autocomplete="off" readonly disabled>
                            <option selected readonly value="<?php echo $aux['gender']?>"><?php echo $aux['gender']?></option>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                            <option value="O">Outro</option>
                        </select>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group input-group-md">
                        <label>Estado</label>
                        <select class="form-control form-control-md" type="text" name="uf" id="uf" placeholder="Estado" autocomplete="off" readonly disabled>
                            <option selected readonly value="<?php echo $aux['uf']?>"><?php echo $aux['uf']?></option>
                           <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group input-group-md">
                        <label>Cidade</label>
                        <input type="text" class="form-control" placeholder="Cidade" id="city" name="city" value="<?php echo $aux['city']?>" readonly disabled>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group input-group-md">
                        <label>Celular</label>
                        <input type="text" class="form-control" placeholder="Celular" id="mobile_number" name="mobile_number" value="<?php echo $aux['mobile_number']?>" readonly disabled>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group input-group-md">
                        <label>Telefone Residencial</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $aux['phone_number']?>" readonly disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group input-group-md">
                        <label>E-mail</label>
                        <input type="text" class="form-control" placeholder="Celular" id="email" name="email" value="<?php echo $aux['email']?>" readonly disabled>
                      </div>
                    </div>
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