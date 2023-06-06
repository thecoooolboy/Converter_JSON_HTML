<?php

namespace App\TextElement;

class TextElement
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

    public function __construct($data)
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
        $html = '<p';

        if (!empty($this->parameters)) {
            $html .= ' style="';

            if (isset($this->parameters['fontSize'])) {
                $html .= 'font-size' . ':' . $this->parameters['fontSize'] . ';';
            }
            if (isset($this->parameters['textAlign'])) {
                $html .= 'text-align' . ':' . $this->parameters['textAlign'] . ';';
            }

            $html .= '"';
        }

        $html .= '>';

        $html .= $this->payload['text'];

        $html .= '</p>';

        return $html;
    }
}