<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

// Include the highlighter class
use Highlight\Highlighter;

class HighLightCustom extends AbstractExtension
{
    protected $highlighter;

    public function getFilters()
    {
        // nom de l'extension
        return array(
            new TwigFilter('highlightCode', array($this, 'highlightCode')),
        );
    }
    public function __construct(){
        $this->highlighter = new Highlighter();
    }

    public function highlightCode($code, $language){
        // Create highlight object
        $result = $this->highlighter->highlight($language, $code);

        // Return ready to render markup
        return   "<pre>"
                    ."<code class=\"hljs {$result->language}\">{$result->value}</code>"
                ."</pre>";
    }
    public function getName()
    {
        return 'TwigExtensions';
    }

}

?>