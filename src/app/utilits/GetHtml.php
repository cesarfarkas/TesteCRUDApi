<?php
namespace TesteCrudApi\App\Utilits;

class GetHtml
{
    static public string $getHtmlPathFile;

    /**
     * Check if file html exists
     */
    private function checkFileExists(): bool
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