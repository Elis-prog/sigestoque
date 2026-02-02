<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['makeOrder'])) {

  if (empty($_POST["ven_qtdd"]) || empty($_POST["ven_idCli"]) || empty($_POST["ven_idPro"])) {
    $err = "Valores em branco não aceitos";
  } else {
    $ven_nomeProd = $_POST['ven_nomeProd'];
    $ven_numero  = $_POST['ven_numero'];
    $ven_preco = $_POST['ven_preco'];
    $ven_qtdd = $_POST['ven_qtdd'];
    $ven_idCli = $_POST['ven_idCli'];
    $ven_idPro = $_POST['ven_idPro'];
//Product
    $prod_id  = $_GET['idPro'];
    $prod_qtdd = $_GET['qtdd'];
    $prod_nome = $_GET['nomepro'];

    $postQuery = "INSERT INTO tblvenda (nomeprod, numerov, preco, qtddv, idCli, idPro) VALUES(?,?,?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
    //bind paramaters
    $rc = $postStmt->bind_param('ssssss', $ven_nomeProd, $ven_numero, $ven_preco, $ven_qtdd, $ven_idCli, $ven_idPro);
    $postStmt->execute();
   
    if ($postStmt) {
      $success = "Compra submetida" && header("refresh:1; url=payments_orders.php");
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
 <!-- Main content -->
 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Realizar Venda</li>
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
              <form method="POST" enctype="multipart/form-data">

                <div class="form-row">
                
                  <?php
                $prod_id = $_GET['idPro'];
                $ret = "SELECT * FROM  tblproduto WHERE idPro = '$prod_id'";
                $stmt = $mysqli->prepare($ret);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($prod = $res->fetch_object()) {
                ?>
                <div class="col-md-12">
                    <label>Nome do Produto:</label>
                    <input type="text" name="ven_nomeProd" readonly value=" <?php echo $prod->nomePro; ?>" class="form-control" value="">
                  </div>

                  <?php 
                       #Produto+ Id
                            $sql ="SELECT * from tblproduto  WHERE idPro = '$prod_id'";
                            $sql_run = mysqli_query($con,$sql);
                            if (mysqli_num_rows($sql_run)>0) {
                                ?>
                                <div class="col-md-12">
                                 <label for="">Seleccione Nome Produto:</label>
                        <select name="ven_idPro" class="form-control" required >                                    
                           <option value="">Seleccione Produto</option>
                           <?php
                           foreach ($sql_run as $row) {
                            # code...                          
                           ?>
                            <option value="<?php echo $row['idPro'];?>"><?php echo $row['nomePro' ]; ?></option>
                        <?php
                        }
                        ?>
                        </select>
                        </div>
                        <?php 
                            }else{
                                echo"Dados não encontrado";
                            }
                        ?>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                      <label>Preço do Produto(KZS):</label>
                      <input type="text" readonly name="ven_preco" value=" <?php echo $prod->preco; ?>" class="form-control">
                    </div>
                    <?php } ?>

              
                    <div class="col-md-12">
                    <label>Código do Produto:</label>
                    <input type="text" name="ven_numero" readonly value="<?php echo $alpha; ?>-<?php echo $beta; ?>" class="form-control" value="">
                  </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-12">
                      <label>Quantidade do Produto:</label>
                      <input id="qtdd" type="number" name="ven_qtdd" class="form-control" value="">
                    </div>
              

                    <?php 
                       #CLIENTE
                            $sql ="SELECT * from tblcliente ";
                            $sql_run = mysqli_query($con,$sql);
                            if (mysqli_num_rows($sql_run)>0) {
                                ?>
                               
                                <div class="col-md-12">
                                 <label for="">Seleccionar Cliente:</label>
                        <select name="ven_idCli" class="form-control" required >                                    
                           <option value="">Seleccionar Cliente</option>
                           <?php
                           foreach ($sql_run as $row) {
                            # code...                          
                           ?>
                            <option value="<?php echo $row['idCli'];?>"><?php echo $row['nome' ];?> </option>
                        <?php
                        }
                        ?>
                        </select>
                        </div>
                        <?php 
                            }else{
                                echo"Dados não encontrado";
                            }
                        ?>
                 
                </div>
              
               
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="makeOrder" value="Salvar" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

  
    </div>
  </div>

  <?php
  require_once('partials/_scripts.php');
  ?>
    <script>
    $(document).ready(function(){
    $('#qtdd').mask('000');

  });  
</script>
</body>

</html>