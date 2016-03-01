<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 5:38 PM
 */

namespace PubLeashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Chapter
 * @package PubLeashBundle\Entity
 *
 * @ORM\Table("chapter")
 * @ORM\Entity()
 */
class Chapter
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
}