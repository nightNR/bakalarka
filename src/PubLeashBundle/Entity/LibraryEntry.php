<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/29/16
 * Time: 8:10 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity\Traits\DateUpdateTrait;

/**
 * Class LibraryEntry
 * @package PubLeashBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="library")
 * @ORM\HasLifecycleCallbacks()
 */
class LibraryEntry
{
    use DateUpdateTrait;

    /**
     * @var
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\User", inversedBy="ownedPublications")
     */
    protected $user;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Publication", inversedBy="ownedBy")
     */
    protected $publication;

    /**
     * @var
     * @ORM\Column(name="is_authorized", type="boolean", options={"default": false})
     */
    protected $isAuthorized = false;


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
     * Set user
     *
     * @param \PubLeashBundle\Entity\User $user
     *
     * @return LibraryEntry
     */
    public function setUser(\PubLeashBundle\Entity\User $user = null)
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
     * @return LibraryEntry
     */
    public function setPublication(\PubLeashBundle\Entity\Publication $publication = null)
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

    /**
     * Set isAuthorized
     *
     * @param boolean $isAuthorized
     *
     * @return LibraryEntry
     */
    public function setIsAuthorized($isAuthorized)
    {
        $this->isAuthorized = $isAuthorized;

        return $this;
    }

    /**
     * Get isAuthorized
     *
     * @return boolean
     */
    public function getIsAuthorized()
    {
        return $this->isAuthorized;
    }
}
