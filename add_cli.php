<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');
check_login();
if (isset($_POST['addcli'])) {

  if (empty($_POST["cli_nome"]) || empty($_POST["cli_bairro"]) ||empty($_POST['cli_numTel'])) {
    $err = "Valores em branco não aceitos";
  } else {
    $cli_nome = $_POST['cli_nome'];
    $cli_bairro = $_POST['cli_bairro'];
    $cli_numTel = $_POST['cli_numTel'];
    $customer_id = $_POST['numero_id'];   

    $postQuery = "INSERT INTO tblcliente (numerocli, nome, bairro,numTel)VALUES(?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);   
    $rc = $postStmt->bind_param('ssss', $customer_id,$cli_nome, $cli_bairro,$cli_numTel);
    $postStmt->execute();    
    if ($postStmt) {
      $success = "Cliente Adicionado" && header("refresh:1; url=cli.php");
    } else {
      $err = "Por favor tente mais tarde";
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

 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar Cliente</li>
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
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
           
            <div class="card-body">
              <form method="POST">

                <div class="form-row">
                  <div class="col-md-12">
                    <input type="hidden" name="numero_id" value="<?php echo $cus_id; ?>" class="form-control">
                    <label>Nome:</label>
                    <input type="text" name="cli_nome" class="form-control" placeholder="Nome do cliente"> 
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-12">
                    <label>Bairro:</label>
                    <input type="text" name="cli_bairro" class="form-control" value="" placeholder="Bairro do cliente">
                  </div>
                  <div class="col-md-12">
                    <label>Telefone:</label>
                    <input id="tel" type="text" name="cli_numTel" class="form-control" placeholder="xxx-xxx-xxx"> 
                  </div>
                </div>
                <hr>
               
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addcli" value="Salvar" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php');
  ?>
  <script>
    $(document).ready(function(){
    $('#tel').mask('000-000-000');
  });  
</script>
</body>
</html>