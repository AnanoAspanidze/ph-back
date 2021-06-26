<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position_id',
        'region_id',        
        'name',
        'surname',
        'position_name',
        'work_place',
        'email',
        'password',
        'approve',
        'verification_code',
        'email_verified_at',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function position() {
        return $this->belongsTo('App\Models\Position', 'position_id');
    }

    public function region() {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }
}
