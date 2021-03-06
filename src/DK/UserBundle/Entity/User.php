<?php

namespace DK\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const REFCODE_CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const REFCODE_LENGTH = 6;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="name_first")
     * @Assert\NotBlank(message="Please enter your first name.", groups={"Registration", "Profile"})
     * @Assert\Length(min="2", max="255", groups={"Registration", "Profile"})
     */
    protected $nameFirst;

    /**
     * @ORM\Column(type="string", name="name_last")
     * @Assert\NotBlank(message="Please enter your last name.", groups={"Registration", "Profile"})
     * @Assert\Length(max="255", groups={"Registration", "Profile"})
     */
    protected $nameLast;

    /**
     * @ORM\Column(type="string", name="ref_code", unique=true)
     */
    protected $refCode;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="referrer_id", referencedColumnName="id")
     */
    protected $referrer;

    /**
     * @ORM\ManyToOne(targetEntity="LogEntry")
     * @ORM\JoinColumn(name="hit_id", referencedColumnName="id")
     */
    protected $refHit;

    /**
     * @var string
     */
    protected $refHitCookie = null;

    public function __construct()
    {
        parent::__construct();

        // FIXME: это надо переписать для исключения риска коллизий
        $this->refCode = self::generateRandomRefCode();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameFirst()
    {
        return $this->nameFirst;
    }

    public function setNameFirst($name)
    {
        return $this->nameFirst = $name;
    }

    public function getNameLast()
    {
        return $this->nameLast;
    }

    public function setNameLast($name)
    {
        return $this->nameLast = $name;
    }

    public function getRefCode()
    {
        return $this->refCode;
    }

    public function setRefCode($refCode)
    {
        return $this->refCode = $refCode;
    }

    public function getReferrer()
    {
        return $this->referrer;
    }

    public function setReferrer(User $referrer)
    {
        return $this->referrer = $referrer;
    }

    public function getRefHit()
    {
        return $this->refHit;
    }

    public function setRefHit(LogEntry $hit)
    {
        return $this->refHit = $hit;
    }

    public function getRefHitCookie()
    {
        return $this->refHitCookie;
    }

    public function setRefHitCookie($cookie)
    {
        return $this->refHitCookie = $cookie;
    }

    public static function generateRandomRefCode()
    {
        $code = '';
        $chars = self::REFCODE_CHARS;
        for ($i = 0; $i < self::REFCODE_LENGTH; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }
}
