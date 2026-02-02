<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Visualizar Produtos Para Venda</li>
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
         <div class="card-header border-0">
                              <a href="payments_orders.php" class="btn btn-dark">
                                  <i class="ni ni-credit-card "></i> 
                                Pagamento
                              </a>
                          </div>

           
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><b>Image</b></th>
                    <th scope="col"><b>Código </b></th>
                    <th scope="col"><b>Nome</b></th>
                    <th scope="col"><b>Preço</b></th>
                    <th scope="col"><b>Acção</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  tblproduto ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($prod = $res->fetch_object()) {
                  ?>
                    <tr>
                      <td>
                        <?php
                        if ($prod->img) {
                          echo "<img src='assets/img/products/$prod->img' height='60' width='60 class='img-thumbnail'>";
                        } else {
                          echo "<img src='assets/img/products/wezadefault.jpg' height='60' width='60 class='img-thumbnail'>";
                        }

                        ?>
                      </td>
                      <td><?php echo $prod->numeropr; ?></td>
                      <td><?php echo $prod->nomePro; ?></td>
                      <td><?php echo $prod->preco; ?> KZS</td>
                      <td>
                        <a href="make_oders.php?idPro=<?php echo $prod->idPro;?>&nomepro=<?php echo $prod->nomePro; ?>&qtdd=<?php echo $prod->qtdd; ?>">
                          <button class="btn btn-sm btn-warning">
  
                            Vender
                          </button>
                        </a>
                     
                      <a href="prod_stock.php?idPro=<?php echo $prod->idPro;?>&nomepro=<?php echo $prod->nomePro; ?>&qtdd=<?php echo $prod->qtdd; ?>">
                          <button class="btn btn-sm btn-primary">
                           
                            Estoque
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
    </div>
  </div>
  <?php
  require_once('partials/_scripts.php');
  ?>
</body>
</html>