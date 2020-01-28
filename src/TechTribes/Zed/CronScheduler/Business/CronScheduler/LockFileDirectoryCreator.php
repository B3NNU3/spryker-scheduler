<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronScheduler;

class LockFileDirectoryCreator implements LockFileDirectoryCreatorInterface
{
    /**
     * @param string $path
     *
     * @return void
     */
    public function createLockFileDir(string $path): void
    {
        if (file_exists($path)) {
            return;
        }

        mkdir($path, 0777, true);
    }
}
