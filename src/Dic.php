<?php
namespace DicDoc;


use DicDoc\Interfaces\CallerPositionFinder;

/**
 * Class Dic
 *
 * @package DicDoc
 */
class Dic
{

    /**
     * @var CallerPositionFinder
     */
    public $callerFinder;
    /**
     * @var array
     */
    public static $fileOffset = [];
    /**
     * @var Documentator
     */
    public static $documentator;

    /**
     * Dic constructor.
     *
     * @param CallerPositionFinder $callerFinder
     * @param Documentator         $documentator
     */
    public function __construct(CallerPositionFinder $callerFinder, Documentator $documentator)
    {
        $this->callerFinder = $callerFinder;
        self::$documentator = $documentator;
    }

    /**
     * @param $param
     */
    public function doc($param)
    {
        $callerPosition = $this->callerFinder->getCallerPosition();
        $filePath = $callerPosition->getFile();
        isset(self::$fileOffset[$filePath]) ? self::$fileOffset[$filePath]++ : self::$fileOffset[$filePath] = 0;
        register_shutdown_function(
            [DIC::class, 'appendComment'],
            new ParameterInformation($param),
            $callerPosition,
            self::$fileOffset[$filePath]
        );
    }

    /**
     * @param ParameterInformation $parameterInformation
     * @param CallerPosition       $callerPosition
     * @param                      $offset
     */
    public static function appendComment(
        ParameterInformation $parameterInformation,
        CallerPosition $callerPosition,
        $offset
    ) {
        self::$documentator->document($parameterInformation, $callerPosition, $offset);
    }
}