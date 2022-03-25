<?php

namespace App\Service;

use App\Entity\AdditionResult;
use App\ValueObject\ComplexNumber;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

class ComplexNumbersAdder
{
    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function sum(string $num1, string $num2): string
    {
        $num1 = ComplexNumber::parse($num1);
        $num2 = ComplexNumber::parse($num2);

        $result = new ComplexNumber($num1->getRe() + $num2->getRe(), $num1->getIm() + $num2->getIm());

        $additionResult = new AdditionResult();
        $additionResult->setNum1($num1);
        $additionResult->setNum2($num2);
        $additionResult->setResult($result);
        $additionResult->setDatetime(new DateTime());

        $entityManager = $this->doctrine->getManager();

        $entityManager->persist($additionResult);
        $entityManager->flush();

        return (string)$result;
    }
}
