<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 3:14 PM
 */

namespace PubLeashBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CityEnum
 * @package PubLeashBundle\Entity
 * @ORM\Table(name="city")
 * @ORM\Entity()
 */
class CityEnum
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="CountryEnum", inversedBy="cities")
     */
    protected $country;

    /**
     * @var string
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\User", mappedBy="city", cascade={"persist"})
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return CityEnum
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
     * Set country
     *
     * @param CountryEnum $country
     *
     * @return CityEnum
     */
    public function setCountry(CountryEnum $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return CountryEnum
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return CityEnum
     */
    public function addUser(User $user)
    {
        $user->setCity($this);
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
}
