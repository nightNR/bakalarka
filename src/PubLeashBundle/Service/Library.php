<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/31/16
 * Time: 5:00 PM
 */

namespace PubLeashBundle\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PubLeashBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Library
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
     * Library constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function getLibraryEntries($page, $limit = 5) {
        $user = $this->getUser();
        $repository = $this->em->getRepository(\PubLeashBundle\Entity\LibraryEntry::class);
        $queryBuilder = $repository->createQueryBuilder('l')->orderBy('l.dateCreate', 'DESC');
        $queryBuilder->where('l.user = :user');
        $queryBuilder->setParameter('user', $user);
        return $this->paginate($queryBuilder, $page, $limit);
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

    protected function getUser() {
        $user = $this->tokenStorage->getToken()->getUser();
        return ($user instanceof User)?$user:null;
    }

}