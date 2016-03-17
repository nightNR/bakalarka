<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 5:38 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity\Traits\DateUpdateTrait;

/**
 * Class Chapter
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table("chapter")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Chapter
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
     * @ORM\ManyToOne(targetEntity="PubLeashBundle\Entity\Publication", inversedBy="chapters")
     */
    protected $publication;

    /**
     * @var
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    /**
     * @var
     * @ORM\Column(name="content", type="text")
     */
    protected $content;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Review", mappedBy="chapter")
     */
    protected $reviews;

    /**
     * @var
     * @ORM\Column(name="is_published", type="boolean", options={"default": false})
     */
    protected $isPublished;

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
     * @return Publication
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    public function getPreview() {
        return substr($this->content,0, strpos($this->content, "</p>")+4);
    }

    public function getRank() {
        $reviews = $this->getReviews();
        /**
         * @var Review $review
         */
        $sum = 0;
        $count = 0;
        foreach($reviews as $review) {
            if(empty($review->getReview())) {
                $sum += 2 * $review->getRank();
                $count++;
            }
        }
        return $count?((ceil($sum / $count)) / 2):0;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add review
     *
     * @param \PubLeashBundle\Entity\Review $review
     *
     * @return Chapter
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
