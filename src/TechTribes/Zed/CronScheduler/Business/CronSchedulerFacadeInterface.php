<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business;

interface CronSchedulerFacadeInterface
{
    /**
     * @return void
     */
    public function execute(): void;

    /**
     * @return void
     */
    public function createCronTab(): void;

    /**
     * @return void
     */
    public function removeCronTab(): void;
}
