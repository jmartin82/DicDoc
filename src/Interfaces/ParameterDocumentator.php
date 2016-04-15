<?php
namespace DicDoc\Interfaces;

interface ParameterDocumentator
{
    public function docBlock(\DicDoc\ParameterInformation $parameter);
}