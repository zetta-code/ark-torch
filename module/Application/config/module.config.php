<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace Application;

use Zend\Mvc\I18n\Translator;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper\Navigation\Menu;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index'
                    ]
                ]
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[:controller[/:action]]',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'aliases' => [
            'Application\Controller\Index' =>  Controller\IndexController::class
        ],
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class
        ],
    ],
    'doctrine' => [
        'driver' => [
            'application_entities' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Application/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'Application' => 'application_entities'
                ]
            ]
        ]
    ],
    'service_manager' => [
        'factories' => [
            'mail.transport' => Factory\TransportFactory::class
        ],
        'delegators' => [
            Translator::class => [
                Delegator\TranslatorDelegator::class
            ]
        ]
    ],
    'translator' => [
        'locale' => 'pt_BR',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../../../data/language',
                'pattern'  => '%s.mo',
            ],
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/default/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ],
];
