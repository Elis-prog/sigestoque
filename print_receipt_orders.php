<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="MartDevelopers Inc">
    <title>SIGE | Sistema de Gestão de Estoque</title>
    <!-- Favicon -->

    <link rel="icon" type="image/png" sizes="32x32" href="assets/sige.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/sige.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/css/custom-modern.css" rel="stylesheet">
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery.js"></script>
    <style>
        body {
            margin-top: 20px;
            background-color: #eee;
        }
    </style>
</head>
</style>
<?php
$order_code = $_GET['order_code'];
$ret2 = "SELECT * FROM  tblvenda WHERE idVen = '$order_code'";
$ret ="SELECT * from tblvenda v inner join tblcliente c on c.idCli=v.idCli WHERE idVen = '$order_code' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
while ($order = $res->fetch_object()) {
    $total = ($order->preco * $order->qtddv);

?>

    <body>
        <div class="container">
            <div class="row">
                <div id="Receipt" class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                        <address>
                                <strong>SIGE - Sistema de Gestão de Estoque</strong>
                                <br>
                                Uige
                                <br>
                                (+244) 956-337-306
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                        <h2>
                                <em class="text-primary">Nº do Recibo: <?php echo $order->numerov; ?></em>
</h2>
                        </div>
                        </span>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Cliente</th>
                                    <th>Item</th>
                                    <th>Quantidade</th>
                                    <th class="text-center">Preço(KZS)</th>
                                    <th class="text-center">Total(KZS)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="col-md-5"><em> <?php echo $order->nome; ?> </em></h4></td>
                                    <td class="col-md-9"><em> <?php echo $order->nomeprod; ?> </em></h4></td>
                                    <td class="col-md-1" style="text-align: center"> <?php echo $order->qtddv; ?></td>
                                    <td class="col-md-1 text-center"><?php echo $order->preco; ?></td>
                                    <td class="col-md-2 text-center">
                                    <h4><strong><?php echo $total; ?> </strong></h4></td>
                                </tr>
                               
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <button id="print" onclick="printContent('Receipt');" class="btn btn-primary btn-lg text-justify btn-block">
                        Imprimir <span class="fas fa-print"></span>
                    </button>
                </div>
            </div>
        </div>
    </body>

</html>
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>
<?php } ?>