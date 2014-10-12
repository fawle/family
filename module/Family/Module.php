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

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, array($this, 'languageLocale'));
        $eventManager->attach('render', array($this, 'registerJsonStrategy'), 100);
        $moduleRouteListener->attach($eventManager);

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Family\Service\PersonTable' =>  function($sm) {
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
    public function languageLocale(MvcEvent $e)
    {

        $language = $e->getRouteMatch()->getParam('language');
        if ($language == 'ru') {
            $e->getApplication()->getServiceManager()->get('translator')->setLocale('ru_RU');
        } 

    }
    
    public function registerJsonStrategy($e)
    {
        $matches    = $e->getRouteMatch();
        if (!$matches) {
            return;
        }
        $controller = $matches->getParam('controller');

        if (false === strpos($controller, 'Api')) {
            // not a controller from this module
            return;
        }

        // Potentially, you could be even more selective at this point, and test
        // for specific controller classes, and even specific actions or request
        // methods.

        // Set the JSON strategy when controllers from this module are selected
        $app          = $e->getTarget();
        $locator      = $app->getServiceManager();
        $view         = $locator->get('Zend\View\View');
        $jsonStrategy = $locator->get('ViewJsonStrategy');

        // Attach strategy, which is a listener aggregate, at high priority
        $view->getEventManager()->attach($jsonStrategy, 100);
    }
}
