<?php

namespace App\ValueObject;

class ComplexNumber
{
    /** @var float */
    private float $re;

    /** @var float */
    private float $im;

    public function __construct(float $re, float $im)
    {
        $this->re = $re;
        $this->im = $im;
    }

    public function getRe(): float
    {
        return $this->re;
    }

    public function getIm(): float
    {
        return $this->im;
    }

    public function __toString(): string
    {
        $im = $this->getIm();
        $re = $this->getRe();

        if (0.0 === $im) {
            return $re;
        }

        if (-1.0 === $im) {
            $im = '-';
        } elseif (1.0 === $im) {
            $im = '+';
        } else {
            $im = $im < 0 ? $im : '+' . $im;
        }

        return $re . $im . 'i';
    }

    public function equals(ComplexNumber $number): bool
    {
        return $this->re === $number->re && $this->im === $number->im;
    }

    public static function parse(string $string): self
    {
        $matches = [];
        preg_match_all('/-?\d*i?/', str_replace(' ', '', $string), $matches);

        $re = 0;
        $im = 0;
        foreach ($matches[0] as $match) {
            if ('' === $match) {
                continue;
            }

            if (false === stripos($match, 'i')) {
                $re = (float)$match;
            } else {
                $im = str_replace('i', '', $match);

                if ('' === $im) {
                    $im = 1;
                } elseif ('-' === $im) {
                    $im = -1;
                }
            }
        }

        return new self($re, $im);
    }
}
