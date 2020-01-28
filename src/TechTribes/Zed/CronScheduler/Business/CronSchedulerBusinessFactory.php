<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business;

use GO\Scheduler as GOScheduler;
use TechTribes\Zed\CronScheduler\Business\CronScheduler\LockFileDirectoryCreator;
use TechTribes\Zed\CronScheduler\Business\CronScheduler\LockFileDirectoryRemover;
use TechTribes\Zed\CronScheduler\Business\CronScheduler\LockFileDirectoryRemoverInterface;
use TechTribes\Zed\CronScheduler\Business\CronScheduler\Scheduler;
use TechTribes\Zed\CronScheduler\Business\CronScheduler\SchedulerInterface;
use TechTribes\Zed\CronScheduler\Business\CronTab\CronTabCreator;
use TechTribes\Zed\CronScheduler\Business\CronTab\CronTabCreatorInterface;
use TechTribes\Zed\CronScheduler\Business\CronTab\CronTabRemover;
use TechTribes\Zed\CronScheduler\Business\CronTab\CronTabRemoverInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \TechTribes\Zed\CronScheduler\CronSchedulerConfig getConfig()
 */
class CronSchedulerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronScheduler\SchedulerInterface
     */
    public function getScheduler(): SchedulerInterface
    {
        return $this->createScheduler();
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronTab\CronTabCreatorInterface
     */
    public function getCronTabCreator()
    {
        $this->createLockFilePathDirectoryBuilder()->createLockFileDir($this->getConfig()->getTempDirPath());

        return $this->createCronTabCreator();
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronTab\CronTabCreatorInterface
     */
    public function createCronTabCreator(): CronTabCreatorInterface
    {
        return new CronTabCreator($this->getConfig()->getCronTab());
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronTab\CronTabRemoverInterface
     */
    public function createCronTabRemover(): CronTabRemoverInterface
    {
        $this->createLockFileDirectoryRemover()->removeLockFileDir($this->getConfig()->getTempDirPath());

        return new CronTabRemover();
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronScheduler\LockFileDirectoryCreator
     */
    protected function createLockFilePathDirectoryBuilder(): LockFileDirectoryCreator
    {
        return new LockFileDirectoryCreator();
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronScheduler\LockFileDirectoryRemoverInterface
     */
    protected function createLockFileDirectoryRemover(): LockFileDirectoryRemoverInterface
    {
        return new LockFileDirectoryRemover();
    }

    /**
     * @return \Generated\Shared\Transfer\CronSchedulerTransfer[]
     */
    protected function getConfiguration()
    {
        return $this->getConfig()->readSchedule();
    }

    /**
     * @return \GO\Scheduler
     */
    protected function createGoScheduler(): GOScheduler
    {
        return new GOScheduler(['tempDir' => $this->getConfig()->getTempDirPath()]);
    }

    /**
     * @return \TechTribes\Zed\CronScheduler\Business\CronScheduler\Scheduler
     */
    protected function createScheduler(): Scheduler
    {
        return new Scheduler(
            $this->createGoScheduler(),
            $this->getConfiguration(),
            $this->getConfig()->getTempDirPath()
        );
    }
}
