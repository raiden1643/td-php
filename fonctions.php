<?php
declare(strict_types=1);

function moyenne(array $notes){
    if (empty($notes)){
        return array_sum($notes)/count($notes);}
    else {
        return 0.0;
    }
}

function estAdmis(float $note, float $seuil = 10.0){
    if ($note < $seuil){
        return false;
    }
    else {
        return true;
    }
}

function meilleurEtudiant(array $notes){
    return array_search(max($notes), $notes);
}

?>
