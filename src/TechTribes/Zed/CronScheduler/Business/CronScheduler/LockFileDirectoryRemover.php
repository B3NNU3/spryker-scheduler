<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronScheduler;

class LockFileDirectoryRemover implements LockFileDirectoryRemoverInterface
{
    /**
     * @param string $path
     *
     * @return void
     */
    public function removeLockFileDir(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        exec(sprintf('rm -r %s', $path));
    }
}
