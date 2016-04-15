<?php
namespace DicDoc;

use DicDoc\Exceptions\CallerResolverException;

/**
 * Class BackTraceCallerPositionFinder
 *
 * @package DicDoc
 */
class BackTraceCallerPositionFinder implements Interfaces\CallerPositionFinder
{
    /**
     * @var int
     */
    private $deep;

    /**
     * BackTraceCallerPositionFinder constructor.
     *
     * @param int $deep
     */
    public function __construct($deep = 4)
    {

        $this->deep = $deep;
    }


    /**
     * @return CallerPosition
     * @throws Exceptions\CallerResolverException
     */
    public function getCallerPosition()
    {
        $caller = $this->findCaller();

        return new CallerPosition($caller['file'], $caller['line']);
    }

    /**
     * @return mixed
     * @throws Exceptions\CallerResolverException
     */
    public function findCaller()
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $this->deep);
        foreach ($bt as $call) {
            if (!isset($call['class']) || strpos($call['class'], __NAMESPACE__) === false) {
                return $call;
            }
        }

        throw new CallerResolverException("Error finding the caller");
    }
}