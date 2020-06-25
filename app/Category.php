<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guared = [];

    public function getRouteKeyName() {
        return 'slug';
    }
}
