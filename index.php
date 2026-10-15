<?php
declare(strict_types=1);

$prenom = 'Raiden';
$date = date("d/m/y");
$langues = ['Scheme', 'C#', 'React'];
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

    <ul>
    <?php foreach ($langues as $langue)  :?>
        <li> <?= $langue ?> </li>
    <?php endforeach ?>
	</ul>
	
	<footer>
		
	</footer>

</body>
</html>