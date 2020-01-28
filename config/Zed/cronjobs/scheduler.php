<?php

/**
 * Notes:
 *
 * - jobs[]['name'] must not contains spaces or any other characters, that have to be urlencode()'d
 * - jobs[]['role'] default value is 'admin'
 */

$stores = require(APPLICATION_ROOT_DIR . '/config/Shared/stores.php');

$allStores = array_keys($stores);

/* -- MAIL QUEUE -- */
$jobs[] = [
    'name' => 'send-mails',
    'command' => 'php vendor/bin/console mailqueue:registration:send',
    'schedule' => '*/10 * * * *',
    'enable' => false,
    'stores' => $allStores,
];

/* ProductValidity */
$jobs[] = [
    'name' => 'check-product-validity',
    'command' => 'php vendor/bin/console product:check-validity',
    'schedule' => '0 6 * * *',
    'enable' => true,
    'stores' => $allStores,
];

/* ProductLabel */
$jobs[] = [
    'name' => 'check-product-label-validity',
    'command' => 'php vendor/bin/console product-label:validity',
    'schedule' => '0 6 * * *',
    'enable' => true,
    'stores' => $allStores,
];
$jobs[] = [
    'name' => 'update-product-label-relations',
    'command' => 'php vendor/bin/console product-label:relations:update -vvv',
    'schedule' => '* * * * *',
    'enable' => true,
    'stores' => $allStores,
];

/* PriceProductSchedule */
$jobs[] = [
    'name' => 'apply-price-product-schedule',
    'command' => 'php vendor/bin/console price-product-schedule:apply',
    'schedule' => '0 6 * * *',
    'enable' => true,
    'stores' => $allStores,
];

$jobs[] = [
    'name' => 'queue-worker-start',
    'command' => 'php vendor/bin/console queue:worker:start',
    'schedule' => '* * * * *',
    'enable' => true,
    'stores' => $allStores,
];

$jobs[] = [
    'name' => 'product-relation-updater',
    'command' => 'php vendor/bin/console product-relation:update -vvv',
    'schedule' => '30 2 * * *',
    'enable' => true,
    'stores' => $allStores,
];

$jobs[] = [
  'name' => 'event-trigger-timeout',
  'command' => 'php vendor/bin/console event:trigger:timeout -vvv',
  'schedule' => '*/5 * * * *',
  'enable' => true,
'stores' => $allStores,
];
