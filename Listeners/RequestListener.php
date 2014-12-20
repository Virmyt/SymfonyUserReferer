<?php

namespace Virmyt\UserRefererBundle\Listeners;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Virmyt\UserRefererBundle\Entity\UserReferer;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($ref = $request->get('ref')) {
            /** @var Session $session */
            $session = $request->getSession();
            $referer = $request->headers->get('referer');

            $referral = new UserReferer($ref, $referer, $request->getClientIp());
            $session->set('referral', $referral);
            $event->setResponse(new RedirectResponse($request->getPathInfo()));
        }
    }
}