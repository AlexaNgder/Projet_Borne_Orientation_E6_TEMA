<?php
session_start();
   if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }

include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['ID'])) {
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE ID = ?');
    $stmt->execute([$_GET['ID']]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$client) {
        exit('Le client n existe pas avec cette ID !');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM Clients WHERE ID = ?');
            $stmt->execute([$_GET['ID']]);
            $msg = 'Vous avez effacé le client!';
            // After deleting a record, reset auto-increment
            $stmt = $pdo->prepare('SET @count = 0');
            $stmt->execute();
            $stmt = $pdo->prepare('UPDATE Clients SET ID = @count:= @count + 1');
            $stmt->execute();
            $stmt = $pdo->prepare('ALTER TABLE Clients AUTO_INCREMENT = 1');
            $stmt->execute();
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Pas d ID specifié !');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Effacer le client #<?=$client['ID']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Etes vous sûr de vouloir effacer #<?=$client['ID']?>?</p>
    <div class="yesno">
        <a href="delete.php?ID=<?=$client['ID']?>&confirm=yes">Yes</a>
        <a href="delete.php?ID=<?=$client['ID']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
