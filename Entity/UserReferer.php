<?php
namespace Virmyt\UserRefererBundle\Entity;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Virmyt\UserRefererBundle\Model\ReferrerInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users_referral", indexes={@ORM\Index(name="ref_idx", columns={"ref"})})
 */
class UserReferer
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct($ref, $referer, $ip)
    {
        $this->ref = $ref;
        $this->referer = $referer;
        $this->ip = $ip;
        $this->setCreatedAt(new \DateTime());

    }
    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\Ip
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referer;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $ref;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="Virmyt\UserRefererBundle\Model\ReferrerInterface", cascade="persist")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return UserReferer
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set referer
     *
     * @param string $referer
     * @return UserReferer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Get referer
     *
     * @return string 
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * Set ref
     *
     * @param string $ref
     * @return UserReferer
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return UserReferer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @param ReferrerInterface $user
     * @return UserReferer
     */
    public function setUser(ReferrerInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return ReferrerInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
