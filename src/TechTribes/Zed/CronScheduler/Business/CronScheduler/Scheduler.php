<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronScheduler;

use GO\Scheduler as GoScheduler;

class Scheduler implements SchedulerInterface
{
    /**
     * @var \GO\Scheduler
     */
    protected $scheduler;

    /**
     * @var array|\Generated\Shared\Transfer\CronSchedulerTransfer[]
     */
    protected $jobs;

    /**
     * @var string
     */
    protected $outputPath;

    /**
     * @param \GO\Scheduler $scheduler
     * @param \Generated\Shared\Transfer\CronSchedulerTransfer[] $jobs
     * @param string $outputPath
     */
    public function __construct(GoScheduler $scheduler, $jobs, string $outputPath)
    {
        $this->scheduler = $scheduler;
        $this->jobs = $jobs;
        $this->outputPath = $outputPath;
    }

    /**
     * @inheritDoc
     */
    public function executeJobs(): void
    {
        foreach ($this->jobs as $job) {
            if (!$job->getEnable()) {
                continue;
            }

            $this->scheduler->raw(sprintf('(date && %s)', $job->getCommand()), [], $job->getName())
                ->at($job->getSchedule())
                ->inForeground()
                ->onlyOne()
                ->output($this->outputPath . '/' . $job->getName() . '.log');
        }

        $this->scheduler->run();
    }
}
