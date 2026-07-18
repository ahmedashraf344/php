<?php

namespace App\Traits;

use App\Models\FileCenter;
use App\Models\Shop;

trait ShopTrait
{
    private function saveMoreImages($request, Shop $shop)
    {
        if ($request->hasFile('more_images')) {
            foreach ($request['more_images'] as $moreImage) {
                $file = $this->saveFile($moreImage, 'shops/' . $shop->id . '/more');
                $image = new FileCenter;
                $image->file = $file;
                $image->extension = $moreImage->extension();
                $shop->gallery()->save($image);
            }
        }
    }

}
