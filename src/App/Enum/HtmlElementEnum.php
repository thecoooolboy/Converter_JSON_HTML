<?php

namespace App\Enum;

enum HtmlElementEnum: string
{
    case CONTAINER = 'container';
    case BLOCK = 'block';
    case TEXT = 'text';
    case BUTTON = 'button';
    case IMAGE = 'image';
}
