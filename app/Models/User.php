<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    const TYPE_ADMIN    = "administrator";
    const TYPE_CUSTOMER = "customer";

    protected $table = "users";
    protected $guard_name = "web";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'phone_verified_at',
        'otp',
        'password',
        'avatar',
        'suspend',
        'area',
        'id_number',
        'employer_id',
        'employer_name',
        'employer_years',
        'salary',
    ];

    public function getModePermissions() {
        return [
            "users" => [
                "users.index",
                "users.create",
                "users.edit",
                "users.destroy",
            ],
            "customers" => [
                "customers.index",
                "customers.create",
                "customers.edit",
                "customers.destroy",
            ],
            "roles" => [
                "roles.index",
                "roles.create",
                "roles.edit",
                "roles.destroy",
            ],
        ];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function getDisplayAvatarAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"avatar");
    }

    public function employer() {
        return $this->hasOne(\App\Models\Employer::class, 'id' ,'employer_id');
    }

    public function orders() {
        return $this->hasMany(\App\Models\Order::class, 'user_id' ,'id');
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id' ,'id');
    }


    public static function adminDisplayPermissions() {
        return [
            //
        ];
    }

    public static function adminDisplayPermissionsActions() {
        return [
            //
        ];
    }
}
