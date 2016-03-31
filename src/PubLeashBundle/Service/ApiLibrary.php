<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 3/31/16
 * Time: 6:06 PM
 */

namespace PubLeashBundle\Service;


use PubLeashBundle\Entity\LibraryEntry;

class ApiLibrary extends AbstractApiService
{

    public function getName()
    {
        return 'library';
    }

    public function authorize($requestId) {

        if(($user = $this->getUser()) === null) {
            return ['message' => 'User need to be logged in', 'code' => 400];
        }
        if(($request = $this->em->getRepository(LibraryEntry::class)->find($requestId)) === null) {
            return ['message' => 'Library entry with ID '. $requestId . 'does not exist.', 'code' => 400];
        }
        if($request->getIsAuthorized()) {
            return ['message' => 'Library entry with ID '. $requestId . ' is already authorized.', 'code' => 400];
        }
        if(!$request->getPublication()->getAuthors()->contains($user)) {
            return ['message' => 'User '. $user->getUsername(). ' ('.$user->getId().') is not author of this publication.', 'code' => 400];
        }
        $request->setIsAuthorized(true);
        return ['message' => 'Read permission granted for user '.$request->getUser()->getUsername(), 'code' => 200];
    }
}