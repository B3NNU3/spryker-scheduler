<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \TechTribes\Zed\CronScheduler\Business\CronSchedulerBusinessFactory getFactory()
 */
class CronSchedulerFacade extends AbstractFacade implements CronSchedulerFacadeInterface
{
    /**
     * @return void
     */
    public function execute(): void
    {
        $this->getFactory()->getScheduler()->executeJobs();
    }

    /**
     * @return void
     */
    public function createCronTab(): void
    {
        $this->getFactory()->getCronTabCreator()->createCrontab();
    }

    /**
     * @return void
     */
    public function removeCronTab(): void
    {
        $this->getFactory()->createCronTabRemover()->removeCrontab();
    }
}
