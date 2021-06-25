<?php

require "autoload.php";

$cust_err = "";
$date_err = "";
$driver_err = "";

$customer_name = $driver_no = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $order_date = date('Y-m-d', strtotime($_POST['order_date']));

    $input_name = trim($_POST["customer_name"]);
        if(empty($input_name)){
            $cust_err = "Įveskite vardą.";
        }
        else
        {
            $customer_name = $input_name;
        }
    $input_driver = trim($_POST["driver_no"]);
        if(empty($input_driver))
        {
            $driver_err = "Įveskite vilkiko numerį.";
        }
        else
        {
            $driver_no = $input_driver;
        }
    if(empty($cust_err) && empty($driver_err)){

        $query = "INSERT INTO ord (order_date, customer_name, driver_no) VALUES (:order_date, :customer_name, :driver_no)";
        if($stmt = $connection->prepare($query)){

            $stmt->bindParam(":order_date", $param_date);
            $stmt->bindParam(":customer_name", $param_name);
            $stmt->bindParam(":driver_no", $param_driver);

            $param_date = $order_date;
            $param_name = $customer_name;
            $param_driver = $driver_no;

            if($stmt->execute()){
                header("location: index.php");
                exit();
            }
        }
    }
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
    <title>Užsakymo pridėjimas</title>

</head>
<body>
<form action="create.php" method="post">
    <div class ="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for=""><b>Data</b></label>
                            <input type="text" name="order_date" id="order_date" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label><b>Klientas</b></label> <br>
                            <input type="text" name="customer_name" placeholder="Įveskite kliento vardą" class="form-control" value="<?php echo $customer_name;?>">
                            <span><?php echo $cust_err;?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label><b>Vilkiko Nr.</b></label> <br>
                            <input type="text" name="driver_no" placeholder="Įveskite vilkiko numerį" class="form-control" value="<?php echo $driver_no;?>">
                            <span><?php echo $driver_err;?></span>
                        </div>
                            <input type="submit" value="Sukurti">
                             <a href="index.php">Grįžti atgal</a>
</form>

</body>
</html>

<script>
    $(document).ready(function (){
        $(function(){
            $('#order_date').datepicker();
        });
    });
</script>