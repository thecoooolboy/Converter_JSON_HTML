<?php

namespace App\ElementConverter;

use App\Enum\HtmlElementsEnum;
use App\HtmlElements\BlockElement;
use App\HtmlElements\ButtonElement;
use App\HtmlElements\ContainerElement;
use App\HtmlElements\ImageElement;
use App\HtmlElements\TextElement;

class ElementConverter
{
    private string $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    public function convert(): string
    {
        $pageElements = json_decode($this->json, true);
        
        return $this->convertElement($pageElements);
    }

    public function convertElement(?array $pageElements): string
    {
        $html = '';

        if (isset($pageElements['type'])) {
            switch ($pageElements['type']) {
                case HtmlElementsEnum::CONTAINER->value:
                    $pageElements = new ContainerElement($pageElements);
                    break;
                case HtmlElementsEnum::BLOCK->value:
                    $pageElements = new BlockElement($pageElements);
                    break;
                case HtmlElementsEnum::TEXT->value:
                    $pageElements = new TextElement($pageElements);
                    break;
                case HtmlElementsEnum::IMAGE->value:
                    $pageElements = new ImageElement($pageElements);
                    break;
                case HtmlElementsEnum::BUTTON->value:
                    $pageElements = new ButtonElement($pageElements);
                    break;
            }
            $html .= $pageElements?->render($this);
        }

        return $html;
    }
}

