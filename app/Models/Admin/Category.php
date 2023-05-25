<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//Category_Icon
    use HasFactory;

    protected $appends = ['imageUrl'];
    protected $fillable = [
        'en_Category_Name', 'en_Category_Slug', 'Status', 'en_Description', 'Category_Icon', 'fr_Category_Name', 'fr_Category_Slug', 'fr_Description', 'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'Category_Id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image)
            return asset(CategoryImage() . $this->image);
        return null;
    }
}
