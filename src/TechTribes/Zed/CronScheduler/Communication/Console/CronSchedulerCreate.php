<?php

namespace TechTribes\Zed\CronScheduler\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \TechTribes\Zed\CronScheduler\Business\CronSchedulerFacadeInterface getFacade()
 */
class CronSchedulerCreate extends Console
{
    protected const COMMAND_NAME = 'cron:scheduler:create';
    protected const COMMAND_DESCRIPTION = 'Create crontab for user spryker based on config/Zed/cronjobs/crontab.template';

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::COMMAND_DESCRIPTION);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getFacade()->createCronTab();

        return static::CODE_SUCCESS;
    }
}
