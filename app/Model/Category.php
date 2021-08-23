<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
