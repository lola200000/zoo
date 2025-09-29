<?php
declare(strict_types=1);

require_once(__DIR__ .'/Visiteur.php');

class Zoo {
   
    private array $animaux = [];

   
    private array $visiteurs = [];

    // flags pour ne déclencher chaque naissance qu'une seule fois
    private bool $naissanceApresMoitieFaite = false;
    private bool $naissanceApresFinFaite = false;

    /**
     * Livraison : on reçoit un tableau d'objets Animal (instances déjà créées).
     * Affiche : "une livraison de XX animaux a été effectuée."

     */
    public function livraison(array $animauxLivres): void {
        $this->animaux = array_merge($this->animaux, $animauxLivres);
        $count = count($animauxLivres);
        echo "une livraison de {$count} animaux a été effectuée.\n";
    }

    /**
     * Vendre un billet à un visiteur ou à un tableau de visiteurs.
     
     */
    public function vendreBillet(Visiteur|array $visiteur): void {
        if (is_array($visiteur)) {
            foreach ($visiteur as $v) {
                if ($v instanceof Visiteur) {
                    $this->visiteurs[] = $v;
                }
            }
        } elseif ($visiteur instanceof Visiteur) {
            $this->visiteurs[] = $visiteur;
        }
    }

    /**
     * Demande de naissance pour l'animal d'index donné (s'il existe).
     * Affiche "un nouvel animal est né dans le Zoo" (géré par la classe Animal).
     */
    public function naissanceParIndex(int $index): void {
        if (isset($this->animaux[$index])) {
            $nouveau = $this->animaux[$index]->donnerNaissance();
            $this->animaux[] = $nouveau;
        }
    }

    /**
     * Ouvre les portes : chaque visiteur parcourt tous les animaux.
     * Naissance du 2ème animal après la moitié des visiteurs,
     * naissance du 1er animal après la fin des visites.
     */
    public function ouvrirLesPortes(): void {
        $totalVisiteurs = count($this->visiteurs);
        if ($totalVisiteurs === 0) {
            echo "Pas de visiteurs, le zoo reste fermé.\n";
            return;
        }

        echo "\n=== OUVERTURE DU ZOO ===\n";
        // On simule que le zoo n'ouvre que s'il y a assez de visiteurs pour payer (ici on suppose que
        // la règle "assez de monde" est remplie dès qu'il y a au moins 1 visiteur — adapte si besoin).
        echo "Le zoo ouvre pour {$totalVisiteurs} visiteurs.\n";

        foreach ($this->visiteurs as $i => $visiteur) {
            // chaque visiteur entre et regarde tous les animaux (attend la fin pour le suivant)
            $visiteur->info();
            foreach ($this->animaux as $animal) {
                $animal->faireLeShow();
            }

            // après la moitié des visiteurs (arrondi vers le haut), déclencher naissance du 2e animal (index 1)
            $moitie = (int) ceil($totalVisiteurs / 2);
            if (!$this->naissanceApresMoitieFaite && ($i + 1) === $moitie) {
                // deuxième animal de la liste met bas (index 1) si existe
                if (isset($this->animaux[1])) {
                    $this->naissanceParIndex(1);
                }
                $this->naissanceApresMoitieFaite = true;
            }
        }

        // Après la visite de tous les visiteurs : premier animal (index 0) met bas
        if (!$this->naissanceApresFinFaite) {
            if (isset($this->animaux[0])) {
                $this->naissanceParIndex(0);
            }
            $this->naissanceApresFinFaite = true;
        }
    }

    // * Méthode pratique pour inspecter l'état 
    public function debugEtat(): void {
        echo "\n--- ÉTAT DU ZOO ---\n";
        echo "Nombre d'animaux : " . count($this->animaux) . "\n";
        foreach ($this->animaux as $idx => $a) {
            $name = $a->getNom() === "" ? "(sans nom)" : $a->getNom();
            $born = $a->estNeDansZoo() ? "né au zoo" : "livré";
echo "[$idx] {$a->getEspece()} - {$a->getType()} - {$name} - {$born}\n";
        }
        echo "Nombre de visiteurs vendus : " . count($this->visiteurs) . "\n";
    }
}
