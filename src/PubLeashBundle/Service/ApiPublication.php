<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/29/16
 * Time: 8:58 PM
 */

namespace PubLeashBundle\Service;


class ApiPublication implements ApiServiceInterface
{

    public function getName()
    {
        return 'publication';
    }
}