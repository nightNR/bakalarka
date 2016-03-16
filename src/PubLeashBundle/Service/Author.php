<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 15.3.2016
 * Time: 22:16
 */

namespace PubLeashBundle\Service;


use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use PubLeashBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Author
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
     * Author constructor.
     * @param EntityManager $em
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function getAvailableAuthors() {
        /**
         * @var User $user
         */
        $user = $this->tokenStorage->getToken()->getUser();

        $queryBuilder = $users = $this->em->getRepository(User::class)->createQueryBuilder('u');

        $queryBuilder->select('u.id, u.username')/*->where('u.id != :user_id')->setParameter('user_id', $user->getId())*/;

        $users = $queryBuilder->getQuery()->execute();

        return $users;
    }


}