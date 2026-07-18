<?php

namespace App\Traits;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    private function saveFile($file, $directory)
    {
        if ($file) {
            $extension = $file->extension();
            $fileName = time() . '' . rand(11111, 99999) . '.' . $extension;
            $saveDirectory = 'public' . '/' . $directory . '/';
            Storage::putFileAs($saveDirectory, new File($file), $fileName);
            return 'storage' . '/' . $directory . '/' . $fileName;
        }
    }

    private function copyFile($file, $directory)
    {
        $file = $this->replaceStorageFolder($file);
        $exists = Storage::exists($file);
        if ($exists) {
            $fileName = explode('/', $file);
            $fileName = end($fileName);
            $saveDirectory = 'public' . '/' . $directory . '/';
            $extension = pathinfo(storage_path() . $file, PATHINFO_EXTENSION);
            $fileName = time() . '' . rand(11111, 99999) . '.' . $extension;
            Storage::copy($file, $saveDirectory . '/' . $fileName);

            return 'storage' . '/' . $directory . '/' . $fileName;
        }
        return false;
    }

    private function createCalenderFile($fileData, $directory = 'calenders')
    {
        $user = auth()->user();

        $directory = $directory . '/' . base64_encode($user['id'] . $user['created_at']) . '/';
        $saveDirectory = 'public' . '/' . $directory . '/';

        Storage::put($saveDirectory . 'calendar.ics', $fileData);

        return 'storage' . '/' . $directory . 'calendar.ics';
    }

    private function deleteFile($fileLink)
    {
        $fileLink = $this->replaceStorageFolder($fileLink);
        return Storage::delete($fileLink);
    }

    private function replaceStorageFolder($fileLink)
    {
        $fileLink = str_replace('storage/', 'public/', $fileLink);
        return $fileLink;
    }

    private function removeStorageFolder($fileLink)
    {
        $fileLink = str_replace('storage/', null, $fileLink);
        return $fileLink;
    }
}
