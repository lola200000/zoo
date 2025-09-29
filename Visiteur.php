<?php
// Visiteur.php
declare(strict_types=1);

class Visiteur {
    private string $nom;

    public function __construct(string $nom) {
        $this->nom = $nom;
    }

    public function getNom(): string {
        return $this->nom;
    }

    //
    public function info(): void {
        echo "--- {$this->nom} entre dans le zoo ---\n";
    }
}
