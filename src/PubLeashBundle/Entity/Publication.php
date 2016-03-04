<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 4:14 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity\Traits\DateUpdateTrait;

/**
 * Class Publication
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Publication
{
    use DateUpdateTrait;

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\LanguageEnum", inversedBy="publications")
     */
    protected $language;

    /**
     * @var
     * @ORM\ManyToMany(targetEntity="PubLeashBundle\Entity\User", mappedBy="publications")
     */
    protected $authors;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Chapter", mappedBy="publication")
     */
    protected $chapters;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Review", mappedBy="publication")
     */
    protected $reviews;


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
     * Set title
     *
     * @param string $title
     *
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publication
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set language
     *
     * @param LanguageEnum $language
     *
     * @return Publication
     */
    public function setLanguage(LanguageEnum $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return LanguageEnum
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
