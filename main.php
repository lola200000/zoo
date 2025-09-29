<?php
declare(strict_types=1);

require_once DIR . '/Animal.php';
require_once DIR . '/Visiteur.php';
require_once DIR . '/Zoo.php';

// Création du zoo
$zoo = new Zoo();

// Livraison d'animaux (avant l'ouverture)
$zoo->livraison([
    new Lion("Concon"),
    new Zebre("Rayures")
]);


$visiteurs = [
    new Visiteur("Loïc"),
    new Visiteur("Yannick"),
    new Visiteur("Yassine"),
    new Visiteur("Enzo"),
    new Visiteur("Pierre"),
    new Visiteur("collègues"),
    new Visiteur("petits enfants"),
    new Visiteur("Wahid"),
    new Visiteur("couple amoureux"),
    new Visiteur("la famille"),
];

// Vente des billets
$zoo->vendreBillet($visiteurs);

// Ouverture du zoo
$zoo->ouvrirLesPortes();


?>
