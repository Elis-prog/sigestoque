<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
require_once('partials/_analytics.php');
check_login();
if (isset($_POST['delete'])) {
    $id = intval($_POST['delete']);
    $postQuery = "DELETE FROM  tblpagamento  WHERE  idPag = ?";
    $postStmt = $mysqli->prepare($postQuery);
    $rc = $postStmt->bind_param('s', $id);
    $postStmt->execute();
    if ($postStmt) {
     $success = "Deleted" && header("refresh:3; url=finance.php");
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Visualizar Finanças</li>
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
            
                <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Receita Total</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $paga; ?> <small class="text-muted" style="font-size: 0.8rem">KZS</small></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow text-center" style="width: 48px; height: 48px; line-height: 48px;">
                        <i class="fas fa-money-bill-wave"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>
                </div>
            </div>
        </div>

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
                                  
                                        <th scope="col">Código</th>
                                        <th scope="col">Item Pago</th>
                                        <th scope="col">Código Item</th>
                                        <th scope="col">Montante</th>
                                        <th scope="col">Método</th>
                                        
                                        <th scope="col">Data</th>
                                        <th scope="col">Acção</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                       $ret = "SELECT * from tblpagamento ORDER BY created_at DESC ";
                               
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_object()) {
                                        
                                    ?>
                                        <tr>
                                        
                                            <th scope="row"><?php echo $row->numeroPag; ?></th>
                                       
                                            <td><?php echo $row->numero1; ?></td>
                                            <td><?php echo $row->numero2; ?></td>
                                            <td><?php echo $row->montant; ?></td>
                                            <td><?php echo $row->metodo; ?></td>
                                      
                                           
                                            <td><?php echo date('d/M/Y g:i', strtotime($row->created_at)); ?></td>
                                            <td>

                                            <form method="POST" action="finance.php" onsubmit="return confirm('Tens a certeza de que pretende eliminar este registo?');" style="display:inline;">
                                                <input type="hidden" name="delete" value="<?php echo $row->idPag;?>">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Excluir
                                                </button>
                                            </form>

                                           
                                                
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

    <?php
    require_once('partials/_scripts.php');
    ?>
</body>

</html>