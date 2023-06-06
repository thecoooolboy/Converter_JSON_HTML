<?php

namespace App\HtmlElements;

use App\ElementConverter\ElementConverter;

class BlockElement
{
    private array $payload;
    private array $parameters;
    private array $children;

    public function __construct(array $data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
        $this->children = $data['children'] ?? [];
    }

    public function render(ElementConverter $converter): string
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
            $html .= $converter->convertElement($child);
        }

        $html .= '</div>';

        return $html;
    }
}