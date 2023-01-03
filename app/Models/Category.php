<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Institution;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [

        'slug', 'updated_at', 'deleted_at',

        'slug', 'updated_at', 'deleted_at', 'image',

    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public function institutions()
    {
        return $this->belongsTo(Institution::class, 'institution_id', 'id');
    }


    public function ScopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%{$value}%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
    }
    // public function getStatusAttribute(){
    //     return $this->active ? "Active" : "Disabled";
    // }

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($id),
            ],
            'image' => 'required|image',
            'status' => 'in:active,archived',
        ];
    }


       public function getImageUrlAttribute()
       {
           if ($this->image) {
               return asset('uploads/categories' . $this->image);
           }
       }
       protected $appends=[
           'image_url',
       ];


}
