<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace Application;

class Module
{
    const VERSION = '3.0.0dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
