<?php
namespace TesteCrudApi\Utilits;

class GetHtml
{
    private static string $getHtmlPathFile;

    /**
     * Check if file html exists
     */
    static public function setHtmlPathFile($path): void
    {
        self::$getHtmlPathFile = $path;
    }

    /**
     * Check if file html exists
     */
    static private function checkFileExists()
    {
        return file_exists(self::$getHtmlPathFile);
    }

    /**
     * Return content html
     */
    static public function view(): string|bool
    {
        if(self::checkFileExists())
        {
            $contentHtml = file_get_contents(self::$getHtmlPathFile);
            return $contentHtml;
        }

        return false;
    }
}