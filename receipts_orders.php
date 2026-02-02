<?php
session_start();
include('config/config.php');
include('config/checklogin.php');

check_login();
//Eliminar Produto
if (isset($_POST['delete'])) {

    $id = intval($_POST['delete']);
   
    $idPro = $_POST['idpro']; 

    $subida = $_POST['qtdd'] +  $_POST['qtddv'];

    $postQuery = "DELETE FROM  tblvenda  WHERE  idVen = ?";

    $upQry2 = "UPDATE tblproduto SET qtdd =? WHERE idPro =?";

    $postStmt = $mysqli->prepare($postQuery);

    $upStmt2 = $mysqli->prepare($upQry2);

    $rc = $postStmt->bind_param('s', $id);

    $rc = $upStmt2->bind_param('ss', $subida,$idPro);

    
    $postStmt->execute();

    $upStmt2->execute();


    if ($postStmt && $upStmt2 ) {
      $success = "Deleted" && header("refresh:3; url=receipts_orders.php");
    } else {
      $err = "Tente mais tarde";
    }
  }
require_once('partials/_head.php');
?>

<body>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Recibos de Venda</li>
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
                       
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-success" scope="col">Código</th>
                                        <th scope="col">Produto</th>
                                      
                                        <th class="text-success" scope="col">Preço</th>
                                     
                             
                                        <th scope="col">Total </th>
                                        <th class="text-success" scope="col">Data</th>
                                        <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$ret = "SELECT * FROM  tblvenda WHERE estado = 'Pago' ORDER BY `tblvenda`.`created_at` DESC  ";
                                    $ret = "SELECT * from tblvenda v inner join tblcliente c on c.idCli=v.idCli inner join tblproduto p on p.idPro=v.idPro WHERE estado ='Pago' ORDER BY v.created_at DESC ";
                                
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($order = $res->fetch_object()) {
                                        $total = ($order->preco * $order->qtddv);

                                    ?>
                                        <tr>
                                            <th class="text-success" scope="row"><?php echo $order->numerov; ?></th>
                          
                                           
                                            <td><?php echo $order->nomeprod; ?></td>
                                            <td class="text-success"><?php echo $order->preco; ?>KZS</td>

                                            <td><?php echo $total; ?> KZS</td>
                                            <td  class="text-success"><?php echo date('d/M/Y g:i', strtotime($order->created_at)); ?></td>
                                            <td>

                                            <form method="POST" action="receipts_orders.php" onsubmit="return confirm('Tens a certeza de que pretende eliminar este registo?');" style="display:inline;">
                                                <input type="hidden" name="delete" value="<?php echo $order->idVen;?>">
                                                <input type="hidden" name="qtddv" value="<?php echo $order->qtddv;?>">
                                                <input type="hidden" name="qtdd" value="<?php echo $order->qtdd;?>">
                                                <input type="hidden" name="idpro" value="<?php echo $order->idPro;?>">
                                                <button type="submit" class="btn btn-sm btn-danger">                                           
                                                    Excluir
                                                </button>
                                            </form>
                                                <a target="_blank" href="print_receipt_orders.php?order_code=<?php echo $order->idVen; ?>">
                                                    <button class="btn btn-sm btn-primary">                                                        
                                                       Imprimir
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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