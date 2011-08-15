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

        $options = $this->container->get('marbemac.manager.woopra')->getOptions();

        if ($options['idle_timeout'] && $options['domain'])
        {
            if ($this->container->get('security.context')->isGranted('ROLE_USER'))
            {

                $gravatarUrl = 'http://www.gravatar.com/avatar/';
                $userGravatar = $gravatarUrl . md5 ( strtolower( trim( $this->container->get('security.context')->getToken()->getUser()->getEmail() ) ) ) . '?d=monsterid';
            }
            else
            {
                $userGravatar = null;
            }

            return $this->container->get('templating')->renderResponse('MarbemacAnalyticsBundle:Woopra:initialize.html.twig', array(
                'domain' => $options['domain'],
                'idleTimeout' => $options['idle_timeout'],
                'userGravatar' => $userGravatar
            ), $response);
        }

        $response->setContent('<!-- Woopra initalize attempted but marbemac_analytics_woopra_domain and/or marbemac_analytics_woopra_idle_timeout parameters not set -->');

        return $response;
    }
}