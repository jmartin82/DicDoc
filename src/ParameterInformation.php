<?php
namespace DicDoc;

/**
 * Class ParameterInformation
 *
 * @package DicDoc
 */
class ParameterInformation
{

    /**
     * @var string
     */
    public $className;
    /**
     * @var string
     */
    public $shortClassName;
    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $implements = [];


    /**
     * ParameterInformation constructor.
     *
     * @param $param
     */
    public function __construct($param)
    {
        $this->type = gettype($param);
        if ($this->isObject()) {
            $this->className = get_class($param);
            $reflection = new \ReflectionClass($this->className);

            $this->shortClassName = $reflection->getShortName();

            foreach (class_implements($this->className) as $interface) {
                //I don't want framework interfaces
                if (explode("\\", $interface)[0] == explode("\\", $this->className)[0]) {
                    $this->implements[] = $interface;
                }
            }


        }

    }

    /**
     * @return array
     */
    public function getImplements()
    {
        return $this->implements;
    }

    /**
     * @return mixed
     */
    public function getShortClassName()
    {
        return $this->shortClassName;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    public function isObject()
    {
        return $this->type == "object";
    }

}