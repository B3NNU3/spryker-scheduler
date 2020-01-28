<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Business;

use TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\ConfigReader;
use TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\ConfigReaderInterface;
use TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\Reader;
use TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\ReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \TechTribes\Zed\CronSchedulerGui\CronSchedulerGuiConfig getConfig()
 * @method \TechTribes\Zed\CronSchedulerGui\Persistence\CronSchedulerGuiQueryContainer getQueryContainer()
 */
class CronSchedulerGuiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\ReaderInterface
     */
    public function createFileReader(): ReaderInterface
    {
        return new Reader($this->getConfig()->readSchedule(), $this->getConfig()->getTempDirPath());
    }

    /**
     * @return \TechTribes\Zed\CronSchedulerGui\Business\LogFileStream\ConfigReaderInterface
     */
    public function createConfigReader(): ConfigReaderInterface
    {
        return new ConfigReader($this->getConfig()->getSchedulePlanFromConfig());
    }
}
