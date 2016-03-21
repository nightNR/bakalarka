<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 4:14 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use PubLeashBundle\Entity\Traits\DateUpdateTrait;
use Symfony\Component\Validator\Constraints\Type;

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
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\PublicationXAuthor", mappedBy="publication", cascade={"persist","remove"}, orphanRemoval=true)
     */
    protected $userPublicationReference;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Chapter", mappedBy="publication")
     */
    protected $chapters;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PubLeashBundle\Entity\Review", mappedBy="publication")
     */
    protected $reviews;

    /**
     * @var
     * @ORM\Column(name="is_published", type="boolean", options={"default": 0})
     */
    protected $isPublished = 0;

    /**
     * @var
     * @ORM\Column(name="date_delete", type="datetime", nullable=true)
     */
    protected $dateDelete;
    
    /**
     * @return mixed
     */
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * @param mixed $chapters
     */
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        $criteria = Criteria::create()->where(Criteria::expr()->eq('isHidden', false));
        $criteria->andWhere(Criteria::expr()->isNull('review'));
        return $this->reviews->matching($criteria);
    }

    /**
     * @return ArrayCollection
     * @param mixed $reviews
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * @param bool $validOnly
     * @return ArrayCollection <User>
     */
    public function getAuthors($validOnly = false)
    {
        $ret = new ArrayCollection();
        /** @var PublicationXAuthor $publicationReference */
        foreach($this->userPublicationReference as $publicationReference) {
            if(!$validOnly || $publicationReference->getIsValid()){
                $ret[] = $publicationReference->getUser();
            }
        }
        return $ret;
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


    public function computeIsPublished()
    {
        $chapters = $this->getChapters();
        /**
         * @var Chapter $chapter
         */
        foreach ($chapters as $chapter) {
            if ($chapter->getIsPublished()) return true;
        }
        return false;
    }

    public function getPrettyUrlTitle()
    {

        return strtolower(preg_replace('/\s{1,}/', '-', preg_replace('/[^a-zA-Z0-9\s.]/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $this->title))));
    }

    public function delete()
    {
        $this->dateDelete = new \DateTime();
    }

    public function isDeleted()
    {
        return $this->dateDelete == null;
    }

    public function getRank()
    {
        $reviews = $this->getReviews();
        /**
         * @var Review $review
         */
        $sum = 0;
        $count = 0;
        foreach ($reviews as $review) {
            if (empty($review->getReview())) {
                $sum += 2 * $review->getRank();
                $count++;
            }
        }
        return $count ? ((ceil($sum / $count)) / 2) : 0;
    }


    /**
     * Set dateDelete
     *
     * @param \DateTime $dateDelete
     *
     * @return Publication
     */
    public function setDateDelete($dateDelete)
    {
        $this->dateDelete = $dateDelete;

        return $this;
    }

    /**
     * Get dateDelete
     *
     * @return \DateTime
     */
    public function getDateDelete()
    {
        return $this->dateDelete;
    }

    /**
     * Add chapter
     *
     * @param Chapter $chapter
     *
     * @return Publication
     */
    public function addChapter(Chapter $chapter)
    {
        $this->chapters[] = $chapter;

        return $this;
    }

    /**
     * Remove chapter
     *
     * @param Chapter $chapter
     */
    public function removeChapter(Chapter $chapter)
    {
        $this->chapters->removeElement($chapter);
    }

    /**
     * Add review
     *
     * @param Review $review
     *
     * @return Publication
     */
    public function addReview(Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param Review $review
     */
    public function removeReview(Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userPublicationReference = new ArrayCollection();
        $this->chapters = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }


    /**
     * Add userPublicationReference
     *
     * @param \PubLeashBundle\Entity\PublicationXAuthor $userPublicationReference
     *
     * @return Publication
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

    public function removeAuthor(User $author) {
        /** @var PublicationXAuthor $userReference */
        foreach($this->userPublicationReference as $userReference) {
            if($userReference->getUser() == $author) {
                $this->userPublicationReference->removeElement($userReference);
            }
        }
        return $this;
    }

    public function addAuthor(User $author) {
        /** @var PublicationXAuthor $userReference */
        foreach($this->userPublicationReference as $userReference) {
            if($userReference->getUser() == $author) {
                return $this;
            }
        }
        $this->userPublicationReference[] = new PublicationXAuthor($author, $this);
        return $this;
    }
}
