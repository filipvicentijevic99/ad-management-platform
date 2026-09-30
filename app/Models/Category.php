<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'parent_id'];

    protected $searchableFields = ['*'];

     public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getDepthAttribute()
    {
        $depth = 0;
        $parent = $this->parent;

        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }

        return $depth;
    }
    public static function buildCategoryTree($categories, $parentId = null, $depth = 0)
    {
        $branch = [];

        foreach ($categories as $category) {
            if ($category->parent_id === $parentId) {
                $category->depth = $depth;
                $category->children = self::buildCategoryTree($categories, $category->id, $depth + 1);
                $branch[] = $category;
            }
        }

        return $branch;
    }
}
