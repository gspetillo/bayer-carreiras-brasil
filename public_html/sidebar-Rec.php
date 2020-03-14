    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | blue | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="./img/bayer_logo-01-01.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          Bayer Carreiras
          <!-- <div class="logo-image-big">
            <img src="../Bayer_TA/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./dashboard-Rec.php">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./candidates.php">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>Candidatos</p>
            </a>
          </li>
          <li>
            <a href="./job-roles.php">
              <i class="nc-icon nc-briefcase-24"></i>
              <p>Vagas</p>
            </a>
          </li>
          <?php if($_SESSION['email_nivel']=='1'){ ?>
          <li>
            <a href="./recruiters.php">
              <i class="nc-icon nc-badge"></i>
              <p>Recrutadores</p>
            </a>
          </li>
          <?php } ?>
          <li>
            <a href="./profile-Rec.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Perfil</p>
            </a>
          </li>
        </ul>
      </div>
    </div>