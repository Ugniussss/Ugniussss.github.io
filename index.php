<?php

require "autoload.php";

$stmt = $connection->prepare("SELECT * FROM ord");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$length = 6;
$first = "U";

?>

<!DOCTYPE HTML>
<html lang="lt">
    <head>
        <meta charset="UTF-8">
        <link href="../bootstrap/bootstrap4.min.css" rel="stylesheet">
        <link href="../bootstrap/bootstrap.model.css" rel="stylesheet">
        <title> OMS </title>
    </head>
    <body>
    <div class="container-fluid">
    <div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead style="color: #2e59d9; font-weight: bold">
            <tr>
                <td>Užsakymo Nr.</td>
                <td>Data</td>
                <td>Klientas</td>
                <td>Paskutinis užsakymas</td>
                <td>Vilkiko nr.</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <?php $id = str_pad($order['id'], $length , "0", STR_PAD_LEFT)?>
                <?php $id_second = str_pad($order['id'] - 1, $length , "0", STR_PAD_LEFT)?>
                <tr>
                    <td><?=str_pad( "U" . $id, $length , "0", STR_PAD_LEFT)?></td>
                    <td><?=$order['order_date']?></td>
                    <td><?=$order['customer_name']?></td>
                    <td><?=str_pad( "U" . $id_second, $length , "0", STR_PAD_LEFT)?></td>
                    <td><?=$order['driver_no']?></td>
                    <td>
                        <a href="update.php?id=<?=$order['id']?>"><img src="../images/pencil.png" alt="pencil" style="width: 20px"></a>
                        <a href="delete.php?id=<?=$order['id']?>"><img src="../images/trashcan.png" alt="trashcan" style="width: 20px"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <a href="create.php"><img src="../images/plus-math.png" alt="plus" style="width: 20px"> </a>
        </div>
    </div>
    </div>

    </body>
</html>
