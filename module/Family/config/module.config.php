<?php

return array(
    'router' => array(
        'routes' => array(

            'home' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/',
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
                            'route' => ':language[/:controller][/:action][/:id]',
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
            'api' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/api',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Family\Controller',
                        'language' => 'en',
                        'controller' => 'Api',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'search' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/search',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                'action' => 'search',
                            ),
                        )
                    )
                )
            )
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
            'Family\Controller\Tree' => 'Family\Controller\TreeController',
            'Family\Controller\Api' => 'Family\Controller\ApiController'
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
