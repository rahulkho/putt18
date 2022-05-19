<?php

namespace App;

use App\Entities\Orders\Order;
use EMedia\Oxygen\Entities\Traits\OxygenUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

	use OxygenUserTrait;
	use Notifiable;

	protected $searchable = ['name', 'last_name', 'email'];

    protected $fillable = ['name', 'first_name', 'last_name', 'email', 'password', 'timezone'];
	protected $hidden   = ['name', 'password', 'remember_token', 'avatar_path', 'avatar_disk'];
    protected $visible  = ['id', 'uuid', 'first_name', 'last_name', 'full_name', 'email', 'avatar_url', 'avatar_path', 'avatar_disk', 'timezone'];

	protected $appends  = [
	    'first_name', 'full_name',
	    'is_premium',
	];

    protected $casts = [
        'id' => 'string'
    ];

    protected $dates = [
        'became_premium_at',
    ];

    public function getExtraApiFields()
    {
        return [
            'access_token',
        ];
    }

    public function getIsPremiumAttribute()
    {
        return is_null($this->attributes['became_premium_at']);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
