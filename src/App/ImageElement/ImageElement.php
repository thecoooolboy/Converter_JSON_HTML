<?php

namespace App\ImageElement;

class ImageElement
{
    /**
     * Контент
     * @var array
     */
    private array $payload;

    /**
     * Свойства
     * @var array
     */
    private array $parameters;

    public function __construct(array $data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
    }

    /**
     * Генерация HTML
     *
     * @return string
     */
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
