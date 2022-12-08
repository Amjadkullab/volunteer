<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class admin extends Authenticatable
{
    use HasFactory,HasRoles;
    protected $guarded = [];

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
    public function getStatusAttribute(){
        return $this->active ? "Active" : "Disabled";
    }

}
