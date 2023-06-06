<?php

namespace App\HtmlElement;

use App\DTO\PageElement;

final class TextElement
{
    public function __construct(
        private readonly PageElement $pageElement
    ) {
    }

    public function render(): string
    {
        $html = '<p';

        if (!empty($this->pageElement->getParameters())) {
            $html .= ' style="';

            if (isset($this->pageElement->getParameters()['fontSize'])) {
                $html .= 'font-size' . ':' . $this->pageElement->getParameters()['fontSize'] . ';';
            }
            if (isset($this->pageElement->getParameters()['textAlign'])) {
                $html .= 'text-align' . ':' . $this->pageElement->getParameters()['textAlign'] . ';';
            }

            $html .= '"';
        }

        $html .= '>';

        $html .= $this->pageElement->getPayload()['text'];

        $html .= '</p>';

        return $html;
    }
}
