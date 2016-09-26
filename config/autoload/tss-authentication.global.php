<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

return [
    'tss' => [
        'authentication' => [
            'layout' => 'tss/authentication/layout/default',
            'templates' => [
                'password-recover' => 'tss/authentication/password-recover',
                'recover' => 'tss/authentication/recover',
                'signin' => 'tss/authentication/signin',
                'signup' => 'tss/authentication/signup'
            ],
            'routes' => [
                'home' => [
                    'name' => 'home',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'redirect' => [
                    'name' => 'home',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'authenticate' => [
                    'name' => 'tssAuthentication/authenticate',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'confirm-email' => [
                    'name' => 'tssAuthentication/confirm-email',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'password-recover' => [
                    'name' => 'tssAuthentication/password-recover',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'recover' => [
                    'name' => 'tssAuthentication/recover',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signin' => [
                    'name' => 'tssAuthentication/signin',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signout' => [
                    'name' => 'tssAuthentication/signout',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signup' => [
                    'name' => 'tssAuthentication/signup',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'account' => [
                    'name' => 'tssAuthentication/default',
                    'params' => ['controller' => 'account'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'password-change' => [
                    'name' => 'tssAuthentication/default',
                    'params' => ['controller' => 'account', 'action' => 'password-change'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ]
            ],
            'config' => [
                'identityClass' => Application\Entity\User::class,
                'identityProperty' => 'username',
                'credentialClass' => Application\Entity\Credential::class,
                'credentialProperty' => 'value',
                'credentialIdentityProperty' => 'user',
                'credentialType' => Application\Entity\Credential::TYPE_PASSWORD,
                'credential_callable' => 'Application\Entity\User::checkPassword',
                'identityEmail' => 'email',
                'identityActive' => false,
                'roleClass' => Application\Entity\Role::class,
                'roleDefault' => 2
            ],

            'acl' => [
                'default_role' => 'Guest',
                'roles' => [
                    'Guest' => null,
                    'Member' => ['Guest'],
                    'Admin' => ['Member']
                ],
                'resources' => [
                    'allow' => [
                        'Application\Controller\Index' => [
                            '' => ['Member']
                        ],
                        'TSS\Authentication\Controller\Account' => [
                            '' => ['Member']
                        ],
                        'TSS\Authentication\Controller\Auth' => [
                            'authenticate' => ['Guest'],
                            'confirm-email' => ['Guest'],
                            'password-recover' => ['Guest'],
                            'recover' => ['Guest'],
                            'signin' => ['Guest'],
                            'signout' => ['Guest'],
                            'signup' => ['Guest']
                        ],
                        'TSS\Authentication\Menu' => [
                            'account' => ['Member']
                        ]
                    ],
                    'deny' => [
                        'TSS\Authentication\Controller\Auth' => [
                            'signup' => ['Member']
                        ]
                    ]
                ]
            ]
        ]
    ]
];
