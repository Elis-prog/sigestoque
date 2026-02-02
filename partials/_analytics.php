<?php
//1. 
$query = "SELECT COUNT(*) FROM `tblcliente` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($cliente);
$stmt->fetch();
$stmt->close();

//2. 
$query = "SELECT COUNT(*) FROM `tblvenda` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($vendas);
$stmt->fetch();
$stmt->close();

//3. 
$query = "SELECT COUNT(*) FROM `tblproduto` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($produtos);
$stmt->fetch();
$stmt->close();


//4.
$query = "SELECT COUNT(*) FROM `tblfornecedor` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($fornecedor);
$stmt->fetch();
$stmt->close();

$query = "SELECT SUM(montant) FROM `tblpagamento` ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paga);
$stmt->fetch();
$stmt->close();