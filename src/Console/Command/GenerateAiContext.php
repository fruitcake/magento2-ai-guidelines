<?php

declare(strict_types=1);

namespace Fruitcake\AiFiles\src\Console\Command;

use Fruitcake\AiFiles\src\Service\AiContextGenerator;
use Magento\Framework\App\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateAiContext extends Command
{
    private ?AiContextGenerator $generator;

    protected function configure(): void
    {
        $this->setName('ai:generate-context')
            ->setDescription('Generate CLAUDE.md file with relevant project context for AI assistance');
    }

    /**
     * Inject dependencies on demand to avoid loading for every command
     *
     * @return void
     */
    public function inject()
    {
        $this->generator = ObjectManager::getInstance()->get(AiContextGenerator::class);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->inject();

        $result = $this->generator->generate($output);

        if (!$result) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
