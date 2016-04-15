<?php

if (!function_exists('dd')) {

    /**
     * @param $param
     *
     * @return mixed
     */
    function dd($param)
    {
        $callerFinder = new \DicDoc\BackTraceCallerPositionFinder();
        $documentator = new \DicDoc\Documentator(
            new \DicDoc\CommentLineAppender(),
            new \DicDoc\ParameterCommentGenerator()
        );

        $dic = new DicDoc\Dic($callerFinder, $documentator);
        $dic->doc($param);

        return $param;
    }
}