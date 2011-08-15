<?php

namespace Marbemac\AnalyticsBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\DependencyInjection\ContainerAware,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Security\Core\Exception\AccessDeniedException,
    Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class WoopraController extends ContainerAware
{
    public function initializeAction()
    {
        $response = new Response();
        $response->setCache(array(
        ));

        if ($response->isNotModified($this->container->get('request'))) {
            // return the 304 Response immediately
            return $response;
        }

        if ($this->container->hasParameter('marbemac_analytics_woopra_domain') && $this->container->hasParameter('marbemac_analytics_woopra_idle_timeout'))
        {
            $domain = $this->container->getParameter('marbemac_analytics_woopra_domain');
            $idleTimeout = $this->container->getParameter('marbemac_analytics_woopra_idle_timeout');

            return $this->container->get('templating')->renderResponse('MarbemacAnalyticsBundle:Woopra:initialize.html.twig', array(
                'domain' => $domain,
                'idleTimeout' => $idleTimeout
            ), $response);
        }

        $response->setContent('<!-- Woopra initalize attempted but marbemac_analytics_woopra_domain and/or marbemac_analytics_woopra_idle_timeout parameters not set -->');

        return $response;
    }
}