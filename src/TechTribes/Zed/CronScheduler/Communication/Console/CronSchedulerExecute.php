<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \TechTribes\Zed\CronScheduler\Business\CronSchedulerFacadeInterface getFacade()
 */
class CronSchedulerExecute extends Console
{
    protected const COMMAND_NAME = 'cron:scheduler:execute';
    protected const COMMAND_DESCRIPTION = 'start Spryker scheduler';

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
        $this->getFacade()->execute();

        return static::CODE_SUCCESS;
    }
}
