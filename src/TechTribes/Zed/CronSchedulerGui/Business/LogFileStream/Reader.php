<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Business\LogFileStream;

class Reader implements ReaderInterface
{
    /**
     * @var array|\Generated\Shared\Transfer\SchedulerJobTransfer[]
     */
    protected $jobs;

    /**
     * @var string
     */
    protected $scheduleLogDirPath;

    /**
     * @param \Generated\Shared\Transfer\SchedulerJobTransfer[] $jobs
     * @param string $scheduleLogDirPath
     */
    public function __construct($jobs, string $scheduleLogDirPath)
    {
        $this->jobs = $jobs;
        $this->scheduleLogDirPath = $scheduleLogDirPath;
    }

    /**
     * @return string
     */
    public function readSchedulerConfig(): string
    {
        $output = '';

        foreach ($this->jobs as $job) {
            $path = $this->scheduleLogDirPath . '/' . $job->getName() . '.log';

            if (!file_exists($path)) {
                continue;
            }
            $output .= $path . PHP_EOL . PHP_EOL;
            $output .= file_get_contents($path);
        }

        return $output;
    }
}
