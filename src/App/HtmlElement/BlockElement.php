<?php

namespace App\HtmlElement;

use App\DTO\PageElement;
use App\ElementConverter\ElementConverter;

final class BlockElement
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
            if (isset($this->pageElement->getParameters()['textAlign'])) {
                $html .= 'text-align' . ':' . $this->pageElement->getParameters()['textAlign'] . ';';
            }

            $html .= '"';
        }

        $html .= '>';

        if (!empty($this->pageElement->getPayload())) {
            if (isset($this->pageElement->getPayload()['text'])) {
                $html .= '<p>' . $this->pageElement->getPayload()['text'] . '</p>';
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
