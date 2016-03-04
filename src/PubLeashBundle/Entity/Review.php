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
}