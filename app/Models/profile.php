<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $tabel ='profile_users';
    protected $fillable = [
        'province',
        'user_id',
        'gender',
        'bio',
        'cv'
    ];

    /**
     * Get the user that owns the profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() //هاذ الفنكشن عشان يربط هاذ التيبل بتيبل اليوزر يعني بعمل علاقة بينهم
    {
        return $this->belongsTo(User::class, 'user_id');//حطينا اليوزر اي دي لانه هو الي بربط هاذ التيبل بتيبل اليوزر
    }//ربط الون تو ون
}
