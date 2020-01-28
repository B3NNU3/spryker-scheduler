<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronScheduler\Business\CronTab;

class CronTabCreator implements CronTabCreatorInterface
{
    /**
     * @var string
     */
    protected $cronTab;

    /**
     * @param string $cronTab
     */
    public function __construct(string $cronTab)
    {
        $this->cronTab = $cronTab;
    }

    /**
     * @inheritDoc
     */
    public function createCrontab(): void
    {
        exec(sprintf('(echo "%s") | crontab -', $this->cronTab));
    }
}
