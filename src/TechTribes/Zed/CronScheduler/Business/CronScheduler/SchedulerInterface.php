<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronScheduler;

interface SchedulerInterface
{
    /**
     * Execute jobs defined in config
     *
     * @api
     *
     * @return void
     */
    public function executeJobs(): void;
}
