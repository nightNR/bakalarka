<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/21/16
 * Time: 5:10 PM
 */

namespace PubLeashBundle\Service;


use PubLeashBundle\Entity\User;

class Notification
{
    public function getUserPendingAuthorshipRequestCount(User $user) {
        return $user->getPendingAuthorshipRequests()->count();
    }

    public function getAllUserNotificationCount(User $user) {

        return $this->getUserPendingAuthorshipRequestCount($user);
    }
}