<?php
declare(strict_types=1);
session_start();

function enteredval($type){
    if ($type == "langages") {
        return is_array($_POST[$type] ?? null) ? $_POST[$type] : [];
    }

    $valeur = $_POST[$type] ?? "";
    if (is_string($valeur)) {
        return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8');
    }
    return "";
}

function erreurName(){
    return isset($_POST["name"])
        && is_string($_POST["name"])
        && strlen($_POST["name"]) >= 2
        && strlen($_POST["name"]) <= 50;
}

function erreurEmail(){
    return isset($_POST["email"])
        && is_string($_POST["email"])
        && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) !== false;
}

function erreurAge(){
    $age = filter_var($_POST["age"] ?? null, FILTER_VALIDATE_INT);

    return $age !== false && $age >= 16 && $age <= 99;
}

function erreurLangages(){
    $langages = $_POST["langages"] ?? [];
    $langagesPossibles = ["PHP", "JavaScript", "HTML", "CSS"];

    if (!is_array($langages) || count($langages) < 1) {
        return false;
    }

    foreach ($langages as $langage) {
        if (!is_string($langage) || !in_array($langage, $langagesPossibles, true)) {
            return false;
        }
    }

    return true;
}

function erreurMsg(){
    $msg = $_POST["msg"] ?? "";

    return is_string($msg) && strlen($msg) <= 300;
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $filiereValide = in_array(
        $_POST["filiere"] ?? "",
        ["INFO", "MATH", "PHYS", "AUTRE"],
        true
    );

    $reglementValide = isset($_POST["reglement"])
        && $_POST["reglement"] === "oui";

    if (
        erreurName()
        && erreurEmail()
        && erreurAge()
        && $filiereValide
        && erreurLangages()
        && erreurMsg()
        && $reglementValide
    ) {
        $_SESSION["confirmation"] = "Votre inscription a bien été prise en compte !";

        header("Location: inscription.php");
        exit;
    }
}

$confirmation = $_SESSION["confirmation"] ?? "";
unset($_SESSION["confirmation"]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription Hackathon</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <h1>Inscription au Hackathon</h1>
    </header>

    <?php
    if ($confirmation !== "") {
        echo "<p>" . htmlspecialchars($confirmation, ENT_QUOTES, 'UTF-8') . "</p>";
    }
    ?>


    <form action="inscription.php" method="post">

    <div>
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name"
               value="<?php echo enteredval("name"); ?>" required />
    </div>

    <?php
    if (isset($_POST["submit"]) && !erreurName()) {
        echo "Le nom doit comprendre entre 2 et 50 caractères.";
    }
    ?>

    <div>
        <label for="email">E-mail : </label>
        <input type="email" id="email" name="email"
               value="<?php echo enteredval("email"); ?>" required />
    </div>

    <?php
    if (isset($_POST["submit"]) && !erreurEmail()) {
        echo "L'adresse mail n'est pas valide.";
    }
    ?>

    <div>
        <label for="age">Âge : </label>
        <input type="number" id="age" name="age"
               value="<?php echo enteredval("age"); ?>" required />
    </div>

    <?php
    if (isset($_POST["submit"]) && !erreurAge()) {
        echo "L'âge doit être compris entre 16 et 99.";
    }
    ?>

    <div>
        <label for="filiere">Filière : </label>
        <select id="filiere" name="filiere">
            <option value="INFO" <?php if (enteredval("filiere") === "INFO") { echo "selected"; } ?>>INFO</option>
            <option value="MATH" <?php if (enteredval("filiere") === "MATH") { echo "selected"; } ?>>MATH</option>
            <option value="PHYS" <?php if (enteredval("filiere") === "PHYS") { echo "selected"; } ?>>PHYS</option>
            <option value="AUTRE" <?php if (enteredval("filiere") === "AUTRE") { echo "selected"; } ?>>AUTRE</option>
        </select>
    </div>

    <?php
    if (isset($_POST["submit"]) && !$filiereValide) {
        echo "Veuillez sélectionner une filière valide.";
    }
    ?>  

    <div>
        <p>Langages maîtrisés :</p>

        <label>
            <input type="checkbox" name="langages[]" value="PHP"
                <?php if (in_array("PHP", enteredval("langages"), true)) { echo "checked"; } ?>>
            PHP
        </label>

        <label>
            <input type="checkbox" name="langages[]" value="JavaScript"
                <?php if (in_array("JavaScript", enteredval("langages"), true)) { echo "checked"; } ?>>
            JavaScript
        </label>

        <label>
            <input type="checkbox" name="langages[]" value="HTML"
                <?php if (in_array("HTML", enteredval("langages"), true)) { echo "checked"; } ?>>
            HTML
        </label>

        <label>
            <input type="checkbox" name="langages[]" value="CSS"
                <?php if (in_array("CSS", enteredval("langages"), true)) { echo "checked"; } ?>>
            CSS
        </label>
    </div>

    <?php
    if (isset($_POST["submit"]) && !erreurLangages()) {
        echo "Vous devez sélectionner au moins un langage valide.";
    }
    ?>

    <div>
        <label for="msg">Message : </label>
        <textarea id="msg" name="msg"><?php echo enteredval("msg"); ?></textarea>
    </div>

    <?php
    if (isset($_POST["submit"]) && !erreurMsg()) {
        echo "Le message ne peut pas dépasser 300 caractères.";
    }
    ?>

    <div>
        <label for="reglement">Règlement : </label>
        <input type="checkbox" id="reglement" name="reglement" value="oui"
            <?php if (isset($_POST["reglement"])) { echo "checked"; } ?>>
    </div>

    <?php
    if (isset($_POST["submit"]) && !$reglementValide) {
        echo "Vous devez accepter le règlement.";
    }
    ?>

    <input type="submit" name="submit" value="Envoyer" />

    </form>

    <footer>
    </footer>

</body>
</html>