<?php

namespace App\HtmlElement;

use App\DTO\PageElement;

final class ButtonElement
{
    public function __construct(
        private readonly PageElement $pageElement
    ) {
    }

    public function render(): string
    {
        $html = '<button';

        if (!empty($this->pageElement->getParameters())) {
            $html .= ' style="';
            foreach ($this->pageElement->getParameters() as $key => $value) {
                if ($key === 'textColor') {
                    $html .= 'text-color' . ':' . $value . ';';
                } elseif ($key === 'backgroundColor') {
                    $html .= 'background-color' . ':' . $value . ';';
                } else {
                    $html .= $key . ':' . $value . ';';
                }
            }
            $html .= '"';
        }

        $html .= '>';

        $html .= '<a href="' . $this->pageElement->getPayload()['link']['payload'] . '">' .
            $this->pageElement->getPayload()['text'] . '</a></button>';

        return $html;
    }
}
