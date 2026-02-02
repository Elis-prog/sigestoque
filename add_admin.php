<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
//ADD Funcionário
if (isset($_POST['addAdm'])) { 
  if (empty($_POST["adm_nome"]) || empty($_POST["adm_email"]) || empty($_POST['adm_senha'])) {
    $err = "Valores em branco não aceitos";
  } else {
    $adm_numero = $_POST['adm_numero'];
    $adm_nome = $_POST['adm_nome'];
    $adm_email  = $_POST['adm_email'];
    $adm_senha = sha1(md5($_POST['adm_senha']));
    //Inserir informações capturadas em uma tabela de banco de dados
    $postQuery = "INSERT INTO tbladmin (admin_id, admin_name, admin_email, admin_password) VALUES(?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
    //parâmetros de ligação
    $rc = $postStmt->bind_param('ssss', $adm_numero, $adm_nome, $adm_email, $adm_senha);
    $postStmt->execute();
    //declarar uma variável que será passada para a função de alerta
    if ($postStmt) {
      $success = "Registo Salvo" && header("refresh:1; url=hrm_admin.php");
    } else {
      $err = "Erro ao Salvar Registo";
    }
  }
}
require_once('partials/_head.php');
?>
<body>
  <!-- Sidenav -->
  <?php
  require_once('partials/_sidebar.php');
  ?>

 <!-- Main content -->
 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar Administrador</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label"></label>
              <input type="hidden" class="form-control">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
       
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
          
            <div class="card-body">
              <form method="POST">

                <div class="form-row">
                  <div class="col-md-12">
                    <label>Número:</label>
                    <input type="text" name="adm_numero"  readonly class="form-control" value="<?php echo $alpha; ?>-<?php echo $beta; ?>">
                  </div>

                  <div class="col-md-12">
                    <label>Nome:</label>
                    <input type="text" name="adm_nome" class="form-control" value="" placeholder="Nome do administrador" >
                  </div>
                </div>          

                <hr>
                <div class="form-row">
                  <div class="col-md-12">
                    <label>Email:</label>
                    <input type="email" name="adm_email" class="form-control" value="" placeholder="exemplo@mail.com">
                  </div>
                  <div class="col-md-12">
                    <label>Senha:</label>
                    <input type="password" name="adm_senha" class="form-control" value="" placeholder="Senha do administrador ">
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-12">
                    <input type="submit" name="addAdm" value="Salvar" class="btn btn-success" value="">
                    <a href="hrm_admin.php" class="btn btn-primary">Visualizar</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>