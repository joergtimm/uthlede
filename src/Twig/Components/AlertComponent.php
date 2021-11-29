<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('alert')]
class AlertComponent
{
    public string $type = 'success';
    public string $message;
}

// e41ef1f8c16718e72188ac8b2ef82a92

// api.openweathermap.org/data/2.5/weather?lat=53.3083858&lon=8.5799913&appid=e41ef1f8c16718e72188ac8b2ef82a92

