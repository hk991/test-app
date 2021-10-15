<?php

declare(strict_types=1);

namespace App\DataFixtures\Batiment;

use App\Entity\Batiment\Appartement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppartementFixtures extends Fixture
{
    private $appartements = [
        ['adresse' => '1 rue de la liberté', 'etage' => 1, 'nombrePieces' => 2, 'ascenceur' => false],
        ['adresse' => '2 rue de la paix', 'etage' => 2, 'nombrePieces' => 2, 'ascenceur' => true],
        ['adresse' => '3 rue de la fratérnité', 'etage' => 2, 'nombrePieces' => 3, 'ascenceur' => false],
        ['adresse' => '4 rue du bonheur', 'etage' => 3, 'nombrePieces' => 6, 'ascenceur' => true],
        ['adresse' => '1 rue de l\'égalité', 'etage' => 4, 'nombrePieces' => 1, 'ascenceur' => false],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->appartements as $appartement) {
            $appartement = $this->ajoutAppartement(
                $appartement['adresse'],
                $appartement['etage'],
                $appartement['nombrePieces'],
                $appartement['ascenceur']
            );
            $manager->persist($appartement);
        }

        $manager->flush();
    }

    private function ajoutAppartement(string $adresse, int $etage, int $nombrePieces, bool $ascenceur): Appartement
    {
        $appartement = new Appartement();
        $appartement->setAdresse($adresse);
        $appartement->setEtage($etage);
        $appartement->setNombrePieces($nombrePieces);
        $appartement->setAscenceur($ascenceur);

        return $appartement;
    }
}
