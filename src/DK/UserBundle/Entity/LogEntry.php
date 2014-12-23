<?php

namespace DK\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="refcode_hits")
 */
class LogEntry
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="ref_code")
     */
    protected $refCode;

    /**
     * @ORM\Column(type="string", name="referrer")
     */
    protected $referrer;

    /**
     * @ORM\Column(type="string", name="ip")
     */
    protected $IP;

    /**
     * @ORM\Column(type="string", name="dt")
     */
    protected $dateTime;
    
    public function __construct() {
        $this->dateTime = new \DateTime;
    }

    public function getRefCode() {
        return $this->refCode;
    }

    public function setRefCode($code) {
        $this->refCode = $code;
    }

    public function getReferrer() {
        return $this->referrer;
    }

    public function setReferrer($referrer) {
        $this->referrer = $referrer;
    }

    public function getIP() {
        return $this->IP;
    }

    public function setIP($ip) {
        $this->IP = $ip;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function setDateTime(\DateTime $dt) {
        return $this->dateTime = $dt;
    }

}
