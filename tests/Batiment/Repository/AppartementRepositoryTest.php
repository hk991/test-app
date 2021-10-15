<?php

declare(strict_types=1);

namespace App\Tests\Batiment\Repository;

use App\Repository\Batiment\AppartementRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppartementRepositoryTest extends KernelTestCase
{
    public function testCompter()
    {
        self::bootKernel();
        $container = self::$container;

        $repository = $container->get(AppartementRepositoryInterface::class);

        $this->assertEquals(5, $repository->count([]));
    }
}
