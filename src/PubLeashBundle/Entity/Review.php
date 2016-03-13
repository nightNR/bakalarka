<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 4:54 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Review
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table(name="review")
 * @ORM\Entity()
 */
class Review
{
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
     * @ORM\Column(name="rank", type="smallint")
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


}