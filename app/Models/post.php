<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//مكتبة السوفت دليت


class post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates=['deleted_at'];
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'pic',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }//ربط ال ون تو مني

    //public function getFeaturedAttribute($pic){
      //  return asset($pic);
    //}

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
