<?php

namespace App\Actions;

use App\Support\Traits\Makeable;
use Illuminate\Support\Facades\File;
use SimonHamp\TheOg\Background;
use SimonHamp\TheOg\Image;

class GenerateSocialImage
{
    use Makeable;

    public function execute(string $url, $firstDilemma, $secondDilemma)
    {
        $hash = md5($url);

        if (! is_dir(storage_path('app/public/opengraph'))) {
            mkdir(storage_path('app/public/opengraph'));
        }

        if (file_exists(storage_path("app/public/opengraph/$hash.png"))) {
            return;
        }

        (new Image())
            ->accentColor('#1B0000')
            ->url($url)
            ->description($firstDilemma . ' or ' . $secondDilemma)
            ->background(Background::GridMe, 0.4)
            ->save(storage_path("app/public/opengraph/$hash.png"));


    }
}
