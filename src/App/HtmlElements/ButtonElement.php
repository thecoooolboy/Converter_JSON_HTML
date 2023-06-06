<?php

namespace App\HtmlElements;

class ButtonElement
{
    private array $payload;
    private array $parameters;

    public function __construct(array $data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
    }

    public function render(): string
    {
        $html = '<button';

        if (!empty($this->parameters)) {
            $html .= ' style="';
            foreach ($this->parameters as $key => $value) {
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

        $html .= '<a href="' . $this->payload['link']['payload'] . '">' . $this->payload['text'] . '</a></button>';

        return $html;
    }
}