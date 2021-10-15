<?php

declare(strict_types=1);

namespace App\Tests\Batiment\Controller;

use App\Repository\Batiment\AppartementRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppartementControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
    }

    public function testNew(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/batiment/appartement/new');

        $form = $crawler->selectButton('Sauvegarder')->form();

        $form['appartement[adresse]'] = '11 rue saint cloud';
        $form['appartement[etage]'] = 2;
        $form['appartement[nombrePieces]'] = 5;
        $form['appartement[ascenceur]'] = true;

        $client->submit($form);

        $this->assertArrayHasKey($client->getResponse()->getStatusCode(), ['200' => '200', '303' => '303']);
    }

    public function testDupliquerNew(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/batiment/appartement/new');

        $form = $crawler->selectButton('Sauvegarder')->form();

        $form['appartement[adresse]'] = '11 rue saint cloud';
        $form['appartement[etage]'] = 2;
        $form['appartement[nombrePieces]'] = 5;
        $form['appartement[ascenceur]'] = true;

        $client->submit($form);

        $this->assertSelectorTextSame('#erreur-adresse', 'Cette adresse existe déjà.');
    }

    public function testDelete(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/batiment/appartement/2');

        $form = $crawler->filter('#form-delete')->form();
        $client->submit($form);

        $this->assertArrayHasKey($client->getResponse()->getStatusCode(), ['200' => '200', '303' => '303']);

        $appartement = self::$container->get(AppartementRepositoryInterface::class)->find(2);
        $this->assertNull($appartement);
    }

    public function testShow(): void
    {
        $client = static::createClient();
        $client->request('GET', '/batiment/appartement/1');

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
    }

    public function testEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/batiment/appartement/1/edit');

        $form = $crawler->selectButton('Sauvegarder')->form();

        $adresse = $form['appartement[adresse]'] = '22 route de paris';

        $client->submit($form);

        $this->assertEquals('303', $client->getResponse()->getStatusCode());

        $appartement = self::$container->get(AppartementRepositoryInterface::class)->find(1);
        $this->assertSame($adresse, $appartement->getAdresse());
    }
}
