<?php

namespace Virmyt\UserRefererBundle\Listeners;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Session\Session;
use Virmyt\UserRefererBundle\Entity\UserReferer;
use Virmyt\UserRefererBundle\Model\ReferrerInterface;


class SaveReferrerListener
{
    /** @var Session */
    private $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function prePersist(LifecycleEventArgs $lifecycleEventArgs)
    {
        if (($user = $lifecycleEventArgs->getEntity()) instanceof ReferrerInterface) {
            $sessionIterator = $this->session->getIterator();
            $referral = $sessionIterator->offsetExists('referral') ? $sessionIterator->offsetGet('referral') : null;
            if( $referral instanceof UserReferer ) {
                $referral->setUser($user);
                $lifecycleEventArgs->getEntityManager()->merge($referral);
            }
        }
    }

} 