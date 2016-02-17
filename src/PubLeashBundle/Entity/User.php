<?php

namespace PubLeashBundle\Entity;

use FOS\UserBundle\Model\User as FOSUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/17/16
 * Time: 5:00 PM
 */

/**
 * Class User
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="user")
 * @ORM\Entity()
 */
class User extends FOSUser
{

    /**
     * @var int
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}