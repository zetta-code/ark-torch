<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'mail' => [
        'options' => [
            'sender' => 'sendmail',
            'from-email' => 'tss@bootstrap',
            'from-name' => 'TSS',
        ],
        'transport' => [
            'options' => [
                'name' => 'localhost',
                'host' => 'localhost',
                'port' => '465',
                'connection_class'  => 'login',
                'connection_config' => [
                    'username' => 'root',
                    'password' => '',
                    'ssl' => 'ssl'
                ],
            ],
        ],
    ],
];
