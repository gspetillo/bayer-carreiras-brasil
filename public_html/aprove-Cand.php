<html>
    <body style="font-family:'Open Sans';">
        <script src="/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">

<?php 

// inclui o arquivo de inicialização
require_once 'connectionDAO.php';

// pega o ID da URL
$cand_cpf = isset($_GET['cand_cpf']) ? $_GET['cand_cpf'] : null;
 
// valida o ID
if (empty($cand_cpf)) {
    echo "ID não informado";
    exit;
}

$status = '1';

$PDO = db_connect();

$sqlc = "SELECT * FROM candidates WHERE cand_cpf = :cand_cpf";
$stmtc = $PDO->prepare($sqlc);
$stmtc->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);
$stmtc->execute();
$aux = $stmtc->fetch(PDO::FETCH_ASSOC);

$sql = "UPDATE candidates SET status = :status WHERE cand_cpf = :cand_cpf";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':cand_cpf', $cand_cpf, PDO::PARAM_STR);

if ($stmt->execute()){
    // Customiza o envio do email
    $to = $aux['email'];
    $subject = "Atualização de status do Processo seletivo";
    $link = "http://www.bayercarreiras.tk/form-login.php";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-Type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: Bayer Carreiras<no-reply@bayercarreiras.tk>" . "\r\n" . "Reply-To: no-reply@bayercarreiras.tk" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "X-MSMail-Priority: High";
    //$message = "Olá $first_name," .  "<br><br>" . "Acesse o link a seguir para trocar sua senha: " . "<br>" .$link;
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
        													<h1 style="text-align: center; color: #3f9904"<>Olá, '. $aux['first_name'] . '.<br></h1>
        													<p
        														style="font-size: 18px; line-height: 1.2; text-align: center; mso-line-height-alt: 22px; margin: 0;">
        														<span style="font-size: 18px;"><strong>Ótimas notícias!<br><br>Voce foi aprovado no processo seletivo Bayer Carreiras Brasil.<br> O seu recrutador entrará em contato em breve para os próximos passos.<br><br>Acompanhe o processo seletivo da sua candidatura no nosso portal.</strong></span></p>
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
        																	style="font-size: 18px;">Portal Bayer Carreiras</span></strong></span></a></p>
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
    // ENVIA O EMAIL
    mail($to, $subject, $message, $headers);
    echo"<script>
    Swal.fire({   
        type: 'success',
        title: 'Candidato aprovado',
        showConfirmButton: false,
        timer: 1200
        }).then(function() {
        window.location.href = 'candidates.php';
    })
    </script>";
    }else {
    echo "Erro ao atualizar dados, tente novamente mais tarde";
    print_r($stmt->errorInfo());
}
?>
    </body>
</html>