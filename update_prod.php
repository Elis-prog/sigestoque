<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['UpdatePro'])) {

  if (empty($_POST["pro_nome"]) || empty($_POST["pro_numero"]) || empty($_POST['pro_qtdd']) || empty($_POST['pro_preco']) || empty($_POST['pro_desc'])) {
    $err = "Valores em branco não aceitos";

  } else {
    $pro_numero = $_POST['pro_numero'];
    $pro_nome = $_POST['pro_nome'];

 
    $pro_desc = $_POST['pro_desc'];
    $pro_preco = $_POST['pro_preco'];
    $pro_qtdd = $_POST['pro_qtdd'];
    $pro_idFor = $_POST['pro_idFor'];

    $update = $_GET['update'];

    $postQuery = "UPDATE tblproduto SET  numeropr =?, nomePro =?, descricao =?,preco=?,qtdd=?,idFor=? WHERE idPro =?";
    $postStmt = $mysqli->prepare($postQuery);
  
    $rc = $postStmt->bind_param('ssssssi', $pro_numero, $pro_nome, $pro_desc,$pro_preco,$pro_qtdd,$pro_idFor, $update);
    $postStmt->execute();

    if ($postStmt) {
      $success = "Registo Actualizado" && header("refresh:1; url=prod.php");
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Actualizar Produto</li>
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

    if (isset($_GET['update'])) {
      $idPro = $_GET['update'];
      $sql = "SELECT * FROM tblproduto WHERE idPro='$idPro' ";
      $sql_run = mysqli_query($con,$sql);
      if (mysqli_num_rows($sql_run)>0) {
        foreach ($sql_run as $pro) {                
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
                      <label>Nome:</label>
                      <input type="text" name="pro_nome" class="form-control"  value=" <?=$pro['nomePro'];?>">
                    </div>
                    <div class="col-md-12">
                      <label>Número:</label>
                      <input type="text" name="pro_numero" class="form-control"  value=" <?=$pro['numeropr'];?>">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="col-md-12">
                      <label>Quantidade:</label>
                      <input id="qtdd" type="text" name="pro_qtdd" class="form-control"  value=" <?=$pro['qtdd'];?>">
                    </div>
                    <div class="col-md-12">
                        <label for="">Fornecedor:</label>
                       <?php 
                            $sql ="SELECT * FROM tblfornecedor";                          
                            $sql_run = mysqli_query($con,$sql);
                            if (mysqli_num_rows($sql_run)>0) {
                                ?>                  
                        <select name="pro_idFor" class="form-control" >                                    
                           <option value="">Seleccione Fornecedor:</option>
                           <?php
                           foreach ($sql_run as $row) {                                          
                           ?>
                            <option value="<?=$row['idFor']?>"<?=$row['idFor'] == $pro['idFor'] ?'selected' :'' ?> >                             
                            <?php echo $row['nome']; ?>
                        </option>
                        <?php
                        }
                        ?>
                        </select>
                        <?php      
                            }else{
                              ?>
                                <h4>Dados não encontrado</h4>
                                <?php
                            }
                        ?> 
                  </div>                  
                  </div>

                  <div class="form-row">
                    <div class="col-md-12">
                      <label>Preço(KZS):</label>
                      <input id="prec" type="text" name="pro_preco" class="form-control" value=" <?=$pro['preco'];?>">
                    </div>

                    
                    <div class="col-md-12">
                      <label>Descrição:</label>
                      <input type="text" name="pro_desc" class="form-control" value=" <?=$pro['descricao'];?>">
                    </div>
                  </div>

                 
                  <br>
                  <div class="form-row">
                    <div class="col-md-6">
                      <input type="submit" name="UpdatePro" value="Actualizar" class="btn btn-success" value="">
                    </div>
                  </div>
                </form>
                <?php
                       }
                    }else {
                      # code...
                      ?>
                      <h4> Registo não encontrado</h4>
                      <?php
                    }
                  }   
                  ?>
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
    $('#qtdd').mask('000');
    $('#prec').mask('000000');
  });  
</script>
</body>

</html>