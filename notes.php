<?php
declare(strict_types=1);

 require_once __DIR__ . '/fonctions.php';

$prenom = 'Raiden';
$date = date("d/m/y");

$notes = [
'Ada' => 17.5,
'Alan' => 14.0,
'Grace' => 9.5,
'Linus' => 12.0,
'Margaret' => 6.5,

];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Bonjour PHP</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<header>
		<h1>Bonjour <?= $prenom?> </h1>
        <p>Nous sommes le <?= $date?> </p>
	</header>

    <table>
        <thead>
            <th>Nom</th>
            <th>Note</th>
        </thead>

        <tbody>
            <?php foreach ($notes as $key => $val) :?>
            <tr>
                <th><?= $key?></th>
                <td <?php if (!estAdmis($val)) : echo "style= 'color: red;'"; endif?> ><?= $val?></td>
            </tr>
            <?php endforeach ?>

        </tbody>

        
    </table>

    Moyenne : <?php echo round(moyenne($notes), 2); ?> <br>
    Minimal : <?php echo min($notes); ?> <br>
	Maximal : <?php echo max($notes); ?> <br>
    Meilleur étudiant : <?php echo meilleurEtudiant($notes); ?> <br>
	<footer>
		
	</footer>

</body>
</html>