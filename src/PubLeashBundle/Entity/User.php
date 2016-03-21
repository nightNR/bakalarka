<?php

namespace PubLeashBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string")
     */
    protected $firstName;

    /**
     * @var string
     * @ORM\Column(name="last_name", type="string")
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="address", type="string")
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="city", type="string")
     */
    protected $city;

    /**
     * @var int
     * @ORM\Column(name="country", type="string", length=6)
     */
    protected $country;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\LanguageEnum", inversedBy="users")
     */
    protected $language;

    /**
     * @var ArrayCollection <PublicationXAuthor>
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\PublicationXAuthor", mappedBy="user")
     */
    protected $userPublicationReference;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Review", mappedBy="author")
     */
    protected $reviews;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->userPublicationReference = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        parent::__construct();
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param \PubLeashBundle\Entity\CityEnum $city
     *
     * @return User
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \PubLeashBundle\Entity\CityEnum
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param \PubLeashBundle\Entity\CountryEnum $country
     *
     * @return User
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \PubLeashBundle\Entity\CountryEnum
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language
     *
     * @param \PubLeashBundle\Entity\LanguageEnum $language
     *
     * @return User
     */
    public function setLanguage(\PubLeashBundle\Entity\LanguageEnum $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \PubLeashBundle\Entity\LanguageEnum
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get publications
     *
     * @return ArrayCollection <Publication>
     */
    public function getPublications($validOnly = false)
    {
        $ret = new ArrayCollection();
        /** @var PublicationXAuthor $publicationReference */
        foreach($this->userPublicationReference as $publicationReference) {
            if(!$validOnly || $publicationReference->getIsValid()){
                $ret[] = $publicationReference->getPublication();
            }
        }
        return $ret;
    }

    /**
     * Add review
     *
     * @param \PubLeashBundle\Entity\Review $review
     *
     * @return User
     */
    public function addReview(\PubLeashBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \PubLeashBundle\Entity\Review $review
     */
    public function removeReview(\PubLeashBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add userPublicationReference
     *
     * @param \PubLeashBundle\Entity\PublicationXAuthor $userPublicationReference
     *
     * @return User
     */
    public function addUserPublicationReference(\PubLeashBundle\Entity\PublicationXAuthor $userPublicationReference)
    {
        $this->userPublicationReference[] = $userPublicationReference;

        return $this;
    }

    /**
     * Remove userPublicationReference
     *
     * @param \PubLeashBundle\Entity\PublicationXAuthor $userPublicationReference
     */
    public function removeUserPublicationReference(\PubLeashBundle\Entity\PublicationXAuthor $userPublicationReference)
    {
        $this->userPublicationReference->removeElement($userPublicationReference);
    }

    /**
     * Get userPublicationReference
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserPublicationReference()
    {
        return $this->userPublicationReference;
    }
}
