<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DicDoc;


/**
 * Class ParameterCommentGenerator
 *
 * @package DicDoc
 */
class ParameterCommentGenerator implements Interfaces\ParameterDocumentator
{
    /**
     * @var ParameterInformation
     */
    private $parameter;


    /**
     * @param ParameterInformation $parameter
     *
     * @return string
     */
    public function docBlock(ParameterInformation $parameter)
    {
        $this->parameter = $parameter;

        if (!$parameter->isObject()) {
            return $this->documentPrimitive();
        }

        if (empty($parameter->getImplements())) {
            return $this->documentClass();
        }

        return $this->documentInterfaces();
    }

    private function getVarNameProposal()
    {
        return lcfirst($this->parameter->getShortClassName());
    }

    private function documentPrimitive()
    {
        return "/** @var ".$this->parameter->getType()." */";
    }

    private function documentClass()
    {
        return "/** @var \\".$this->parameter->getClassName()." \$".$this->getVarNameProposal()." */";
    }

    private function documentInterfaces()
    {
        return "/** @var \\".implode("|\\", $this->parameter->getImplements())." \$".$this->getVarNameProposal()." */";
    }

}
