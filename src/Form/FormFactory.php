<?php

namespace BackTo95\Form;

use BackTo95\Fields\Entity\EntityConfiguration;
use Exception;

abstract class FormFactory
{
    protected $entityConfiguration;

    public function __construct(EntityConfiguration $entityConfiguration)
    {
        $this->entityConfiguration;
    }

    protected function getEntityConfiguration() : EntityConfiguration
    {
        return $this->entityConfiguration;
    }

    public function getForm()
    {
        throw new Exception("You need to override this method in your extending class!");
    }
}
