<?php

namespace App\Tests\Service;

use App\Service\ComplexNumbersAdder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

final class ComplexNumbersAdderTest extends TestCase
{
    /**
     * @dataProvider additionProvider
     */
    public function testSum(string $num1, string $num2, string $expected): void
    {
        $mock = $this->createMock(ManagerRegistry::class);
        $managerMock = $this->createMock(ObjectManager::class);
        $mock->method('getManager')->willReturn($managerMock);

        $service = new ComplexNumbersAdder($mock);

        $this->assertSame($expected, $service->sum($num1, $num2));
    }

    public function additionProvider(): array
    {
        return [
            ['1+2i', '2-i', '3+i'],
            ['2-2i', '12-i', '14-3i'],
            ['-2+i', '1-2i', '-1-i'],
            ['2i-1', 'i', '-1+3i'],
            ['5i', '2+4i', '2+9i'],
        ];
    }
}
