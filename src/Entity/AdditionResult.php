<?php

namespace App\Entity;

use App\Repository\AdditionResultRepository;
use App\ValueObject\ComplexNumber;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdditionResultRepository::class)]
class AdditionResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 50)]
    private ?ComplexNumber $num1;

    #[ORM\Column(type: 'string', length: 50)]
    private ?ComplexNumber $num2;

    #[ORM\Column(type: 'string', length: 50)]
    private ?ComplexNumber $result;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $datetime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum1(): ?ComplexNumber
    {
        return $this->num1;
    }

    public function setNum1(ComplexNumber $num1): self
    {
        $this->num1 = $num1;

        return $this;
    }

    public function getNum2(): ?ComplexNumber
    {
        return $this->num2;
    }

    public function setNum2(ComplexNumber $num2): self
    {
        $this->num2 = $num2;

        return $this;
    }

    public function getResult(): ?ComplexNumber
    {
        return $this->result;
    }

    public function setResult(ComplexNumber $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }
}
