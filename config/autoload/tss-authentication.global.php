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
                    'name' => 'arkTorch',
                    'params' => ['controller' => 'dashboard'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'authenticate' => [
                    'name' => 'arkTorchAuth/authenticate',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'confirm-email' => [
                    'name' => 'arkTorchAuth/confirm-email',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'password-recover' => [
                    'name' => 'arkTorchAuth/password-recover',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'recover' => [
                    'name' => 'arkTorchAuth/recover',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signin' => [
                    'name' => 'arkTorchAuth/signin',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signout' => [
                    'name' => 'arkTorchAuth/signout',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'signup' => [
                    'name' => 'arkTorchAuth/signup',
                    'params' => [],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'account' => [
                    'name' => 'arkTorchAuth/default',
                    'params' => ['controller' => 'account'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ],
                'password-change' => [
                    'name' => 'arkTorchAuth/default',
                    'params' => ['controller' => 'account', 'action' => 'password-change'],
                    'options' => [],
                    'reuseMatchedParams' => false
                ]
            ],
            'config' => [
                'identityClass' => ArkTorch\Entity\User::class,
                'identityProperty' => 'username',
                'credentialClass' => ArkTorch\Entity\Credential::class,
                'credentialProperty' => 'value',
                'credentialIdentityProperty' => 'user',
                'credentialType' => ArkTorch\Entity\Credential::TYPE_PASSWORD,
                'credential_callable' => 'ArkTorch\Entity\User::checkPassword',
                'identityEmail' => 'email',
                'signAllowed' => false,
                'roleClass' => ArkTorch\Entity\Role::class,
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
                            'index' => ['Guest'],
                            '' => ['Member']
                        ],

                        'ArkTorch\Controller\Dashboard' => [
                            '' => ['Member']
                        ],
                        'ArkTorch\Controller\Index' => [
                            'index' => ['Guest'],
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
