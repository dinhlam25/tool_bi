<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siireuser extends Authenticatable
{
    protected $table = 'mst_siireuser';
    protected $connection = 'dobar_siire';

    // 継承したuserカラムからの調整
    protected $primaryKey = 'siireuser_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'siireuser_id', 'siireuser_passwd', 'siireuser_last_name', 'siireuser_first_name',
        'siireuser_email_1','siireuser_email_2','siireuser_siire_shop_code',
    ];

    protected $hidden = [
        'siireuser_passwd', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
