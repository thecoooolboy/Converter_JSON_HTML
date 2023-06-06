<?php

namespace App\DTO;

use App\Enum\HtmlElementEnum;

final class PageElement
{
    private HtmlElementEnum $type;

    public function __construct(
        ?string                $type,
        private readonly array $payload,
        private readonly array $parameters,
        private readonly array $children
    ) {
        $this->type = HtmlElementEnum::from($type);
    }

    public function getType(): HtmlElementEnum
    {
        return $this->type;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}
