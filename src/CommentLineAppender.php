<?php
namespace DicDoc;

/**
 * Class CommentLineAppender
 *
 * @package DicDoc
 */
class CommentLineAppender implements Interfaces\TextFileManipulator
{

    /**
     * @param $filePath
     * @param $text
     * @param $position
     *
     * @return bool
     */
    public function insertComment($filePath, $text, $position)
    {
        $reading = @fopen($filePath, 'r');
        if (!$reading) {
            return false;
        }
        $tempFilePath = tempnam(sys_get_temp_dir(), 'DIC');
        $writing = fopen($tempFilePath, 'w');
        $replaced = false;
        $i = 1;
        while (!feof($reading)) {
            $line = fgets($reading);
            if ($position == $i++) {
                $ident = "";
                if (preg_match('/^(\s*|\t*)/', $line, $matches)) {
                    $ident = $matches[1];
                }
                fputs($writing, $ident.$text."\n");
                $line = preg_replace('/^(.*)?dd\((.*)\)(.*)?/', "$1$2$3", $line);
                $replaced = true;
            }
            fputs($writing, $line);
        }
        fclose($reading);
        fclose($writing);

        if ($replaced) {
            return rename($tempFilePath, $filePath);
        } else {
            unlink($tempFilePath);

            return false;
        }
    }

}