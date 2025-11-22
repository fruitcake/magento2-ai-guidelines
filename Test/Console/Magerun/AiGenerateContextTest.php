<?php
declare(strict_types=1);

namespace Fruitcake\AiGuidelines\Test\Console\Magerun;

use Fruitcake\AiGuidelines\Console\Magerun\MagerunGenerateAiContext;
use N98\Magento\Command\PHPUnit\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class AiGenerateContextTest extends TestCase
{
    public function testOutput()
    {
        /**
         * Load module config for unit test. In this case the relative
         * path from current test case.
         */
        $this->loadConfigFile(__DIR__ . '/../../../n98-magerun2.yaml');

        /**
         * Test if command could be found
         */
        $command = $this->getApplication()->find('ai:generate-context');

        /**
         * Call command
         */
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $this->assertStringContainsString(MagerunGenerateAiContext::class, $commandTester->getDisplay());
    }
}