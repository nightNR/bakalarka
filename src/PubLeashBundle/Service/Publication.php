<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.03.2016
 * Time: 17:25
 */

namespace PubLeashBundle\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PubLeashBundle\Entity;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Publication
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var ApiRating;
     */
    private $apiRatingService;

    /**
     * Publication constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     * @param ApiRating $apiRating
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage, ApiRating $apiRating)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
        $this->apiRatingService = $apiRating;
    }

    /**
     * @param int $page
     * @return Paginator
     */
    public function getPublications($page = 1, $limit = 5) {
        $repository = $this->em->getRepository(\PubLeashBundle\Entity\Publication::class);
        $queryBuilder = $repository->createQueryBuilder('p')->orderBy('p.dateCreate', 'DESC');
        $queryBuilder->where('p.dateDelete is null');
        return $this->paginate($queryBuilder, $page, $limit);
    }

    public function isAllowedDelete(\PubLeashBundle\Entity\Publication $publication) {
        if($user = $this->getUser()){
            return $publication->getAuthors()->contains($user) || $user->hasRole('ROLE_ADMIN');
        }
        return false;
    }

    public function isAllowedEdit(\PubLeashBundle\Entity\Publication $publication) {
        if($user = $this->getUser()){
            return $publication->getAuthors()->contains($user);
        }
        return false;
    }

    public function isAllowedShow(\PubLeashBundle\Entity\Publication $publication) {
        return true;
    }

    public function userIsOwnerByPublicationId($publicationId, $authorized = true) {
        $publication = $this->em->getRepository(Entity\Publication::class)->find($publicationId);
        return $this->userIsOwner($publication, $authorized);
    }

    public function userIsOwner(\PubLeashBundle\Entity\Publication $publication, $authorized = true) {
        if($user = $this->getUser()){
            return $publication->getOwners($authorized)->contains($user) || $publication->getAuthors()->contains($user);
        }
        return false;
    }

    public function hasUserRatedByPublicationId($publicationId) {
        $publication = $this->em->getRepository(Entity\Publication::class)->find($publicationId);
        return $this->hasUserRated($publication);
    }

    public function hasUserRated(\PubLeashBundle\Entity\Publication $publication) {
        $user = $this->getUser();
        return $this->apiRatingService->getRating($user, $publication) != null;
    }

    /**
     * @return null|Entity\User
     */
    protected function getUser() {
        $user = $this->tokenStorage->getToken()->getUser();
        return ($user instanceof Entity\User)?$user:null;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    protected function paginate(QueryBuilder $queryBuilder, $page = 1, $limit = 5) {
        $paginator = new Paginator($queryBuilder);
        $paginator->getQuery()
            ->setFirstResult($limit * ($page -1 ))
            ->setMaxResults($limit);
        return $paginator;
    }
}