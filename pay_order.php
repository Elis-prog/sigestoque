<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();

if (isset($_POST['pay'])) {

    $pag_numeroPag = $_POST['pag_numeroPag'];
    $pag_montant  = $_POST['pag_montant'];
    $pag_metodo = $_POST['pag_metodo'];
    
    $ven_Id = $_GET['idVen'];
    $nome_prod = $_GET['nomepro'];
    $numero2 = $_GET['numerov'];


    $prod_id = $_GET['idPro'];

    $ven_estado = $_GET['estado'];

    $baixa = $_GET['qtdd'] -  $_GET['qtddv'];

    $postQuery = "INSERT INTO tblpagamento (numeroPag, numero1,numero2, montant, metodo) VALUES(?,?,?,?,?)";

    $upQry = "UPDATE tblvenda SET estado =? WHERE idVen =?";

    $upQry2 = "UPDATE tblproduto SET qtdd =? WHERE idPro =?";

    $postStmt = $mysqli->prepare($postQuery);
    $upStmt = $mysqli->prepare($upQry);
    $upStmt2 = $mysqli->prepare($upQry2);
    //bind paramaters

    $rc = $postStmt->bind_param('sssss', $pag_numeroPag, $nome_prod,$numero2, $pag_montant, $pag_metodo);
    $rc = $upStmt->bind_param('ss', $ven_estado, $ven_Id);
    $rc = $upStmt2->bind_param('ss', $baixa, $prod_id);


    $postStmt->execute();
    $upStmt->execute();
    $upStmt2->execute();
 
    if ($upStmt && $postStmt && $upStmt2 ) {
      $success = "Paid" && header("refresh:1; url=receipts_orders.php");
    } else {
      $err = "Porfavor Tente mais Tarde";
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Método de Pagamento</li>
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

    $order_code = $_GET['idVen'];
    $ret = "SELECT * FROM  tblvenda WHERE idVen ='$order_code' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($order = $res->fetch_object()) {
        $total = ($order->preco * $order->qtddv);

    ?>

    <!-- Page content -->
    <div class="container-fluid mt--8">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
           
            <div class="card-body">
              <form method="POST"  enctype="multipart/form-data">

                <div class="form-row">

                   <div class="col-md-12">
                    <label>Código Pagamento:</label>
                    <input type="text" name="pag_numeroPag" value="<?php echo $PagCode; ?>" readonly class="form-control" value="">
                  </div>

                  <div class="col-md-12">
                    <label>Montante (Kzs):</label>
                    <input type="text" name="pag_montant" readonly value="<?php echo $total;?>" class="form-control">
                  </div>
                </div>

                <hr>
                <div class="form-row">
                  <div class="col-md-12">
                         <label for="">Método de Pagamento:</label>
                         <select name="pag_metodo" class="form-control" required >
                           <option value="">Seleccione Método</option>
                           <option>Dinheiro</option>
                          <option>Multicaixa</option>            
                         </select>
                       </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="pay" value="Salvar" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
   
    </div>
  </div>
  <!-- Argon Scripts -->
  <?php
  require_once('partials/_scripts.php'); }
  ?>
</body>

</html>