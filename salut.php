<?php
declare(strict_types=1);


if (!empty($_POST['prenom'])) {
    echo "Bonjour " . htmlspecialchars($_POST['prenom'], ENT_QUOTES |ENT_SUBSTITUTE, 'UTF-8') ?? "Null";
    }
    

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

	</header>

    
    <form action="/salut.php" method="post">
    <input type="text" name="prenom" />
    <button type="submit">Envoyer</button>

    </form>

	
	<footer>
		
	</footer>

</body>
</html>