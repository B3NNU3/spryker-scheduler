<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \TechTribes\Zed\CronSchedulerGui\Business\CronSchedulerGuiBusinessFactory getFactory()
 */
class CronSchedulerGuiFacade extends AbstractFacade implements CronSchedulerGuiFacadeInterface
{
    /**
     * @return string
     */
    public function getSchedulerConfig(): string
    {
        return $this->getFactory()->createFileReader()->readSchedulerConfig();
    }

    /**
     * @return array
     */
    public function getCurrentConfiguration(): array
    {
        return $this->getFactory()->createConfigReader()->getCurrentConfiguration();
    }
}
