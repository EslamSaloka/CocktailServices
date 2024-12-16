<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = "notifications";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'descriptions',
        'order_id',
        'seen',
    ];

    public function showStatus()
    {
        if($this->seen == 0) {
            return '<span class="make_pad badge bg-danger">'.__("جديد").'</span>';
        } else {
            return '<span class="make_pad badge bg-success">'.__("تم المشاهدة").'</span>';
        }
    }

    public function getModePermissions() {
        return [
            "notifications" => [
                "notifications.index",
                "notifications.create",
                "notifications.edit",
                "notifications.destroy",
            ]
        ];
    }

    public function user() {
        return $this->hasOne(\App\Models\User::class,"id","user_id");
    }

    public function order() {
        return $this->hasOne(\App\Models\Order::class,"id","order_id");
    }
}
