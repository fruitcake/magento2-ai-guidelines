<?php

declare(strict_types=1);

namespace Fruitcake\AiGuidelines\Block;

use FruitcakeAiGuidelines\Model\ContextDataProvider;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Block for displaying AI context in frontend/adminhtml
 * Delegates to ContextDataProvider for all data
 */
class AiContext extends Template
{
    public function __construct(
        Context $context,
        private readonly ContextDataProvider $contextDataProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getGeneratedDate(): string
    {
        return $this->contextDataProvider->getGeneratedDate();
    }

    public function getMagentoVersion(): string
    {
        return $this->contextDataProvider->getMagentoVersion();
    }

    public function getMagentoEdition(): string
    {
        return $this->contextDataProvider->getMagentoEdition();
    }

    public function getPhpVersion(): string
    {
        return $this->contextDataProvider->getPhpVersion();
    }

    public function getOperatingSystem(): string
    {
        return $this->contextDataProvider->getOperatingSystem();
    }

    public function getHyvaVersion(): ?string
    {
        return $this->contextDataProvider->getHyvaVersion();
    }

    public function isHyvaInstalled(): bool
    {
        return $this->contextDataProvider->isHyvaInstalled();
    }

    public function getCustomModules(): array
    {
        return $this->contextDataProvider->getCustomModules();
    }

    public function getThirdPartyModules(): array
    {
        return $this->contextDataProvider->getThirdPartyModules();
    }

    public function getThirdPartyModulesLimited(int $limit = 20): array
    {
        return $this->contextDataProvider->getThirdPartyModulesLimited($limit);
    }

    public function getThirdPartyModulesCount(): int
    {
        return $this->contextDataProvider->getThirdPartyModulesCount();
    }

    public function getRemainingThirdPartyModulesCount(int $limit = 20): int
    {
        return $this->contextDataProvider->getRemainingThirdPartyModulesCount($limit);
    }

    public function getRootDirectory(): string
    {
        return $this->contextDataProvider->getRootDirectory();
    }

    public function getAppDirectory(): string
    {
        return $this->contextDataProvider->getAppDirectory();
    }
}
