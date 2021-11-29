<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('wochentag')]
class WochentagComponent
{
    public function getHeute(): string
    {
        $aWeekdayNamesDE = [
            'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'
        ];

        $dt = new \DateTime('now');
        return $aWeekdayNamesDE[$dt->format('w')];
    }
}


