<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 4/5/16
 * Time: 6:01 PM
 */

namespace PubLeashBundle\Service;

use PubLeashBundle\Entity;

class ApiRating extends AbstractApiService
{

    public function getName()
    {
        return 'rating';
    }

    public function add($rating, $publicationId) {
        $user = $this->getUser();

        if(($publication = $this->em->getRepository(Entity\Publication::class)->find($publicationId)) == null) {
            return ['message' => 'Publication with ID '. $publicationId . 'does not exist.', 'code' => 400];
        }

        if(($rank = $this->getRating($user, $publication)) != null) {
            return ['message' => 'User ' . $user->getUsername() . ' already rated this publication.', 'code' => 400];
        }

        $rank = new Entity\Rank();
        $rank->setPublication($publication);
        $publication->addRank($rank);
        $rank->setUser($user);
        $rank->setRank($rating);
        $this->em->persist($rank);

        return [
            'message' => 'Rating ha been added successfully.',
            'code' => 200,
            'data' => [
                'rating' => $publication->getRank(),
                'rated_message' => 'You have already rated'
            ]
        ];
    }

    public function getRating(Entity\User $user, Entity\Publication $publication) {
        return $this->em->getRepository(Entity\Rank::class)->find(['user' => $user, 'publication' => $publication]);
    }
}