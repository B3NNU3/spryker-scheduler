<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui;

use Generated\Shared\Transfer\CronSchedulerTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\Scheduler\Business\PhpScheduleReader\Exception\FileIsNotAccessibleException;

class CronSchedulerGuiConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getTempDirPath(): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            [
                APPLICATION_ROOT_DIR,
                'data',
                'DE',
                'scheduler',
            ]
        );
    }

    /**
     * @return string
     */
    protected function getPhpSchedulerReaderPath(): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            [
                APPLICATION_ROOT_DIR,
                'config',
                'Zed',
                'cronjobs',
                'scheduler' . '.php',
            ]
        );
    }

    /**
     * @return \Generated\Shared\Transfer\CronSchedulerTransfer[]
     */
    public function readSchedule(): array
    {
        $jobs = $this->getSchedulePlanFromConfig();

        foreach ($jobs as &$job) {
            $transfer = new CronSchedulerTransfer();
            $transfer->setName($job['name']);
            $transfer->setCommand($job['command']);
            $transfer->setSchedule($job['schedule']);
            $transfer->setEnable($job['enable']);
            $job = $transfer;
        }

        return $jobs;
    }

    /**
     * @return array
     */
    public function getSchedulePlanFromConfig(): array
    {
        $jobs = [];
        $sourceFileName = $this->getPhpSchedulerReaderPath();
        $this->assertSourceFileName($sourceFileName);
        include $sourceFileName;

        return $jobs;
    }

    /**
     * @param string $sourceFileName
     *
     * @throws \Spryker\Zed\Scheduler\Business\PhpScheduleReader\Exception\FileIsNotAccessibleException
     *
     * @return void
     */
    protected function assertSourceFileName(string $sourceFileName): void
    {
        if (!file_exists($sourceFileName) || !is_readable($sourceFileName)) {
            throw new FileIsNotAccessibleException(sprintf('Required file `%s` is not accessible.', $sourceFileName));
        }
    }
}
