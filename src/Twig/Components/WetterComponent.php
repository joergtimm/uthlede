<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('wetter')]
class WetterComponent
{
    public string $api = 'e41ef1f8c16718e72188ac8b2ef82a92';
    public string $lat = '53.3083858';
    public string $lon = '8.5799913';

    public function getHeute(): array
    {
        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/weather?lat=%s&lon=%s&appid=%s',
            $this->lat,
            $this->lon,
            $this->api
        );

        return json_decode(file_get_contents($url), true);
    }

    public function getGesamt(): array
    {
        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/onecall?lat=%s&lon=%s&exclude=hourly,daily&appid=%s',
            $this->lat,
            $this->lon,
            $this->api
        );

        return json_decode(file_get_contents($url), true);
    }

    public function get(): array
    {
        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/weather?lat=%s&lon=%s&appid=%s',
            $this->lat,
            $this->lon,
            $this->api
        );

        return json_decode(file_get_contents($url), true);
    }

    public function getWochentag(): string
    {
        $aWeekdayNamesDE = [
            'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'
        ];

        $dt = new \DateTime('now');
        return $aWeekdayNamesDE[$dt->format('w')];
    }
}