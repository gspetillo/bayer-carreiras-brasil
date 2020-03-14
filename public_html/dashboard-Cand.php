<?php
session_start();
 
require_once 'connectionDAO.php';

require 'check-Cand.php';

    // busca os dados do usuário no banco ONDE status = 0
$PDO = db_connect();
$cand_cpf = $_SESSION['email_cand_cpf'];
$sql = "SELECT * FROM candidates WHERE cand_cpf = $cand_cpf";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$aux = $stmt->fetch(PDO::FETCH_ASSOC);
$step = $aux['step'];
$status = $aux['status'];
$timestamp = date("d/m/Y", strtotime($aux['timestamp_cand']));

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
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="timeline.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href=".demo/demo.css" rel="stylesheet" />
  <link rel="shortcut icon" href="./img/bayer_logo.ico" />
  <style>
      .status-data{
         color: #999999;
      }

  </style>

</head>

<body class="">
  <div class="wrapper ">
    <?php include 'sidebar-Cand.php';?>
    <div class="main-panel">
      <!-- Navbar -->
        <?php include 'navbar.php';?>
      <!-- End Navbar -->
      
<!-- <div class="panel-header panel-header-lg">
    <canvas id="bigCarreirasChart"></canvas>
</div> -->

      <div class="content">
        <!-- ESCOLHA A VAGA -->
        <?php if($step==2) { ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-12 text-center">
                    <h5>Escolha a vaga desejada abaixo</h5>
                    <p>Após você clicar SELECIONAR, você não poderar mais mudar a vaga</p>
                    <div class="row justify-content-center">
                    <div class="col-4">
                    <form action="update-job-roles.php" method="post">
                        <select disabled name="job_role" class="form-control form-control-sm">
                            <option value="vaga1">Selecionar vaga</option>
                            <option value="vaga2">Vaga 1</option>
                            <option value="vaga3">Vaga 2</option>
                        </select>
                        <input type="submit" class="btn btn-md btn-info" value="SELECIONAR">
                    </form>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
              </div>
            </div>
          </div>
         </div>
        <?php } ?>
        <!-- PARTE DE CIMA COM DADOS DA VAGA -->
        <?php if($step>=3) { ?>
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-briefcase-24 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Área</p>
                      <p class="card-title">Medicina
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Vagas Disponíveis</p>
                      <p class="card-title">115
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Candidatos</p>
                      <p class="card-title">99+
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <!-- TIMELINE -->
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header ">
                <h5 class="card-title">Status do processo</h5>
              </div>
              <div class="card-body ">
    			<ul class="timeline">
    				<li class="accepted">
                        <span><h6>Inscrição</h6><p>Seu cadastro no portal Bayer Carreiras foi realizado no dia <?php echo $timestamp; ?>. Continue para as próximas etapas do processo para finalizar sua candidatura.</p></span>
    				</li>
    				
    				<?php switch ($step) {
    				    
    				    default:
                        ?>
            				<li>
            					<h6>Envie seu currículo</h6>
            					<p>Sua inscrição foi confirmada com sucesso. Acesse a aba em <i>Perfil > Currículo</i> e envie o arquivo com extensão PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li>
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que for de sua preferência para prosseguir no processo seletivo. </p>
            				</li>
            				<li>
            					<h6>Avaliação do recrutador</h6>
            					<p>Nossa equipe de recrutadores está analisando seu perfil para selecionar os melhores currículos para continuar no processo. O feedback da sua candidatura será enviado por notificação em seu celular ou no e-mail do seu cadastro. </p>
            				</li>
            				<?php 
                			if(($status!=1)&&($status!=2))
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li>
                					<h6>Não selecionado</h6>
                					<p> Neste momento, decidimos não proceder com sua atual candidatura para a vaga. Continue acompanhando nossas oportunidades para participar de novos processos seletivos.</p>
                				</li>
                			<?php break;} ?>
            				<li>
                                <h6>Entrevista com gestores</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li>
            					<h6>Processo de contratação</h6>
            					<p> Em breve, nossa equipe de recursos humanos entrará em contato. Aguarde novas notificações</p>
            				</li>
                        <?php 
    				    break;
    				    
                        case 1:
                        ?>
            				<li class="accepted">
            					<h6>Currículo enviado</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li>
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li>
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if(($status!=1)&&($status!=2)){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Funilagem</h6>
                					<p> Aqui é onde vai ser mostrado se você foi ou não, aceito para a vaga.</p>
                				</li>
                			<?php }
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li>
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li>
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li>
            					<h6>Em processo de contratação</h6>
                        <?php 
    				    break;
    				    
                        case 2:
                        ?>
            				<li class="accepted">
            					<h6>Currículo enviado</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li class="accepted">
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li>
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if(($status!=1)&&($status!=2)){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Funilagem</h6>
                					<p> Aqui é onde vai ser mostrado se você foi ou não, aceito para a vaga.</p>
                				</li>
                			<?php }
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li>
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li>
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li>
            					<h6>Em processo de contratação</h6>
            				</li>
                        <?php 
    				    break;
    				    
                        case 3:
                        ?>
            				<li class="accepted">
            					<h6>Envie seu currículo</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li class="accepted">
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li class="accepted">
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if(($status!=1)&&($status!=2)){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Funilagem</h6>
                					<p> Aqui é onde vai ser mostrado se você foi ou não, aceito para a vaga.</p>
                				</li>
                			<?php }
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li>
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li>
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li>
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li>
            					<h6>Em processo de contratação</h6>
            				</li>
                        <?php 
    				    break;
    				    
                        case 4:
                        ?>
            				<li class="accepted">
            					<h6>Envie seu currículo</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li class="accepted">
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li class="accepted">
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li class="accepted">
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li class="rejected">
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li>
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li>
            					<h6>Em processo de contratação</h6>
            				</li>
                        <?php 
    				    break;
    				    
                        case 5:
                        ?>
            				<li class="accepted">
            					<h6>Envie seu currículo</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li class="accepted">
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li class="accepted">
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li class="accepted">
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li class="rejected">
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li class="accepted">
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nosso time.</p>
            				</li>
            				<li>
            					<h6>Em processo de contratação</h6>
            				</li>
                        <?php
                        break;
                        
                        case 6:
                        ?>
            				<li class="accepted">
            					<h6>Envie seu currículo</h6>
            					<p>Agora que você já completou seu cadastro inicial, vá até Perfil > Currículo e envie o arquivo PDF, DOC ou DOCX para a triagem inicial do seu perfil profissional por nossa inteligência artificial, que encontrará a melhor vaga para você!</p>
            				</li>
            				<li class="accepted">
            					<h6>Selecione a vaga</h6>
            					<p>Seu currículo foi analisado pela nossa inteligência artificial e selecionou as vagas que mais se adequam ao seu perfil profissional. Dentre elas, no menu acima, escolha a que melhor te satisfaz para seguir o processo seletivo. </p>
            				</li>
            				<li class="accepted">
            					<h6>Avaliação do recrutador</h6>
            					<p>Agora que você selecionou a vaga, nossa equipe de recrutadores está analisando seu perfil para verificar se você está apto para seguir o processo. Você será notificado quando o processo de análise terminar e o recrutador decidir para qual caminho irá seguir. </p>
            				</li>
            				<?php 
                			if($status==1){?>
                            <!-- APROVADOS -->
                				<li class="accepted">
                					<h6>Selecionado para entrevista</h6>
                					<p> Parabéns! O seu currículo foi aprovado por nossos recrutadores e você foi encaminhado para uma entrevista com os gestores da Bayer. Fique atento ao seu e-mail, em breve enviaremos mais informações.</p>
                				</li>
                			<?php }
            				if($status==2){?>
                                <!-- REPROVADOS -->
                				<li class="rejected">
                					<h6>Não selecionado</h6>
                					<p> Neste momento, nós decidimos não proceder com sua atual candidatura para a vaga. Mas não se preocupe que este não precisa ser nosso fim. Nosso time está sempre a procura de novos talentos, esperamos contar com sua re-aplicação 6 meses a partir de hoje.</p>
                				</li>
                			<?php break;} ?>
            				<li class="accepted">
                                <h6>Realização de entrevista</h6>
            					<p> Você fez a entrevista e nossa equipe está analisando se você está preparado para se juntar com nossa equipe.</p>
            				</li>
            				<li class="loading">
            					<h6>Em processo de contratação</h6>
            				</li>
                        <?php
                        break;
                    }?>

    			</ul>
              </div>
              <div class="card-footer ">
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
                  <a href="#" target="_blank">Bayer</a>
                </li>
                <li>
                  <a href="#" target="_blank">Blog</a>
                </li>
                <li>
                  <a href="#" target="_blank">Termos</a>
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
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in Bayer_TA/Bayer_TA-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>