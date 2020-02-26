<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Slug;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // function generateImageFileName($fileName, $fileExtension)
    // {
    //     $fileNameToStore = 'img/posts/' . $fileName . '_' . sha1(time()) . '.' . $fileExtension;
    // }

    public function generateImageFileName($image, $directory)
    {
        $filenameWithExt = $image->getClientOriginalName(); //Get Filename with extension        
        $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME); //Get Just File Name        
        $fileExtension = $image->getClientOriginalExtension(); //Get Just File Extension        
        $fileNameToStore = 'img/' . $directory . '/' . $fileName . '_' . sha1(time()) . '.' . $fileExtension; //Get Filename to Store
        return $fileNameToStore;
    }

    public function handleImageUpload($image, $directory)
    {
        if (isset($image)) {
            $imageName = ($this->generateImageFileName($image, $directory));
            $image->storeAs('public', $imageName); //Upload File
            return $imageName;
        }
    }

    public function getPostCategories($categories)
    {
        if (isset($categories)) {
            return Arr::flatten($categories);
        }
    }

    public function getUniqueSlug(string $slug)
    {

        $slugCheck = 0;
        $slugAppend = 2;
        // $slug = Str::slug($text, '-');
        $uniqueSlug = $slug;
        while ($slugCheck === 0) {
            if (Slug::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $slug . '-' . $slugAppend;
                $slugAppend++;                
            }
            else{
                $slugCheck = 1;
            }
        }
        return $uniqueSlug;
    }
}
