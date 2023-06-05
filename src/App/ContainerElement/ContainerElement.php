<?php

namespace App\ContainerElement;

use App\ElementConverter\ElementConverter;

class ContainerElement
{
    private array $payload;
    private array $parameters;
    private array $children;

    public function __construct($data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
        $this->children = $data['children'] ?? [];
    }

    public function render(): string
    {
        $html = '<div';

        if (!empty($this->parameters)) {
            $html .= ' style="';
            foreach ($this->parameters as $key => $value) {
                $html .= $key . ':' . $value . ';';
            }
            $html .= '"';
        }

        $html .= '>';

        if (!empty($this->payload)) {
            if (isset($this->payload['text'])) {
                $html .= '<h1>' . $this->payload['text'] . '</h1>';
            }
        }

        foreach ($this->children as $child) {
            $html .= (new ElementConverter(json_encode([$child])))->convert();
        }

        $html .= '</div>';

        return $html;
    }
}