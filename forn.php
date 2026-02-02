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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Visualizar Fornecedores</li>
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
              <a href="add_forn.php" class="btn btn-dark"><i class="fas fa-plus"></i> Fornecedor</a>
            </div>

<!-- Modal removed as per user request -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
              <?php include('message2.php') ?>
                <thead class="thead-light">
                  <tr>
                  <th scope="col">ID.</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acção</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ret = "SELECT * FROM  tblfornecedor ";
                  $stmt = $mysqli->prepare($ret);
                  $stmt->execute();
                  $res = $stmt->get_result();
                  while ($row = $res->fetch_object()) {
                  ?>
                    <tr>
                    <td><?php echo $row->idFor; ?></td>
                      <td><?php echo $row->nome; ?></td>
                      <td><?php echo $row->endereco; ?></td>
                      <td><?php echo $row->telefone; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td>
                      <form action="superadmin.php" method="POST" onsubmit="return confirm('Tens a certeza de que pretende eliminar este registo?');" style="display:inline;">
                          <input type="hidden" name="delete_id" value="<?php echo $row->idFor; ?>">
                          <button type="submit" name="deletedatafornecedor" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Excluir
                          </button>
                      </form>

                        <a href="update_forn.php?update=<?php echo $row->idFor; ?>">
                          <button class="btn btn-sm btn-primary">                         
                            Actualizar
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