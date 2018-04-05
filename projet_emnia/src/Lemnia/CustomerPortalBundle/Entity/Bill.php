<?php

namespace Lemnia\CustomerPortalBundle\Entity;


class Bill
{

    private $id;

    private $service;

    private $reference;


    private $date;

    private $state;

    private $amount;

    private $user;

    public function getId()
    {
        return $this->id;
    }
}
