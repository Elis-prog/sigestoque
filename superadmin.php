<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();



#EXCLUIR PRODUTO
if (isset($_POST['deletedataprod'])) {
    $id = $_POST['delete_id']; 
    $checkfk="SELECT idPro FROM tblvenda Where idPro='$id' ";
    $checkfk_run = mysqli_query($con,$checkfk);
   if (mysqli_num_rows($checkfk_run)>0) {
    # code...
    $_SESSION['message']= " Campo em Utilização!";
    $_SESSION['icomessage']= "info";
    header('Location:prod.php');
    exit(0);
}else {
    $query ="DELETE FROM tblproduto where idPro='$id' ";
     $query_run = mysqli_query($con,$query);
    if ($query_run) {
        # code...
        $_SESSION['message'] = "Registo Excluido!";
        header('Location:prod.php');
       exit(0);
    } else {
        # code...
        $_SESSION['message'] = "Não foi possivel Excluir!";
        header('Location:prod.php');
        exit(0);
    }
}
    
}

#EXCLUIR FORNECEDOR
if (isset($_POST['deletedatafornecedor'])) {
    $id = $_POST['delete_id']; 
    $checkfk="SELECT idFor FROM tblproduto Where idFor='$id' ";
    $checkfk_run = mysqli_query($con,$checkfk);
   if (mysqli_num_rows($checkfk_run)>0) {
    # code...
    $_SESSION['message']= " Campo em Utilização!";
    $_SESSION['icomessage']= "info";
    header('Location:forn.php');
    exit(0);
}else {
    $query ="DELETE FROM tblfornecedor where idFor='$id' ";
     $query_run = mysqli_query($con,$query);
    if ($query_run) {
        # code...
        $_SESSION['message'] = "Registo Excluido!";
        header('Location:forn.php');
       exit(0);
    } else {
        # code...
        $_SESSION['message'] = "Não foi possivel Excluir!";
        header('Location:forn.php');
        exit(0);
    }
}
    
}



#EXCLUIR CLIENTE
if (isset($_POST['deletedatacli'])) {
    $cli_id = $_POST['delete_id'];

    $checkfk="SELECT idCli FROM tblvenda Where idCli='$cli_id' ";
    $checkfk_run = mysqli_query($con,$checkfk);

    $checkfk2="SELECT idCli FROM tblpet Where idCli='$cli_id' ";
    $checkfk_run2 = mysqli_query($con,$checkfk2);

 

   if (mysqli_num_rows($checkfk_run)>0) {
    # code...
    $_SESSION['message']= " Campo em Utilização!";
    $_SESSION['icomessage']= "info";
    header('Location:cli.php');
    exit(0);
}//tblvenda
if (mysqli_num_rows($checkfk_run2)>0) {
    # code...
    $_SESSION['message']= " Campo em Utilização!";
    $_SESSION['icomessage']= "info";
    header('Location:cli.php');
    exit(0);
}


else {

    $query ="DELETE FROM tblcliente where idCli='$cli_id' ";
     $query_run = mysqli_query($con,$query);

    if ($query_run) {
        # code...
        $_SESSION['message'] = "Registo Excluido!";
        header('Location:cli.php');
       exit(0);
    } else {
        # code...
        $_SESSION['message'] = "Não foi possivel Excluir!";
        header('Location:cli.php');
        exit(0);
    }
}    
}
?>

