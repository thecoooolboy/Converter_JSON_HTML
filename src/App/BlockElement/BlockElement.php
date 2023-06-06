<?php

namespace App\BlockElement;

class BlockElement
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

    /**
     * Дочерние элементы
     * @var array
     */
    private array $children;

    public function __construct(array $data)
    {
        $this->payload = $data['payload'] ?? [];
        $this->parameters = $data['parameters'] ?? [];
        $this->children = $data['children'] ?? [];
    }

    /**
     * Рендер HTML
     *
     * @param $converter
     *
     * @return string
     */
    public function render($converter): string
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