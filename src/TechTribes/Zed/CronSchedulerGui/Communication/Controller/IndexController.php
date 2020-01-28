<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace TechTribes\Zed\CronSchedulerGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \TechTribes\Zed\CronSchedulerGui\Business\CronSchedulerGuiFacade getFacade()
 * @method \TechTribes\Zed\CronSchedulerGui\Communication\CronSchedulerGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return $this->viewResponse(
            [
                'output' => $this->getFacade()->getSchedulerConfig(),
                'config' => $this->getFacade()->getCurrentConfiguration(),
            ]
        );
    }
}
