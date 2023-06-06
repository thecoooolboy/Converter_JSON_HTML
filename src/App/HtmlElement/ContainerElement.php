<?php

namespace App\HtmlElement;

use App\DTO\PageElement;
use App\ElementConverter\ElementConverter;

final class ContainerElement
{
    public function __construct(
        private readonly PageElement $pageElement
    ) {
    }

    public function render(ElementConverter $converter): string
    {
        $html = '<div';

        if (!empty($this->pageElement->getParameters())) {
            $html .= ' style="';
            foreach ($this->pageElement->getParameters() as $key => $value) {
                $html .= $key . ':' . $value . ';';
            }
            $html .= '"';
        }

        $html .= '>';

        if (!empty($this->pageElement->getPayload())) {
            if (isset($this->pageElement->getPayload()['text'])) {
                $html .= '<h1>' . $this->pageElement->getPayload()['text'] . '</h1>';
            }
        }

        foreach ($this->pageElement->getChildren() as $child) {
            $child = new PageElement(
                type: $child['type'],
                payload: $child['payload'] ?? [],
                parameters: $child['parameters'] ?? [],
                children: $child['children'] ?? []
            );

            $html .= $converter->convertElements($child);
        }

        $html .= '</div>';

        return $html;
    }
}
