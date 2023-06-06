<?php

namespace App\HtmlElement;

use App\DTO\PageElement;

final class ImageElement
{
    public function __construct(
        private readonly PageElement $pageElement
    ) {
    }

    public function render(): string
    {
        $html = '<img src="' . $this->pageElement->getPayload()['image']['url'] . '" ';
        $id = $this->pageElement->getPayload()['image']['id'];

        if (isset($this->pageElement->getPayload()['image']['id'])) {
            $html .= 'id= ' . $id . " ";
        }

        if (isset($this->pageElement->getPayload()['image']['meta'])) {
            foreach ($this->pageElement->getPayload()['image']['meta'] as $key => $value) {
                $html .= $key . '=' . "'$value' ";
            }
        }

        if (!empty($this->pageElement->getParameters())) {
            $html .= ' style="';
            foreach ($this->pageElement->getParameters() as $key => $value) {
                $html .= $key . ':' . "'$value'" . ';';
            }
            $html .= '"';
        }

        $html .= '>';

        return $html;
    }
}
