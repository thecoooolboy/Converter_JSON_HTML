<?php

namespace App\ImageElement;

class ImageElement
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
        $html = '<img src="' . $this->payload['image']['url'] . '" ';
        $id = $this->payload['image']['id'];

        if (isset($this->payload['image']['id'])) {
            $html .= 'id= ' . $id . " ";
        }

        if (isset($this->payload['image']['meta'])) {
            foreach ($this->payload['image']['meta'] as $key => $value) {
                $html .= $key . '=' . "'$value' ";
            }
        }

        if (!empty($this->parameters)) {
            $html .= ' style="';
            foreach ($this->parameters as $key => $value) {
                $html .= $key . ':' . "'$value'" . ';';
            }
            $html .= '"';
        }

        $html .= '>';

        return $html;
    }
}
