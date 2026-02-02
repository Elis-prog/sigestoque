<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['addProd'])) {
 
  if (empty($_POST["prod_nome"]) || empty($_POST["prod_numero"]) || empty($_POST['prod_desc']) || empty($_POST['prod_preco']) || empty($_POST['prod_qtdd']) || empty($_POST['prod_idFor'])) {
    $err = "Valores em branco não aceitos";
  } else {
    $prod_nome = $_POST['prod_nome'];
    $prod_numero  = $_POST['prod_numero'];
    $prod_desc = $_POST['prod_desc'];
    $prod_img = $_FILES['prod_img']['name'];
    move_uploaded_file($_FILES["prod_img"]["tmp_name"], "assets/img/products/" . $_FILES["prod_img"]["name"]);
    $prod_preco = $_POST['prod_preco'];
    $prod_idFor = $_POST['prod_idFor'];
    $prod_qtdd = $_POST['prod_qtdd'];

    $postQuery = "INSERT INTO tblproduto (numeropr,nomePro,img,descricao,preco,qtdd,idFor ) VALUES(?,?,?,?,?,?,?)";
    $postStmt = $mysqli->prepare($postQuery);
 
    $rc = $postStmt->bind_param('sssssss', $prod_numero, $prod_nome,$prod_img,$prod_desc,$prod_preco,$prod_qtdd, $prod_idFor);
    $postStmt->execute();
 
    if ($postStmt) {
      $success = "Product Added" && header("refresh:1; url=prod.php");
    } else {
      $err = "Tente mais tarde";
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Adicionar Produto</li>
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
                  <div class="col-md-12">
                    <label>Nome</label>
                    <input type="text" name="prod_nome" class="form-control" placeholder="Nome do produto">
                  </div>
                  <div class="col-md-12">
                    <label>Número</label>
                    <input type="text" name="prod_numero" readonly value="<?php echo $alpha; ?>-<?php echo $beta; ?>" class="form-control" value="">
                  </div>
                </div>
                <div class="form-row">
                <div class="col-md-12">
                    <label>Quantidade</label>
                    <input id="qtdd" type="number" name="prod_qtdd" class="form-control" value="" placeholder="Quantidade do produto">
                  </div>

                  <?php 
                       #FORNECEDOR FK
                            $sql ="SELECT * FROM tblfornecedor";
                            $sql_run = mysqli_query($con,$sql);
                            if (mysqli_num_rows($sql_run)>0) {
                                ?>
                                <div class="col-md-12">
                                 <label for="">Fornecedor</label>
                        <select name="prod_idFor" class="form-control" >                                    
                           <option value="">Seleccione Fornecedor</option>
                           <?php
                           foreach ($sql_run as $row) {
                            # code...                          
                           ?>
                            <option value=" <?php echo $row['idFor'];?>"><?php echo $row['nome']; ?></option>
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
                    <label>Preço(KZS)</label>
                    <input id="prec" type="text" name="prod_preco" class="form-control" value="" placeholder="Preço do produto">
                  </div>
                  <div class="col-md-12">
                    <label>Imagem</label>
                    <input type="file" name="prod_img" class="btn btn-outline-success form-control" value="">
                  </div>
                  
                </div>
                <div class="form-row">
                  <div class="col-md-12">
                    <label>Descrição</label>
                    <textarea rows="3" name="prod_desc" class="form-control" value="" placeholder="Descrição do produto"></textarea>
                  </div>
                </div>
                <br>
                <div class="form-row">
                  <div class="col-md-6">
                    <input type="submit" name="addProd" value="Salvar" class="btn btn-success" value="">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->

    </div>
  </div>
  <!-- Argon Scripts -->

   <script>
    $(document).ready(function(){
    $('#qtdd').mask('000');
    $('#prec').mask('000000');
  });  
</script>
</body>

</html>