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

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Recuperar Senha</h1>
      </div>
      <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            
<?php


if( !empty($_POST) ){
    // inclui o arquivo de inicialização
    require 'connectionDAO.php';
    // resgata variáveis do formulário
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    //conecta no banco
    $PDO = db_connect();
    $sql = "SELECT email, class, first_name FROM candidates WHERE email = '$email' UNION SELECT email, class, first_name FROM recruiters WHERE email = '$email'";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':class', $class);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    if (count($users) == 1) {
        $first_name = $users[0]["first_name"];
        // o email existe, vamos gerar um link único e enviá-lo para o e-mail
        // gerar a chave
        $chave = sha1(uniqid( mt_rand(), true));
        
        // guardar este par de valores na tabela para confirmar mais tarde
        if ($users[0]["class"]=='cand'){
            $sqlm = "UPDATE candidates SET password_key = '$chave' WHERE email = '$email'";
        }else {
            $sqlm = "UPDATE recruiters SET password_key = '$chave' WHERE email = '$email'";
        }
        $stmtm = $PDO->prepare($sqlm);
        $stmtm->execute(array($email));
        
        if ($stmtm->rowCount()){
            // Customiza o envio do email
            $to = $email;
            $subject = "Recuperar Senha";
            $link = "http://www.bayercarreiras.tk/recover-password.php?email=$email&password_key=$chave";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-Type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: Bayer Carreiras<no-reply@bayercarreiras.tk>" . "\r\n" . "Reply-To: no-reply@bayercarreiras.tk" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "X-MSMail-Priority: High";
//          $message = "Olá $first_name," .  "<br><br>" . "Acesse o link a seguir para trocar sua senha: " . "<br>" .$link;
            $message = '
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
	xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="width=device-width" name="viewport" />
	<meta content="IE=edge" http-equiv="X-UA-Compatible" />
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body {
			margin: 0;
			padding: 0;
		}

		#botao{
			-webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
	color: initial;
	padding: 15px;
	background-color: #01beff;
	color:#fff;
	text-decoration: none
		}

		table,
		td,
		tr {
			vertical-align: top;
			border-collapse: collapse;
		}

		* {
			line-height: inherit;
		}

		a[x-apple-data-detectors=true] {
			color: inherit !important;
			text-decoration: none !important;
		}
	</style>
	<style id="media-query" type="text/css">
		@media (max-width: 520px) {

			.block-grid,
			.col {
				min-width: 320px !important;
				max-width: 100% !important;
				display: block !important;
			}

			.block-grid {
				width: 100% !important;
			}

			.col {
				width: 100% !important;
			}

			.col>div {
				margin: 0 auto;
			}

			img.fullwidth,
			img.fullwidthOnMobile {
				max-width: 100% !important;
			}

			.no-stack .col {
				min-width: 0 !important;
				display: table-cell !important;
			}

			.no-stack.two-up .col {
				width: 50% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num8 {
				width: 66% !important;
			}

			.no-stack .col.num4 {
				width: 33% !important;
			}

			.no-stack .col.num3 {
				width: 25% !important;
			}

			.no-stack .col.num6 {
				width: 50% !important;
			}

			.no-stack .col.num9 {
				width: 75% !important;
			}

			.video-block {
				max-width: none !important;
			}

			.mobile_hide {
				min-height: 0px;
				max-height: 0px;
				max-width: 0px;
				display: none;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide {
				display: block !important;
				max-height: none !important;
			}
		}
	</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
	<table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
		style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;"
		valign="top" width="100%">
		<tbody>
			<tr style="vertical-align: top;" valign="top">
				<td style="word-break: break-word; vertical-align: top;" valign="top">
					<div style="background-color:transparent;">
						<div class="block-grid"
							style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
							<div
								style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
								<div class="col num12"
									style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
									<div style="width:100% !important;">
										<div
											style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<div align="center" class="img-container center autowidth"
												style="padding-right: 0px;padding-left: 0px;">
												<div style="font-size:1px;line-height:25px"></div><img align="center"
													alt="Image" border="0" class="center autowidth"
													src="bayercarreiras.tk/img/bayer_logo_email_password-01.png"
													style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 180px; display: block;"
													title="Image" width="64" />
											</div>
											<div
												style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:30px;padding-right:30px;padding-bottom:15px;padding-left:30px;">
												<div
													style="font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; font-size: 12px; line-height: 1.2; color: #555555; mso-line-height-alt: 14px;">
													<h1 style="text-align: center; color: #3f9904"<>Olá, '. $first_name . '.<br></h1>
													<p
														style="font-size: 18px; line-height: 1.2; text-align: center; mso-line-height-alt: 22px; margin: 0;">
														<span style="font-size: 18px;"><strong>Acesse o link a seguir para alterar<br> sua senha com segurança.</strong></span></p>
												</div>
											</div>
											<div
												style="color:#5ACEE1;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:5px;padding-left:0px;">
												<div
													style="font-size: 12px; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #5ACEE1; mso-line-height-alt: 14px;">
													<br>
													<p
														style="font-size: 18px; line-height: 1.2; text-align: center; mso-line-height-alt: 22px; margin-top: 3; margin-bottom: 5;">
														<a id="botao" href="'.$link.'"><span style="font-size: 18px;"><strong><span
																	style="font-size: 18px;">Alterar Senha</span></strong></span></a></p>
												</div>
												<br>
											</div>
											<div
												style="color:#989898;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:10px;padding-right:10px;padding-bottom:30px;padding-left:10px;">
												<div
													style="font-size: 12px; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; color: #989898; mso-line-height-alt: 14px;">
													<p
														style="font-size: 14px; line-height: 1.2; text-align: center; mso-line-height-alt: 17px; margin: 0;">
														Se você não possui cadastro no portal Bayer Carreiras e recebeu<br>esse e-mail por engano, apenas ignore esta mensagem.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="background-color:#009900;">
						<div class="block-grid"
							style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
							<div
								style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
								<div class="col num12"
									style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
									<div style="width:100% !important;">
										<div
											style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
											<table border="0" cellpadding="0" cellspacing="0" class="divider"
												role="presentation"
												style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
												valign="top" width="100%">
												<tbody>
													<tr style="vertical-align: top;" valign="top">
														<td class="divider_inner"
															style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;"
															valign="top">
															<table align="center" border="0" cellpadding="0"
																cellspacing="0" class="divider_content"
																role="presentation"
																style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; width: 100%;"
																valign="top" width="100%">
																<tbody>
																	<tr style="vertical-align: top;" valign="top">
																		<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;"
																			valign="top"><span></span></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="background-color:#CCD7D9;">
						<div class="block-grid"
							style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #CCD7D9;">
							<div style="border-collapse: collapse;display: table;width: 100%;background-color:#CCD7D9;">
								<div class="col num12"
									style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
									
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>
            ';
            // Envia o email
            if( mail($to, $subject, $message, $headers) ){
                echo"<script>
                    Swal.fire({
                    title: 'Sucesso!',
                    type: 'sucess',
                    html: 'Foi enviado para o seu email uma mensagem onde poderá encontrar um link único para alterar a sua senha. <br>Caso não receba, verifique sua caixa de spam.',
                    }).then((result) => {
                    if (result.value) {
                        window.location.href = 'form-login.php'; 
                    }
                    })
                </script>";
            } else {
                echo"<script>
                    Swal.fire({   
                        title: 'Ouve um erro ao enviar o email',   
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
            }
        } else {
            echo"<script>
                Swal.fire({   
                    title: 'Não foi possível gerar o endereço único',   
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
        }
    } else {
        echo"<script>
            Swal.fire({   
                title: 'Este e-mail não está registrado',   
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
	}
} else {
    // mostrar formulário de recuperação
?>
          <form method="post">
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="E-mail" required>
              </div>
            </div>
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mt-3">
                <button type="submit" value="Entrar" name="submit" id="submit" class="btn btn-block btn-lg btn-primary">Recuperar</button>
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
</body>
</html>
<?php
}
?>