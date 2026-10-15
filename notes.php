<?php
declare(strict_types=1);

require_once __DIR__ . '/fonctions.php';
require_once __DIR__ . '/modele.php';

$prenom = 'Raiden';
$date = date("d/m/y");

$notes = [
    new Etudiant(nom: 'Ada', note: 17.5),
    new Etudiant(nom: 'Alan', note: 14.0),
    new Etudiant(nom: 'Grace', note: 9.5),
    new Etudiant(nom: 'Linus', note: 12.0),
    new Etudiant(nom: 'Margaret', note: 6.5),
];

$notesNumeriques = [];
foreach ($notes as $etudiant) {
    $notesNumeriques[$etudiant->nom] = $etudiant->note;
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
		<h1>Bonjour <?= $prenom?> </h1>
        <p>Nous sommes le <?= $date?> </p>
	</header>

    <table>
        <thead>
            <th>Nom</th>
            <th>Note</th>
            <th>Mention</th>
        </thead>

        <tbody>
            <?php foreach ($notes as $etudiant) :?>
            <tr>
                <th><?= $etudiant->nom?></th>
                <td <?php if (!estAdmis($etudiant->note)) : echo "style= 'color: red;'"; endif?> ><?= $etudiant->note?></td>
                <td><?= $etudiant->mention()->value?></td>
            </tr>
            <?php endforeach ?>

        </tbody>

        
    </table>

    Moyenne : <?php echo round(moyenne($notesNumeriques), 2); ?> <br>
    Minimal : <?php echo min($notesNumeriques); ?> <br>
	Maximal : <?php echo max($notesNumeriques); ?> <br>
    Meilleur étudiant : <?php echo meilleurEtudiant($notesNumeriques); ?> <br>


    <h2>Test de la propriété readonly</h2>
    <?php
    $etudiant = $notes[0];

    try {
        $etudiant->note = 20;
    } catch (Error $e) {
        echo $e->getMessage();
    }
    ?>
	<footer>
		
	</footer>

</body>
</html>