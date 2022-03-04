<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /**
     * Relationship with posts 
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany('App\Model\Post');
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');

        $oldPost = Category::where('slug', $slug)->first();

        $counter = 0;
        while ($oldPost) {
            $newSlug = $slug . '-' . $counter;
            $oldPost = Category::where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
}
