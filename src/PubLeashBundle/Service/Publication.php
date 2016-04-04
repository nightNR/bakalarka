<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.03.2016
 * Time: 17:25
 */

namespace PubLeashBundle\Service;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\Query\Expr\Orx;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PubLeashBundle\Entity\User;
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
     * Publication constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
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

    public function userIsOwner(\PubLeashBundle\Entity\Publication $publication) {
        if($user = $this->getUser()){
            return $publication->getOwners()->contains($user) || $publication->getAuthors()->contains($user);
        }
        return false;
    }

    public function isAllowedToWriteReview(\PubLeashBundle\Entity\Publication $publication) {
        $user = $this->getUser();
        $criteria = Criteria::create()->where(Criteria::expr()->eq('author', $user));
        return $publication->getAuthors()->contains($user) || ( $publication->getOwners()->contains($user) && $publication->getReviews()->matching($criteria)->isEmpty());
    }

    /**
     * @return null|User
     */
    protected function getUser() {
        $user = $this->tokenStorage->getToken()->getUser();
        return ($user instanceof User)?$user:null;
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