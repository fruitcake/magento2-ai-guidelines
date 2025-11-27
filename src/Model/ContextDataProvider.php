<?php

declare(strict_types=1);

namespace Fruitcake\AiGuidelines\Model;

use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Composer\ComposerInformation;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Module\ModuleListInterface;

class ContextDataProvider
{
    public function __construct(
        private readonly ProductMetadataInterface $productMetadata,
        private readonly ModuleListInterface $moduleList,
        private readonly DirectoryList $directoryList,
        private readonly ComposerInformation $composerInformation
    ) {
    }

    public function getGeneratedDate(): string
    {
        return date('Y-m-d H:i:s');
    }

    public function getMagentoVersion(): string
    {
        return $this->productMetadata->getVersion();
    }

    public function getMagentoEdition(): string
    {
        return $this->productMetadata->getEdition();
    }

    public function getPhpVersion(): string
    {
        return PHP_VERSION;
    }

    public function getOperatingSystem(): string
    {
        return PHP_OS;
    }

    public function getHyvaVersion(): ?string
    {
        $hyvaModules = [
            'Hyva_Theme',
            'Hyva_ThemeModule'
        ];

        foreach ($hyvaModules as $moduleName) {
            if ($this->moduleList->has($moduleName)) {
                $moduleInfo = $this->moduleList->getOne($moduleName);
                return $moduleInfo['setup_version'] ?? 'unknown';
            }
        }

        // Check composer packages
        $installedPackages = $this->composerInformation->getInstalledMagentoPackages();
        foreach ($installedPackages as $package => $packageInfo) {
            if (str_contains($package, 'hyva') || str_contains($package, 'hyvä')) {
                return $packageInfo['version'] ?? 'detected';
            }
        }

        return null;
    }

    public function isHyvaInstalled(): bool
    {
        return $this->getHyvaVersion() !== null;
    }

    public function getCustomModules(): array
    {
        $modules = $this->moduleList->getAll();
        $customModules = [];

        foreach ($modules as $moduleName => $moduleInfo) {
            // Skip Magento core modules
            if (str_starts_with($moduleName, 'Magento_')) {
                continue;
            }

            // Include custom modules (Fruitcake_)
            if (str_starts_with($moduleName, 'Fruitcake_')) {
                $customModules[] = $moduleName;
            }
        }

        sort($customModules);
        return $customModules;
    }

    public function getThirdPartyModules(): array
    {
        $modules = $this->moduleList->getAll();
        $thirdPartyModules = [];

        foreach ($modules as $moduleName => $moduleInfo) {
            // Skip Magento core and custom modules
            if (str_starts_with($moduleName, 'Magento_') || str_starts_with($moduleName, 'Fruitcake_')) {
                continue;
            }

            $thirdPartyModules[] = $moduleName;
        }

        sort($thirdPartyModules);
        return $thirdPartyModules;
    }

    public function getThirdPartyModulesLimited(int $limit = 20): array
    {
        return array_slice($this->getThirdPartyModules(), 0, $limit);
    }

    public function getThirdPartyModulesCount(): int
    {
        return count($this->getThirdPartyModules());
    }

    public function getRemainingThirdPartyModulesCount(int $limit = 20): int
    {
        $total = $this->getThirdPartyModulesCount();
        return max(0, $total - $limit);
    }

    public function getRootDirectory(): string
    {
        return $this->directoryList->getRoot();
    }

    public function getAppDirectory(): string
    {
        return $this->directoryList->getPath('app');
    }
}
