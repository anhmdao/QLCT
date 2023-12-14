<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;


/**
 * Class User
 *
 * @property int $id
 * @property string|null $avatar
 * @property string $email
 * @property string|null $name
 * @property string $password
 * @property string|null $phone
 * @property int|null $status
 * @property string $username
 *
 * @property Collection|Category[] $categories
 * @property Collection|Plan[] $plans
 * @property Collection|Wallet[] $wallets
 *
 * @package App\Models
 */

class User extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    protected $casts = [
        'id' => 'int',
        'status' => 'int',
        'age' => 'int',
        'sex' => 'int'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        
        'email',
        'password',
        'username',
        'phone',
    ];

    public function wallets()
	{
		return $this->hasMany(Wallet::class);
	}

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class);
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'roles_id');
    // }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
