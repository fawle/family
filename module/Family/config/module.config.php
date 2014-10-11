<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:language',
                    'constraints' => array(
                                'language' => '[a-z]{2}',
                            ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Family\Controller',
                        'controller' => 'About',
                        'action' => 'index',
                        'language' => 'en',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '[/:controller][/:action][/:id]',
                            'constraints' => array(
                                'language' => '[a-z]{2}',
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]*'
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'tree' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:language/tree',
                    'constraints' => array(
                                'language' => '[a-z]{2}',
                            ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Family\Controller',
                        'language' => 'en',
                        'controller' => 'Tree',
                        'action' => 'tree',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'person' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/:id',
                            'constraints' => array(
                                'id' => '[0-9]*'
                            ),
                            'defaults' => array(
                                'action' => 'person',
                            ),
                        ),
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/search',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Family\Controller',
                                'language' => 'en',
                                'controller' => 'Tree',
                                'action' => 'search',
                            ),
                        ),
                    ),
                    'admin' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/admin',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Family\Controller',
                                'language' => 'en',
                                'controller' => 'Tree',
                                'action' => 'login',
                            ),
                        ),
                    ),
                )
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        //'locale' => 'ru_RU',
        'locale' => 'en_GB',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Family\Controller\About' => 'Family\Controller\AboutController',
            'Family\Controller\Tree' => 'Family\Controller\TreeController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'nestedList' => 'Family\View\NestedList'
        )
    ),
);
