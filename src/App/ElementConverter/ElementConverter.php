<?php

namespace App\ElementConverter;

use App\BlockElement\BlockElement;
use App\ButtonElement\ButtonElement;
use App\ContainerElement\ContainerElement;
use App\ImageElement\ImageElement;
use App\TextElement\TextElement;

class ElementConverter
{
    private string $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    public function convert(): string
    {
        $elements = json_decode($this->json, true);

        return $this->convertElement($elements);
    }

    private function convertElement($element): string
    {
        $html = '';

        if (isset($element['type'])) {
            switch ($element['type']) {
                case 'container':
                    $container = new ContainerElement($element);
                    $html .= $container->render();
                    break;
                case 'block':
                    $block = new BlockElement($element);
                    $html .= $block->render();
                    break;
                case 'text':
                    $text = new TextElement($element);
                    $html .= $text->render();
                    break;
                case 'image':
                    $image = new ImageElement($element);
                    $html .= $image->render();
                    break;
                case 'button':
                    $button = new ButtonElement($element);
                    $html .= $button->render();
                    break;
            }
        }

        if (!empty($element['children'])) {
            foreach ($element['children'] as $child) {
                $html .= $this->convertElement($child);
            }
        }

        return $html;
    }
}

