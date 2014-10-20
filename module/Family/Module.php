<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Family;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Family\Model\Person;
use Family\Service\PersonTable;

class Module {

    /**
     * 
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e) {
        $this->initAcl($e);
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, array($this, 'languageLocale'));
        $eventManager->attach('render', array($this, 'registerJsonStrategy'), 100);
        $eventManager->attach('route', array($this, 'checkAcl'), 1);
        $moduleRouteListener->attach($eventManager);
    }

    /**
     * 
     * @return type
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return type
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * 
     * @return type
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Family\Service\PersonTable' => function($sm) {
                    $tableGateway = $sm->get('PeopleTableGateway');
                    $table = new PersonTable($tableGateway);
                    return $table;
                },
                'PeopleTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Person());
                    return new TableGateway('people', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function languageLocale(MvcEvent $e) {

        $language = $e->getRouteMatch()->getParam('language');
        if ($language == 'ru') {
            $e->getApplication()->getServiceManager()->get('translator')->setLocale('ru_RU');
        }
    }

    /**
     * 
     * @param type $e
     * @return type
     */
    public function registerJsonStrategy($e) {
        $matches = $e->getRouteMatch();
        if (!$matches) {
            return;
        }
        $controller = $matches->getParam('controller');
        if (false === strpos($controller, 'Api')) {
            return;
        }
        $app = $e->getTarget();
        $locator = $app->getServiceManager();
        $view = $locator->get('Zend\View\View');
        $jsonStrategy = $locator->get('ViewJsonStrategy');
        $view->getEventManager()->attach($jsonStrategy, 100);
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function initAcl(MvcEvent $e) {
        $acl = new \Zend\Permissions\Acl\Acl();
        $roles = include __DIR__ . '/config/module.acl.roles.php';
        $allResources = array();
        foreach ($roles as $role => $resources) {
            $role = new \Zend\Permissions\Acl\Role\GenericRole($role);
            $acl->addRole($role);
            $allResources = array_merge($resources, $allResources);
            //adding resources
            foreach ($resources as $resource) {
                if (!$acl->hasResource($resource))
                    $acl->addResource(new \Zend\Permissions\Acl\Resource\GenericResource($resource));
            }
            //adding restrictions
            foreach ($allResources as $resource) {
                $acl->allow($role, $resource);
            }
        }
        $e->getViewModel()->acl = $acl;
    }

    /**
     * 
     * @param MvcEvent $e
     */
    public function checkAcl(MvcEvent $e) {
        $route = $e->getRouteMatch()->getMatchedRouteName();
        //set role
        $userRole = 'guest';
        $response = $e->getResponse();
        try {
            $e->getViewModel()->acl->isAllowed($userRole, $route);
        } catch (\Zend\Permissions\Acl\Exception\InvalidArgumentException $ex) {
            $response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/404');
            $response->setStatusCode(404);
        }
    }

}
