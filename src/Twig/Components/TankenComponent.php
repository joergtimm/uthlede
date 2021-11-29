<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('tanken')]
class TankenComponent
{
    public string $api = 'a2ad9604-4f9f-0021-5fb3-e8e150cb670b';
    public string $ids = '51d4b6f8-a095-1aa0-e100-80009459e03a,3704135c-0d7e-4c76-8346-882f1b60209c,a7ed5619-72c9-48af-2d42-00815c5ac322,6946d17d-bd3e-4061-c332-7a496221db3e60ac5c62-86e9-48e7-1dba-84013c200208,4cd2e705-bf53-4dce-8450-16f5af4ff9c6';

    public function getTankstellen(): array
    {
        $idArray = explode(",", $this->ids);
        $tankstellen = [];

        foreach ($idArray as $id)
        {
            $url = sprintf(
                'https://creativecommons.tankerkoenig.de/json/detail.php?id=%s&apikey=%s',
                $id,
                $this->api
            );

            array_push($tankstellen, json_decode(file_get_contents($url), true));
        }


        return $tankstellen ;
    }
}