<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/31/16
 * Time: 6:43 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity;

/**
 * Class Rank
 * @package PubLeashBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="rank")
 */
class Rank
{

    /**
     * @var Entity\User;
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\User", inversedBy="ranks")
     * @ORM\Id()
     */
    protected $user;

    /**
     * @var Entity\Publication
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Publication", inversedBy="ranks")
     * @ORM\Id()
     */
    protected $publication;

    /**
     * @var integer
     * @ORM\Column(name="rank", type="smallint")
     */
    protected $rank;


    /**
     * Set rank
     *
     * @param integer $rank
     *
     * @return Rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set user
     *
     * @param \PubLeashBundle\Entity\User $user
     *
     * @return Rank
     */
    public function setUser(\PubLeashBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PubLeashBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set publication
     *
     * @param \PubLeashBundle\Entity\Publication $publication
     *
     * @return Rank
     */
    public function setPublication(\PubLeashBundle\Entity\Publication $publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \PubLeashBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
