<?php


namespace Virmyt\UserRefererBundle\Tests\Listeners;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Virmyt\UserRefererBundle\Entity\UserReferer;

class RequestListenerTest extends WebTestCase
{
    public function testOnKernelRequest()
    {
        $client = static::createClient();
        $ref = 'dfhbgs';
        $client->request('GET', '/?ref='. $ref);

        $sessionIterator = $client->getRequest()->getSession()->getIterator();
        /** @var UserReferer $referral */
        $referral = $sessionIterator->offsetExists('referral') ? $sessionIterator->offsetGet('referral') : null;

        $this->assertTrue($referral instanceof UserReferer);
        $this->assertTrue($referral->getRef() == $ref);
    }

}