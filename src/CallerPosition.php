<?php
namespace DicDoc;

/**
 * Class CallerPosition
 *
 * @package DicDoc
 */
class CallerPosition
{

    /**
     * @var
     */
    public $file;
    /**
     * @var
     */
    public $line;
   
    /**
     * CallerPosition constructor.
     *
     * @param $file
     * @param $line
     */
    public function __construct($file, $line)
    {
        $this->file = $file;
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getLine()
    {
        return $this->line;
    }

}