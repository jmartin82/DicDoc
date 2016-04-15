<?php
namespace DicDoc\Interfaces;

interface TextFileManipulator
{
    public function insertComment($filePath, $text, $position);
}
