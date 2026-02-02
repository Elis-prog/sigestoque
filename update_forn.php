<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['UpdateForn'])) {

  if (empty($_POST["forn_nome"]) || empty($_POST["forn_end"]) || empty($_POST['forn_telefone']) ||empty($_POST['forn_email'])) {
    $err = "Valores em branco não aceitos";
  } else {

    $forn_nome = $_POST['forn_nome'];
    $forn_end = $_POST['forn_end'];
    $forn_telefone  = $_POST['forn_telefone'];
    $forn_email = $_POST['forn_email'];

    $update = $_GET['update'];

    $postQuery = "UPDATE tblfornecedor SET  nome =?, endereco =?, telefone =?, email =? WHERE idFor =?";
    $postStmt = $mysqli->prepare($postQuery);
 
    $rc = $postStmt->bind_param('ssssi', $forn_nome, $forn_end,$forn_telefone,$forn_email,$update);
    $postStmt->execute();
   
    if ($postStmt) {
      $success = "Registo Actualizado" && header("refresh:1; url=forn.php");
    } else {
      $err = "Por favor, tente novamente mais tarde";
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Actualizar Fornecedor</li>
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
  
    <?php

    $update = $_GET['update'];
    $ret = "SELECT * FROM  tblfornecedor WHERE idFor = '$update' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_object()) {
    ?>
     
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
                      <label>Nome</label>
                      <input type="text" name="forn_nome" class="form-control" value="<?php echo $row->nome; ?>">
                    </div>
                    <div class="col-md-12">
                      <label>Endereço</label>
                      <input type="text" name="forn_end" class="form-control" value="<?php echo $row->endereco; ?>">
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-12">
                      <label>Telefone</label>
                      <input type="text" name="forn_telefone" class="form-control" value="<?php echo $row->telefone; ?>">
                    </div>
                    <div class="col-md-12">
                      <label>Email</label>
                      <input type="email" name="forn_email" class="form-control" value="<?php echo $row->email; ?>">
                    </div>
                  </div>

                  
                  <br>
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="submit" name="UpdateForn" value="Actualizar " class="btn btn-success" value="">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
      <?php
    }
      ?>
      </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>

</html>