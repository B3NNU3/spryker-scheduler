<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Business;

interface CronSchedulerGuiFacadeInterface
{
    /**
     * @return string
     */
    public function getSchedulerConfig(): string;

    /**
     * @return array
     */
    public function getCurrentConfiguration(): array;
}
