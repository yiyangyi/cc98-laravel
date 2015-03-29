<?php namespace App\Services;

use Parsedown;

class Markdown {

    protected $parsedown;

    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }

    public function convertHtmlToMarkdown($html)
    {

    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertedHtml = $this->parsedown->text($markdown);
        return $convertedHtml;
    }

}




