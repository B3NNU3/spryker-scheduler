<?php

namespace TechTribes\Zed\CronScheduler;

use Generated\Shared\Transfer\CronSchedulerTransfer;
use Spryker\Zed\Kernel\AbstractBundleConfig;
use Spryker\Zed\Scheduler\Business\PhpScheduleReader\Exception\FileIsNotAccessibleException;

class CronSchedulerConfig extends AbstractBundleConfig
{
    protected const PROJECT_DIR_PLACEHOLDER = '__PROJECT_DIR__';

    /**
     * @return string
     */
    public function getCronTab(): string
    {
        $crontabTemplate = file_get_contents($this->getCronTabTemplatePath());
        $this->assertSourceFileName($crontabTemplate);

        return str_replace(static::PROJECT_DIR_PLACEHOLDER, APPLICATION_ROOT_DIR, $crontabTemplate);
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
     * @return string
     */
    public function getTempDirPath(): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            [
                APPLICATION_ROOT_DIR,
                'data',
                'CLI',
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
     * @return string
     */
    protected function getCronTabTemplatePath(): string
    {
        return implode(
            DIRECTORY_SEPARATOR,
            [
                APPLICATION_ROOT_DIR,
                'config',
                'Zed',
                'cronjobs',
                'crontab' . '.template',
            ]
        );
    }

    /**
     * @return array
     */
    protected function getSchedulePlanFromConfig(): array
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
