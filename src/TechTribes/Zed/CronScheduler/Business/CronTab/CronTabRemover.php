<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronTab;

class CronTabRemover implements CronTabRemoverInterface
{
    /**
     * @return void
     */
    public function removeCrontab(): void
    {
        exec('crontab -r');
    }
}
