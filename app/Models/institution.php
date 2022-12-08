<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $guarded = [];
    protected $table = 'institutions';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->withDefault(
                [
                    'name' => 'اسم الفئة'
                ]
            );
    }
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id')
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
    public static function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'cover_image' => 'required|image',
            'logo_image' => 'required|image',
            'description' => 'required|string|min:3',
            'active' =>'required',
            'email'=>'required',
            // 'role_id'=>'required|numeric|exists:roles,id',

        ];
    }
    public function posts(){
        return $this->hasMany(Post::class,'c','id');
    }
    public function getStatusAttribute(){
        return $this->active ? "Active" : "Disabled";
    }
}
