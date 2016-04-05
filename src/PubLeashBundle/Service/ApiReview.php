<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 4.4.2016
 * Time: 23:33
 */

namespace PubLeashBundle\Service;

use PubLeashBundle\Entity;

class ApiReview extends AbstractApiService
{

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    public function __construct(\Twig_Environment $twig, $em)
    {
        $this->twig = $twig;
        parent::__construct($em);
    }


    public function getName()
    {
        return 'review';
    }

    public function add($id, $type, $reviewId, $data) {
        $user = $this->getUser();

        $referencedReview = null;
        $chapter = null;
        if($type == 'publication') {
            if(($publication = $this->em->getRepository(Entity\Publication::class)->find($id)) == null) {
                return ['message' => 'Publication with ID '. $id . 'does not exist.', 'code' => 400];
            }
        } else {
            if(($chapter = $this->em->getRepository(Entity\Chapter::class)->find($id)) == null ) {
                return ['message' => 'Chapter with ID '. $id . ' does not exist.', 'code' => 400];
            }
            $publication = $chapter->getPublication();
        }

        if(is_numeric($reviewId)) {
            $referencedReview = $this->em->getRepository(Entity\Review::class)->find($reviewId);
        }

        $review = new Entity\Review();
        $review->setAuthor($user);
        $review->setPublication($publication);
        $review->setChapter($chapter);
        $review->setText($data);
        $review->setReview($referencedReview);

        $this->em->persist($review);

        return [
            'message' => 'Review has been added successfully.',
            'code' => 200,
            'data' => [
                'rendered_review' => $this->twig->render('PubLeashBundle:Review:review.html.twig', ['data' => $review, 'type' => $referencedReview?'subreview':'review'])
            ]
        ];
    }
}