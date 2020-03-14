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
    
    <!--PWA-->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="img/pwa/ios-icon.png">
    <script>       
    // Verifica se o navegador suporta o PWA e service worker
    if ("serviceWorker" in navigator) {
        if (navigator.serviceWorker.controller) {
            console.log("[PWA Builder] active service worker found, no need to register");
        } else {
        // Register the service worker
            navigator.serviceWorker
            .register("pwabuilder-sw.js", {
            scope: "./"
        })
        .then(function (reg) {
        console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
            });
        }
    }
    </script>
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
            <a href="index.html"><img id="logo-bayer" src="./img/bayer_logo-01-02.png"></a>
            <a class="navbar-brand text-secondary" href="index.html">Bayer Carreiras Brasil</a>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">Login</h1>
      </div>
      <div class="row">
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form action="login.php" method="POST">
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="E-mail" required>
                <input class="form-control form-control-lg mt-3" type="password" name="cand_password" id="cand_password" placeholder="Senha" required>
              </div>
            </div>
            <div class="form-row justify-content-center text-center">
              <div class="col-12 col-md-12 mt-3">
                <button type="submit" value="Entrar" name="submit" id="submit" class="btn btn-block btn-lg btn-primary">Entrar</button>
              </div>
            </div>
          </form>
            <div class="form-row justify-content-center text-center">
              <div class="col-6 col-md-6 mt-3">
                 <h6 class="mb-3 mt-1">Não possui conta?</h6>
                <button class="btn btn-block btn-lg btn-success" onclick="window.location='sign-up.php';">Criar conta</button>
              </div>
              <div class="col-6 col-md-6 mt-3">
                 <h6 class="mb-3 mt-1">Esqueceu sua senha?</h6>
                <button class="btn btn-block btn-lg btn-info" onclick="window.location='forgot-password.php';">Redefinir</button>
              </div>
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

</html>