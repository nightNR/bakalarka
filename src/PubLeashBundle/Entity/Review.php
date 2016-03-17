<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 4:54 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity\Traits\DateUpdateTrait;

/**
 * Class Review
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="review")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Review
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
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Publication", inversedBy="reviews")
     */
    protected $publication;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Chapter", inversedBy="reviews")
     */
    protected $chapter;

    /**
     * @var
     * @ORM\Column(name="text", type="string", length=255)
     */
    protected $text;

    /**
     * @var
     * @ORM\Column(name="rank", type="decimal", precision=2, scale=1)
     */
    protected $rank;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Review", inversedBy="reviews")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $review;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Review", mappedBy="review")
     */
    protected $reviews;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\User", inversedBy="reviews")
     */
    protected $author;

    /**
     * @var
     * @ORM\Column(name="is_hidden", type="boolean")
     */
    protected $isHidden;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * @param mixed $publication
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;
    }

    /**
     * @return mixed
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param mixed $chapter
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set isHidden
     *
     * @param boolean $isHidden
     *
     * @return Review
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get isHidden
     *
     * @return boolean
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * Add review
     *
     * @param \PubLeashBundle\Entity\Review $review
     *
     * @return Review
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
}
