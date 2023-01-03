<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Category;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Institution extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $guarded = [];
    protected $table = 'institutions';

    public function categories()
    {
        return $this->hasMany(Category::class, 'institution_id', 'id')
            ->withDefault(
                [
                    'name' => 'اسم الفئة'
                ]
            );
    }
    public function posts()
    {
        return $this->hasMany(Post::class, 'institution_id', 'id')
            ->withDefault(
                [
                    'name' => 'اسم المنشور'
                ]
            );
    }
    public function ScopeActive(Builder $builder)
    {
        $builder->where('active', '=', '1');
    }
    // public static function rules()
    // {
    //     return [
    //         'name' => 'required|string|min:3|max:255',
    //         'cover_image' => 'required|image',
    //         'logo_image' => 'required|image',
    //         'description' => 'required|string|min:3',
    //         'active' =>'required',
    //         'email'=>'required',
    //         'role_id'=>'required|numeric|exists:roles,id',

    //     ];
    // }

    public function getStatusAttribute(){
        return $this->active ? "Active" : "Disabled";
    }
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/cover_image/' . $this->cover_image);
        }
    }

    public function getImageUrAttribute()
    {
        if ($this->image) {
            return asset('uploads/logo_image/' . $this->logo_image);
        }
    }
    protected $appends=[
        'image_ur', 'image_url'
    ];
}
