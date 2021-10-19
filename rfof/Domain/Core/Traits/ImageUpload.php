<?php


namespace Rfof\Domain\Core\Traits;


use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function setImageAttribute($image)
    {
        if(!$image) {
            return;
        }
        $this->deleteImage();
        if (gettype($image) != 'string') {
            $image->store($this->folderName);
            $this->attributes['image'] = $image->hashName();
        } else {
            $this->attributes['image'] = $image;
        }
    }

    public function getImageAttribute($image)
    {
        return $image ? Storage::url($this->folderName. '/' . $image) : null;
    }

    public function deleteImage()
    {
        if(isset($this->attributes['image']) && $this->attributes['image']) {
            Storage::delete($this->folderName . '/' . $this->attributes['image']);
        }
    }
}
