<?php

declare(strict_types=1);

abstract class Animal {
    protected string $nom;
    protected bool $dansZoo;   // true si né dans le zoo
    protected string $type;    // "carnivore" ou "herbivore"
    protected string $espece;  // "lion", "zèbre", etc.

   
    public function __construct(string $nom = "", bool $dansZoo = false) {
        $this->nom = $nom;
        $this->dansZoo = $dansZoo;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function estNeDansZoo(): bool {
        return $this->dansZoo;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getEspece(): string {
        return $this->espece;
    }

    // Chaque animal fait son show (affiche un message).
     
    abstract public function faireLeShow(): void;

    
    abstract public function donnerNaissance(): Animal;
}


// 

class Lion extends Animal {
    protected string $type = 'carnivore';
    protected string $espece = 'lion';

    public function __construct(string $nom = "", bool $dansZoo = false) {
        parent::__construct($nom, $dansZoo);
    }

    public function faireLeShow(): void {
        $nomPart = $this->nom !== "" ? " et qui s’appelle {$this->nom}" : "";
        echo "cet animal {$this->type} qui est un {$this->espece}{$nomPart}\n";
    }

    public function donnerNaissance(): Animal {
        $bebe = new Lion("", true);
        echo "un nouvel animal est né dans le Zoo\n";
        return $bebe;
    }
}


// 
class Zebre extends Animal {
    protected string $type = 'herbivore';
    protected string $espece = 'zèbre';

    public function __construct(string $nom = "", bool $dansZoo = false) {
        parent::__construct($nom, $dansZoo);
    }

    public function faireLeShow(): void {
        $nomPart = $this->nom !== "" ? " et qui s’appelle {$this->nom}" : "";
        echo "cet animal {$this->type} qui est un {$this->espece}{$nomPart}\n";
    }

    public function donnerNaissance(): Animal {
        $bebe = new Zebre("", true);
        echo "un nouvel animal est né dans le Zoo\n";
        return $bebe;
    }
}

?>
