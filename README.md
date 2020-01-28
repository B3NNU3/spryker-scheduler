# spryker-scheduler
Replace Jenkins in your spryker setup

Use [peppeocchi/php-cron-scheduler](https://github.com/peppeocchi/php-cron-scheduler) instead of Jenkins to save resources.

## Installation

```
composer require B3NNU3/spryker-scheduler
```

Copy files from: config/Zed/cronjobs to YOUR_PROJECT_ROOT/config/Zed/cronjobs/   
Add the following to src/Pyz/Zed/Console/ConsoleDependencyProvider.php

```
[...]
use B3NNU3\Zed\CronScheduler\Communication\Console\CronSchedulerCreate;
use B3NNU3\Zed\CronScheduler\Communication\Console\CronSchedulerExecute;
use B3NNU3\Zed\CronScheduler\Communication\Console\CronSchedulerRemove;
[...]

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getConsoleCommands(Container $container): array
    {
        $commands = parent::getConsoleCommands($container);

        [...]
        $commands[] = new CronSchedulerExecute();
        $commands[] = new CronSchedulerCreate();
        $commands[] = new CronSchedulerRemove();
        [...]

        return $commands;
    }
```

run 
```
vendor/bin/console transfer:generate
```

Run the following to set the scheduler script to your crontab 
```
cron:scheduler:create
```

## Usage

The cron will execute in every minute.  
And will run every command from the scheduler.php  
If a command starts the scheduler will create a .lock file for it in data/CLI/scheduler/COMMAND_NAME.lock  
For more information see [peppeocchi/php-cron-scheduler](https://github.com/peppeocchi/php-cron-scheduler)

## Miscellaneous
Please also take a look at you install-recipes at /config/install  

You should replace the following   
Instead of: 
```
    jenkins-down:
        jenkins-stop:
            command: "vendor/bin/console scheduler:clean"
            stores: true
```
use:
```
    scheduler-down:
        remove-cron:
            command: "vendor/bin/console cron:scheduler:remove"
```
and instead of 
```
    jenkins-up:
        jenkins-generate:
            command: "vendor/bin/console scheduler:setup"
            stores: true

        jenkins-enable:
            command: "vendor/bin/console scheduler:resume"
            stores: true
```
use: 
```
    scheduler-up:
        crons-enable:
            command: "vendor/bin/console cron:scheduler:create"
```
            