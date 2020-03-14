<?php 

// inclui o arquivo de inicialização
require_once 'connectionDAO.php';

// resgata variáveis do formulário
$emailIndex = isset($_POST['email']) ? $_POST['email'] : null;

require_once 'connectionDAO.php';

$PDO = db_connect();
$PDO->exec('SET CHARACTER SET utf8');
$sql = "SELECT * FROM estados ORDER BY nome ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$aux = $stmt->fetchAll();
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
  <script src="vendor/jquery/jquery-1.7.1.min.js"></script>
  <script language="JavaScript" src="vendor/uf-city.js"></script>
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
        <h1 class="mb-5">Cadastro Candidato</h1>
      </div>
      <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="register.php" method="post">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="text" name="first_name" id="first_name" placeholder="Primeiro Nome" autocomplete="off"  required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="text" name="last_name" id="last_name" placeholder="Último Sobrenome" autocomplete="off"  required>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="cand_cpf" id="cand_cpf" placeholder="CPF" autocomplete="off" minlength="11" maxlength="11" required oninput = "TestaCPF(this)">
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="date" name="birth_date" id="birth_date" placeholder="Data de Nascimento" autocomplete="off" required oninput="checkBirthDate(this)">
                    </div>
                    <div class="col-md-6 form-group">
                        <select class="form-control form-control-lg" type="text" name="gender" id="gender" placeholder="Sexo" autocomplete="off" required>
                            <option disabled selected>Sexo</option>
                            <option value="F">Feminino</option>
                            <option value="M">Masculino</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <select class="form-control form-control-lg" type="text" name="uf" id="uf" placeholder="Estado" autocomplete="off" required>
                            <option disabled selected>Estado</option>
                            <?php 
                                foreach($aux as $estados){
                                     echo '<option value="'.$estados['id'].'">'.$estados['nome'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <select disabled class="form-control form-control-lg" type="text" name="city" id="city" placeholder="Cidade" autocomplete="off" required>
                             <option disabled selected>Cidade</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="text" name="mobile_number" id="mobile_number" placeholder="Número de Celular" autocomplete="off" minlength="8" maxlength="15" oninput="checkphone(this)" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="text" name="phone_number" id="phone_number" placeholder="Número de Telefone" minlength="8" maxlength="15" autocomplete="off" oninput="checkphone(this)">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="E-mail" autocomplete="off" value="<?php echo $emailIndex ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="password" name="cand_password" id="cand_password" placeholder="Senha" minlength="6" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input class="form-control form-control-lg" type="password" name="confirm_password" id="confirm_password" placeholder="Confirmar Senha" minlength="6" required oninput="checkPassword(this)">
                    </div>
                </div>
            <!-- CONFIRMA SE SENHAS BATEM --> 
                <script language='javascript' type='text/javascript'>
                    function checkPassword(input) {
                        if (input.value != document.getElementById('cand_password').value) {
                            input.setCustomValidity('Senhas devem iguais.');
                        } else {
                            // input is valid -- reset the error message
                            input.setCustomValidity('');
                        }
                    }
                    
                    function checkBirthDate(input){
                        const inputNasc = input.value;
                        document.querySelector("form").addEventListener("submit", function(){
                          //obter array com [ano,mes,dia] através de split("-") e convertendo em numero com Map
                          let nasc = inputNasc.value.split("-").map(Number);
                          //construir data 16 anos a seguir a data dada pelo usuario
                          let depois16Anos = new Date(nasc[0] + 16, nasc[1] -1 , nasc[2]);
                          let agora = new Date();
                          
                          if (depois16Anos <= agora){
                            input.setCustomValidity('');
                            
                          }
                          else {
                            input.setCustomValidity('Candidato deve ser maior de 16 anos.');
                           // event.preventDefault(); //só para não mudar de pagina na submissão do formulario
                          }
                        });
                    }
                    
                    function checkphone(input) {
                        const inputphone = input.value;
                            intphone=parseInt(inputphone, 10);
                            if (Number.isInteger(intphone)) {
                               input.setCustomValidity('');
                            }else{
                            input.setCustomValidity('Telefone deve conter apenas numeros.');
                            }
                            
                    }
                    
                    
                    function TestaCPF(input) {
                        var strCPF = input.value;
                        var Soma;
                        var Resto;
                        Soma = 0;
                      if (strCPF == "00000000000"|| strCPF == "11111111111"|| strCPF == "22222222222"|| strCPF == "33333333333"|| strCPF == "44444444444"|| strCPF == "55555555555"|| strCPF == "66666666666"|| strCPF == "77777777777"|| strCPF == "88888888888"|| strCPF == "99999999999") return input.setCustomValidity('CPF invalido.');
                         
                      for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                      Resto = (Soma * 10) % 11;
                       
                        if ((Resto == 10) || (Resto == 11))  Resto = 0;
                        if (Resto != parseInt(strCPF.substring(9, 10)) ) return input.setCustomValidity('CPF invalido.');
                       
                      Soma = 0;
                        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                        Resto = (Soma * 10) % 11;
                       
                        if ((Resto == 10) || (Resto == 11))  Resto = 0;
                        if (Resto != parseInt(strCPF.substring(10, 11) ) ) return input.setCustomValidity('CPF invalido.');
                        return input.setCustomValidity('');
                    }
                </script>
                <br>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" required><span class="custom-control-label">Criando uma conta, você concorda com os <u class="font-italic">termos e condições de uso.</u>.</span>
                    </label>
                </div>
                <div class="form-group pt-2">
                    <input class="btn btn-block btn-primary" type="submit" name="submit" value="Cadastrar" id="submit">
                </div>
            </form>
            <div class="text-center">
                <p>Já tem cadastro? <a href="form-login.php">Login.</a></p>
            </div>
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
          <p class="text-muted small mb-4 mb-lg-0">&copy; Última atualização: 29/set/2019 Copyright © Bayer AG</p>
        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
          <ul class="list-inline mb-0">
            <li class="list-inline-item mr-3">
              <a href="https://www.facebook.com/bayerjovensBR">
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

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>