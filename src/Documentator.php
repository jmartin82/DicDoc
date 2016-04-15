<?php
namespace DicDoc;

/**
 * Class Documentator
 *
 * @package DicDoc
 */
class Documentator
{

    /**
     * @var Interfaces\ParameterDocumentator
     */
    private $parameterCommentGenerator;

    /**
     * @var Interfaces\TextFileManipulator
     */
    private $commentAppender;


    /**
     * Documentator constructor.
     *
     * @param Interfaces\TextFileManipulator   $commentAppender
     * @param Interfaces\ParameterDocumentator $parameterCommentGenerator
     */
    public function __construct(
        Interfaces\TextFileManipulator $commentAppender,
        Interfaces\ParameterDocumentator $parameterCommentGenerator
    ) {


        $this->commentAppender = $commentAppender;
        $this->parameterCommentGenerator = $parameterCommentGenerator;
    }

    /**
     * @param ParameterInformation $parameterInformation
     * @param CallerPosition       $callerData
     * @param                      $offset
     */
    public function document(ParameterInformation $parameterInformation, CallerPosition $callerData, $offset)
    {
        $docBlock = $this->parameterCommentGenerator->docBlock($parameterInformation);
        $this->commentAppender->insertComment($callerData->getFile(), $docBlock, $callerData->getLine() + $offset);
    }

}