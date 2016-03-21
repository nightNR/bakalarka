<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 20.3.2016
 * Time: 16:11
 */

namespace PubLeashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\BooleanNode;

/**
 * Class PublicationXAuthor
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="user_publication")
 * @ORM\Entity()
 */
class PublicationXAuthor
{

    /**
     * @var User
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\User", inversedBy="userPublicationReference")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Publication
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Publication", inversedBy="userPublicationReference")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * @var Boolean
     *
     * @ORM\Column(name="is_valid", type="boolean", options={"default": 0})
     */
    private $isValid = 0;

    /**
     * PublicationXAuthor constructor.
     * @param User $user
     * @param Publication $publication
     */
    public function __construct(User $user, Publication $publication)
    {
        $this->user = $user;
        $this->publication = $publication;
    }


    /**
     * Set user
     *
     * @param integer $user
     *
     * @return PublicationXAuthor
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set publication
     *
     * @param integer $publication
     *
     * @return PublicationXAuthor
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return integer
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set isValid
     *
     * @param boolean $isValid
     *
     * @return PublicationXAuthor
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean
     */
    public function getIsValid()
    {
        return $this->isValid;
    }
}
