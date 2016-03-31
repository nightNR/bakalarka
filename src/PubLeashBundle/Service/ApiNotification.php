<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/31/16
 * Time: 5:35 PM
 */

namespace PubLeashBundle\Service;


class ApiNotification extends AbstractApiService
{

    public function getName()
    {
        return 'notifications';
    }

    public function notifications() {

        $user = $this->getUser();

        $data = [
            'pending-authorship' => $user->getPendingAuthorshipRequests()->count(),
            'pending-authorization' => $user->getPendingAuthorizationRequests()->count()
        ];
        $sum = 0;
        foreach($data as $value) {
            $sum += $value;
        }

        $data['pending-notification'] = $sum;
        return $data;
    }

}