<?php

namespace App\ElementConverter;

use App\DTO\PageElement;
use App\Enum\HtmlElementEnum;
use App\HtmlElement\BlockElement;
use App\HtmlElement\ButtonElement;
use App\HtmlElement\ContainerElement;
use App\HtmlElement\ImageElement;
use App\HtmlElement\TextElement;
use ValueError;

final class ElementConverter
{
    private string $json;

    public function __construct(string $fileJsonPath)
    {
        $this->json = file_get_contents($fileJsonPath);
    }

    public function convert(): string
    {
        $pageElements = json_decode($this->json, true);

        try {
            $pageElement = new PageElement(
                type: $pageElements['type'] ?? null,
                payload: $pageElements['payload'] ?? [],
                parameters: $pageElements['parameters'] ?? [],
                children: $pageElements['children'] ?? []
            );
        } catch (ValueError) {
            return 'Некорректно заполненный JSON или ошибка пути файла';
        }

        return $this->convertElements($pageElement);
    }

    public function convertElements(PageElement $element): string
    {
        $html = '';

        switch ($element->getType()) {
            case HtmlElementEnum::CONTAINER:
                $element = new ContainerElement($element);
                break;
            case HtmlElementEnum::BLOCK:
                $element = new BlockElement($element);
                break;
            case HtmlElementEnum::TEXT:
                $element = new TextElement($element);
                break;
            case HtmlElementEnum::IMAGE:
                $element = new ImageElement($element);
                break;
            case HtmlElementEnum::BUTTON:
                $element = new ButtonElement($element);
                break;
        }

        $html .= $element->render($this);

        return $html;
    }
}
