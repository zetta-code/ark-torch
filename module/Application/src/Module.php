<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace Application;

use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.0dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkLanguage')); // Language
    }

    /**
     * @description Check Language
     * @param MvcEvent $e
     * @return null|\Zend\Stdlib\ResponseInterface
     */
    public function checkLanguage(MvcEvent $e)
    {
        $availableLanguages = array('en-US', 'pt-BR');
        $defaultLanguage = array('en-US');
        $language = '';
        $fromRoute = false;
        $noTranslate = false;

        $urlHelper = $e->getApplication()->getServiceManager()->get('ViewHelperManager')->get('url');
        $routeMatch = $e->getRouteMatch();
        $request = $e->getApplication()->getRequest();
        // see if language could be find in url
        if ($routeMatch->getParam('language')) {
            $language = $routeMatch->getParam('language');
            $fromRoute = true;
        } else {
            //or use language from http accept
            $headers = $request->getHeaders();
            if ($headers->has('Accept-Language')) {
                $headerLocate = $headers->get('Accept-Language')->getPrioritized();
                $language = $headerLocate[0]->getLanguage();
            }
        }

        if (!in_array($language, $availableLanguages)) {
            $language = $defaultLanguage;
        }
        $e->getApplication()->getServiceManager()->get('router')->setDefaultParam('language', $language);
        switch ($routeMatch->getMatchedRouteName()) {
            case 'api':
                $noTranslate = true;
                break;
        }

        //forward to localized url if not called with language parameter
        if (!$fromRoute && !$noTranslate) {
            $url = $urlHelper->__invoke($routeMatch->getMatchedRouteName(), $routeMatch->getParams(), array('force-canonical' => true));

            $router = $e->getRouter();
            $url = $router->assemble($routeMatch->getParams(), array('name' => $routeMatch->getMatchedRouteName()));
            $response = $e->getResponse();
            $response->getHeaders()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);

            $e->stopPropagation();

            return $response;
        }

        $translator = $e->getApplication()->getServiceManager()->get('MvcTranslator');
        $translator->setLocale(str_replace('-', '_', $language));

        return null;
    }
}
