<?php

declare(strict_types=1);

namespace App\Tests\Batiment\Entity;

use App\Entity\Batiment\Appartement;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppartementTest extends KernelTestCase
{
    public function testInsertionValide()
    {
        self::bootKernel();
        $container = self::$container;

        $appartement = new Appartement();
        $appartement->setAdresse('1 rue test');
        $appartement->setEtage(1);
        $appartement->setNombrePieces(2);

        $erreurs = $container->get('validator')->validate($appartement);
        $this->assertCount(0, $erreurs);
    }

    public function testInsertionInvalide()
    {
        self::bootKernel();
        $container = self::$container;

        $appartement = new Appartement();
        $appartement->setAdresse('1 rue test');
        $appartement->setEtage(-1);
        $appartement->setNombrePieces(-2);

        $erreurs = $container->get('validator')->validate($appartement);
        $this->assertCount(2, $erreurs);
    }

    public function testUnicitéInvalide()
    {
        self::bootKernel();
        $container = self::$container;

        $appartement = new Appartement();
        $appartement->setAdresse('4 rue du bonheur');
        $appartement->setEtage(1);
        $appartement->setNombrePieces(2);

        $erreurs = $container->get('validator')->validate($appartement);
        $this->assertCount(1, $erreurs);
    }
}
