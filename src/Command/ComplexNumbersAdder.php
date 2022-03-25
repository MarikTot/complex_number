<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\ComplexNumbersAdder as ComplexNumbersAdderService;

class ComplexNumbersAdder extends Command
{
    private const ARG_FIRST_NUMBER = 'number1';
    private const ARG_SECOND_NUMBER = 'number2';

    protected static $defaultName = 'sum';

    protected ComplexNumbersAdderService $adderService;

    public function __construct(ComplexNumbersAdderService $adderService, string $name = null)
    {
        parent::__construct($name);

        $this->adderService = $adderService;
    }

    protected function configure(): void
    {
        $this->addArgument(self::ARG_FIRST_NUMBER, InputArgument::REQUIRED, 'First number');
        $this->addArgument(self::ARG_SECOND_NUMBER, InputArgument::REQUIRED, 'Second number');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $num1 = $input->getArgument(self::ARG_FIRST_NUMBER);
        $num2 = $input->getArgument(self::ARG_SECOND_NUMBER);

        $output->writeln('first number: ' . $num1);
        $output->writeln('second number: ' . $num2);

        try {
            $result = $this->adderService->sum($num1, $num2);
        } catch (\InvalidArgumentException $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }

        $output->writeln('result: ' . $result);

        return Command::SUCCESS;
    }
}
