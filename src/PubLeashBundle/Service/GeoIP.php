<?php
namespace PubLeashBundle\Service;


/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/6/16
 * Time: 3:01 PM
 */
class GeoIP extends \GeoIp2\Database\Reader
{
    protected $ip;

    public function __construct($filename, array $locales)
    {
        parent::__construct($filename, $locales);
    }

    public function setClientIP($clientIp)
    {
        $this->ip = $clientIp;
    }

    public function country($ipAddress = null)
    {
        return parent::country($ipAddress?:$this->ip);
    }

    public function city($ipAddress = null)
    {
        return parent::city($ipAddress?:$this->ip);
    }
}