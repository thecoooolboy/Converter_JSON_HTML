<?php

namespace App\TextElement;

class TextElement
{
    private array $payload;
    private array $parameters;

    public function __construct($data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
    }

    public function render(): string
    {
        $html = '<p';

        if (!empty($this->parameters)) {
            $html .= ' style="';

            if (isset($this->parameters['fontSize'])) {
                $html .= 'font-size' . ':' . $this->parameters['fontSize'] . ';';
            }
            if (isset($this->parameters['textAlign'])) {
                $html .= 'text-align' . ':' . $this->parameters['fontSize'] . ';';
            }

            $html .= '"';
        }

        $html .= '>';

        $html .= $this->payload['text'];

        $html .= '</p>';

        return $html;
    }
}