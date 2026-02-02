<?php
$admin_id = $_SESSION['admin_id'];
//$login_id = $_SESSION['login_id'];
$ret = "SELECT * FROM  tbladmin  WHERE admin_id = '$admin_id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($admin = $res->fetch_object()) {

?>
   <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" dashboard.php" >
        <img src="./assets/img/sige.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white"></span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
      
        <li class="nav-item">
          <a class="nav-link text-white"href="hrm_admin.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-tie text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Admin</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="forn.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-truck text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Fornecedor</span>
          </a>
        </li>
         
        <li class="nav-item">
          <a class="nav-link text-white " href="prod.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-project-diagram text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Produtos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="cli.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-users text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Clientes</span>
          </a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link text-white " href="orders.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cart-arrow-down text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Venda</span>
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link text-white " href="finance.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-money-check text-primary"> </i>
            </div>
            <span class="nav-link-text ms-1">Finanças</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="receipts_orders.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-print text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Relatórios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-share-square text-primary"></i>
            </div>
            <span class="nav-link-text ms-1">Sair</span>
          </a>
        </li>
      </ul>
    </div>
   
  </aside>

<?php } ?>

