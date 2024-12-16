<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'bank_id',
        'bank_name',
        'service_id',
        'account_name',
        'person_any',
        'transfer_date',
        'transfer_number',
        'transfer_image',
        'transfer_price',
        'seen',
        'action',
        'id_hash',
    ];

    public function showShow()
    {
        if($this->seen == 0) {
            return '<span style="color:red">'.__("لم يتم المشاهدة").'</span>';
        } else {
            return '<span style="color:green">'.__("تم المشاهده").'</span>';
        }
    }

    public function showStatus()
    {
        if($this->action == 0) {
            return '<span style="color:orange">'.__("قيد المراجعة").'</span>';
        } else if($this->action == 1) {
            return '<span style="color:green">'.__("مقبولة").'</span>';
        } else {
            return '<span style="color:red">'.__("مرفوضة").'</span>';
        }
    }

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"transfer_image");
    }

    public function getModePermissions() {
        return [
            "orders" => [
                "orders.index",
                "orders.create",
                "orders.show",
                "orders.destroy",
            ]
        ];
    }

    public function user() {
        return $this->hasOne(\App\Models\User::class,"id","user_id");
    }

    public function bank() {
        return $this->hasOne(\App\Models\Bank::class,"id","bank_id");
    }

    public function service() {
        return $this->hasOne(\App\Models\Service::class,"id","service_id");
    }

    public function entitles() {
        return $this->belongsToMany(\App\Models\Entitle::class, 'order_entities_pivot', 'order_id' ,'entities_id');
    }

}
