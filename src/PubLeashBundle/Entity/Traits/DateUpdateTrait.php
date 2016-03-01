<?php
/**
 * Created by PhpStorm.
 * User: pbalaz
 * Date: 2/18/16
 * Time: 4:32 PM
 */

namespace PubLeashBundle\Entity\Traits;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

trait DateUpdateTrait
{


    /**
     * @var
     * @ORM\Column(name="date_create", type="datetime")
     */
    protected $dateCreate;

    /**
     * @var
     * @ORM\Column(name="date_update", type="datetime")
     */
    protected $dateUpdate;

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->dateCreate = new \DateTime();
        $this->dateUpdate = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate(PreUpdateEventArgs $args) {
        $this->dateUpdate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @param mixed $dateCreate
     * @return DateUpdateTrait
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     * @return DateUpdateTrait
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
        return $this;
    }


}