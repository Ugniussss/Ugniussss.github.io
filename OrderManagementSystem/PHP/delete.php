<?php

require "autoload.php";
$msg = "";

if (isset($_GET['id'])) {
    $stmt = $connection->prepare('SELECT * FROM ord WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        exit('Toks užsakymas nebeegzistuoja');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $connection->prepare('DELETE FROM ord WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Jūs ištrynėte pasirinkta užsakymą';
            header("location: index.php");
        } else {
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('Nėra pasirinkto ID!');
}
?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Ištrynimas</title>
</head>
<body>
<div>
    <h2>Ištrinti užsakymą?</h2>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php else: ?>
        <p>Jūs tikrai norite ištrinti?</p>
        <div>
            <a href="delete.php?id=<?=$order['id']?>&confirm=yes">Taip</a>
            <a href="delete.php?id=<?=$order['id']?>&confirm=no">Ne</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>