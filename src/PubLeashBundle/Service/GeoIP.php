<?php
namespace PubLeashBundle\Service;
use GeoIp2\Database\Reader;
use Symfony\Component\HttpFoundation\RequestStack as Request;


/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/6/16
 * Time: 3:01 PM
 */
class GeoIP
{
    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var Request
     */
    protected $request;

    /**
     * GeoIP constructor.
     * @param Reader $reader
     * @param Request $request
     */
    public function __construct(Reader $reader, Request $request)
    {
        $this->reader = $reader;
        $this->request = $request;
    }

    public function getCountry()
    {
        $ip = $this->request->getMasterRequest()->getClientIp();
        return $this->reader->country($ip);
    }

    public function getCity()
    {
        return $this->reader->city($this->request->getMasterRequest()->getClientIp());
    }
}