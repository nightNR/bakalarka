<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 3:47 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class LanguageEnum
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="LanguageEnumRepository", )
 */
class LanguageEnum
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="abbreviation")
     */
    protected $abbreviation;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\User", mappedBy="language")
     */
    protected $users;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Publication", mappedBy="language")
     */
    protected $publications;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->publications = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return LanguageEnum
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set abbreviation
     *
     * @param string $abbreviation
     *
     * @return LanguageEnum
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * Get abbreviation
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return LanguageEnum
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add publication
     *
     * @param Publication $publication
     *
     * @return LanguageEnum
     */
    public function addPublication(Publication $publication)
    {
        $this->publications[] = $publication;

        return $this;
    }

    /**
     * Remove publication
     *
     * @param Publication $publication
     */
    public function removePublication(Publication $publication)
    {
        $this->publications->removeElement($publication);
    }

    /**
     * Get publications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublications()
    {
        return $this->publications;
    }
}
