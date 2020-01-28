<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Business\LogFileStream;

interface ConfigReaderInterface
{
    /**
     * @return array
     */
    public function getCurrentConfiguration(): array;
}
