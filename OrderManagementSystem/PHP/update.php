<?php

require "autoload.php";

if (isset($_GET['id'])) {
    if (!empty($_POST)) {

        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $order_date = date('Y-m-d', strtotime($_POST['order_date']));
        $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
        $driver_no = isset($_POST['driver_no']) ? $_POST['driver_no'] : '';

        $stmt = $connection->prepare('UPDATE ord SET id = ?, order_date = ?, customer_name = ?, driver_no = ? WHERE id = ?');
        $stmt->execute([$id, $order_date, $customer_name, $driver_no, $_GET['id']]);
    }
    $stmt = $connection->prepare('SELECT * FROM ord WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        exit('Toks užsakymas tokiu id neegzistuoja');
    }
}
else {
    exit('Klaida');
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <title>Užsakymo duomenų atnaujinimas</title>
</head>
<body>
<div class ="container">
<h2>Atnaujinti duomenis #<?=$order['id']?></h2>
<form action="update.php?id=<?=$order['id']?>" method="post">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="form-group mb-3">
                             <label for="id">ID</label>
                             <input type="text" name="id" placeholder="1" value="<?=$order['id']?>" id="order" class="form-control"> <br>
                        </div>
                        <div class="form-group mb-3">
                             <label for="order_date">Data</label>
                             <input type="text" name="order_date" id="order_date" class="form-control"> <br>
                        </div>
                        <div class="form-group mb-3">
                            <label for="customer_name">Klientas</label>
                             <input type="text" name="customer_name" value="<?=$order['customer_name']?>" id="customer_name" class="form-control"><br>
                        </div>
                        <div class="form-group mb-3">
                             <label for="driver_no">Vilkiko nr.</label>
                             <input type="text" name="driver_no"  value="<?=$order['driver_no']?>" id="driver_no" class="form-control"> <br>
                        </div>
                             <input type="submit" value="Atnaujinti"><br><br>

</form>
    <div>
        <a href="index.php">Grįžti atgal</a>
    </div>
</body>
</html>

<script>
    $(document).ready(function (){
        $(function(){
            $('#order_date').datepicker();
        });
    });
</script>