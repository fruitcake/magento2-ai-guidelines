<?php

declare(strict_types=1);

namespace Fruitcake\AiGuidelines\Console\Magerun;

use Fruitcake\AiGuidelines\Service\AiContextGenerator;
use N98\Magento\Command\AbstractMagentoCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MagerunGenerateAiContext extends AbstractMagentoCommand
{
    private ?AiContextGenerator $generator;

    protected function configure(): void
    {
        $this->setName('ai:generate-context')
            ->setDescription('Generate CLAUDE.md file with relevant project context for AI assistance');
    }

    public function inject(AiContextGenerator $generator)
    {
        $this->generator = $generator;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Generating AI context from Magerun2...');

        $result = $this->generator->generate($output);
        if (!$result) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
