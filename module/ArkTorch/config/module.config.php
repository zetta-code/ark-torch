<?php
/**
 * @link      http://github.com/zetta-repo/ark-torch for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace ArkTorch;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],

    'controllers' => [
        'aliases' => [
            'ArkTorch\Controller\Dashboard' =>  Controller\DashboardController::class,
            'ArkTorch\Controller\Demigods' =>  Controller\DemigodsController::class,
            'ArkTorch\Controller\Index' =>  Controller\IndexController::class,
            'ArkTorch\Controller\Setup' =>  Controller\SetupController::class
        ],
        'factories' => [
            Controller\DashboardController::class => Controller\EntityManagerControllerFactory::class,
            Controller\DemigodsController::class => Controller\EntityManagerControllerFactory::class,
            Controller\IndexController::class => InvokableFactory::class,
            Controller\SetupController::class => Controller\SetupControllerFactory::class
        ],
    ],

    'doctrine' => [
        'driver' => [
            'arktorch_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'ArkTorch' => 'arktorch_entities',
                ],
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'arkTorch' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/[:language/]:controller[/[:action[/[:id]]]]',
                    'constraints' => [
                        'language' => '(en-US|pt-BR){1}',
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'ArkTorch\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ],
                ],
                'priority' => 1,
            ],

            'arkTorchAuth' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/[:language/]auth',
                    'constraints' => [
                        'language' => '(en-US|pt-BR){1}'
                    ],
                    'defaults' => [
                        'controller' => 'TSS\Authentication\Controller\Auth',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'authenticate' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/authenticate',
                            'defaults' => [
                                'action' => 'authenticate'
                            ]
                        ],
                        'priority' => 9,
                    ],
                    'confirm-email' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/confirm-email/:token',
                            'constraints' => [
                                'token' => '[a-zA-Z0-9]*'
                            ],
                            'defaults' => [
                                'action' => 'confirm-email'
                            ]
                        ],
                        'priority' => 9
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/:controller[/[:action[/[:id]]]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'TSS\Authentication\Controller',
                                'action' => 'index'
                            ]
                        ],
                        'priority' => 5
                    ],
                    'password-recover' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/password-recover/:token',
                            'constraints' => [
                                'token' => '[a-zA-Z0-9]*'
                            ],
                            'defaults' => [
                                'action' => 'password-recover'
                            ]
                        ],
                        'priority' => 9
                    ],
                    'recover' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/recover',
                            'defaults' => [
                                'action' => 'recover'
                            ]
                        ],
                        'priority' => 9
                    ],
                    'signin' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/signin',
                            'defaults' => [
                                'action' => 'signin'
                            ]
                        ],
                        'priority' => 9
                    ],
                    'signout' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/signout',
                            'defaults' => [
                                'action' => 'signout'
                            ],
                        ],
                        'priority' => 9
                    ],
                    'signup' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/signup',
                            'defaults' => [
                                'action' => 'signup'
                            ],
                        ],
                        'priority' => 9
                    ],
                ],
                'priority' => 10
            ],

            'home' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/[:language[/]]',
                    'constraints' => [
                        'language' => '(en-US|pt-BR){1}',
                    ],
                    'defaults' => [
                        'controller' => 'ArkTorch\Controller\Index',
                        'action' => 'index',
                    ],
                ],
                'priority' => 2,
            ],
        ],
    ],
	
    'service_manager' => [
        'abstract_factories' => [

        ],
        'aliases' => [

        ],
		'factories' => [

        ],
    ],

    'view_helpers' => [
        'aliases' => [

        ],
        'factories' => [

        ],
        'invokables' => [

        ],
    ],

    'view_manager' => [
        'template_map' => [
            'layout/landing' => __DIR__ . '/../view/layout/landing/layout.phtml'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
    ],
];
