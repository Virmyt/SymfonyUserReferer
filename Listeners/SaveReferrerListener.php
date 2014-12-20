<?php

namespace Virmyt\UserRefererBundle\Listeners;

use Doctrine\ORM\EntityManager;
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
            $referral = $this->session->getIterator()->offsetExists('referral') ? $this->session->getIterator()->offsetGet('referral') : null;
            if( $referral instanceof UserReferer ) {
                $referral->setUser($user);
                $lifecycleEventArgs->getEntityManager()->merge($referral);
            }
        }
    }

} 