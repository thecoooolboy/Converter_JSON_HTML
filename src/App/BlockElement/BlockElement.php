<?php

namespace App\BlockElement;

use App\ElementConverter\ElementConverter;

class BlockElement
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
            if (isset($this->parameters['textAlign'])) {
                $html .= 'text-align' . ':' . $this->parameters['textAlign'] . ';';
            }
            $html .= '"';
        }

        $html .= '>';

        if (!empty($this->payload)) {
            if (isset($this->payload['text'])) {
                $html .= '<p>' . $this->payload['text'] . '</p>';
            }
        }

        foreach ($this->children as $child) {
            $html .= (new ElementConverter(json_encode([$child])))->convert();
        }

        $html .= '</div>';

        return $html;
    }
}