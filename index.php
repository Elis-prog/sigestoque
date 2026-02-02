<?php
session_start();
include('config/config.php');

//login 
if (isset($_POST['login'])) {
  $admin_email = $_POST['admin_email'];
  $admin_password = sha1(md5($_POST['admin_password'])); //criptografia dupla para aumentar a segurança
  $stmt = $mysqli->prepare("SELECT admin_email, admin_password, admin_id  FROM   tbladmin WHERE (admin_email =? AND admin_password =?)"); 
  $stmt->bind_param('ss',  $admin_email, $admin_password); //vincular parâmetros buscados
  $stmt->execute(); //executa bind 
  $stmt->bind_result($admin_email, $admin_password, $admin_id); //resultado de ligação
  $rs = $stmt->fetch();
  $_SESSION['admin_id'] = $admin_id;
  if ($rs) {
    header("location:dashboard.php");
  } else {
    $err = " Credenciais de Autenticação Incorretas ";
  }
}

require_once('partials/_head.php');
?>


<body class="bg-gray-200">
  
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <style>
    body {
      background-color: #f0f2f5;
      background-image: radial-gradient(#cbd5e1 2px, transparent 2px);
      background-size: 30px 30px;
    }
    .login-card {
      background: white;
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      width: 100%;
      max-width: 450px;
      margin: auto;
      text-align: center;
      position: relative;
    }

    .login-title {
      font-weight: 700;
      color: #7a7a7a; /* Muted text like in image 'SGP' */
      font-size: 2rem;
      margin-bottom: 0.5rem;
      color: #9333ea; /* A matching color or the generic rose */ 
      /* User asked for their system colors (Indigo/Blue #4f46e5) */
      color: #4f46e5;
    }
    .login-subtitle {
      color: #0d9488; /* Teal like image or System Blue? System Blue. */
      color: #4f46e5;
      font-weight: 500;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 1rem;
    }
    .separator {
      height: 2px;
      background-color: #f0f0f0;
      margin: 1.5rem auto;
      width: 60%;
    }
    .form-group {
      text-align: left;
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      font-size: 0.75rem;
      font-weight: 700;
      color: #9ca3af;
      text-transform: uppercase;
      margin-bottom: 0.5rem;
      margin-left: 0;
    }
    .form-control-custom {
      background-color: #fffbeb !important; /* Yellowish bg from image reference */
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 0.75rem;
      width: 100%;
      font-size: 0.9rem;
    }
    .form-control-custom:focus {
      background-color: #fff !important;
      border-color: #4f46e5;
      outline: none;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }
    .btn-login {
      background-color: #4f46e5; /* System Color */
      color: white;
      width: 100%;
      padding: 0.75rem;
      border-radius: 6px;
      font-weight: 600;
      text-transform: none;
      border: none;
      margin-top: 1rem;
      transition: background 0.2s;
    }
    .btn-login:hover {
      background-color: #4338ca;
    }
    /* Decor Dots Helper */
    .decor-dots {
      position: absolute;
      width: 100px;
      height: 100px;
      background-image: radial-gradient(#4f46e5 2px, transparent 2px); /* Using system color for dots */
      background-size: 20px 20px;
      opacity: 0.2;
      z-index: -1;
    }
    .decor-dots.top-right { top: -20px; right: -20px; }
    .decor-dots.bottom-left { bottom: -20px; left: -20px; }
    .login-logo {
      max-width: 100%;
      height: auto;
      object-fit: contain;
      margin-bottom: 0.5rem;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>

  <main class="main-content mt-0 d-flex align-items-center min-vh-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 position-relative">
            <!-- Decorative Dots behind card -->
            <div class="decor-dots top-right" style="right: -40px; top: -40px;"></div>
            <div class="decor-dots bottom-left" style="left: -40px; bottom: -40px;"></div>

            <div class="login-card">
              <img src="assets/img/sige.png" alt="Logo" class="login-logo">
           
              <div class="separator"></div>
              <p class="login-subtitle">Sistema de Gestão de Estoque</p>

              <form role="form" method="post" class="mt-4">
                <div class="form-group">
                  <label>Email:</label>
                  <input type="email" name="admin_email" class="form-control-custom" required value="">
                </div>
                
                <div class="form-group">
                  <label>Senha:</label>
                  <input type="password" name="admin_password" class="form-control-custom" required value="">
                </div>
                
                <button type="submit" name="login" class="btn btn-login">Acessar</button>
              </form>
            </div>

        </div>
      </div>
    </div>
  </main>
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>