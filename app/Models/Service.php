<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";
    protected $fillable = ['name','price'];

    public function getModePermissions() {
        return [
            "services" => [
                "services.index",
                "services.create",
                "services.edit",
                "services.destroy",
            ]
        ];
    }

    public function entities() {
        return $this->belongsToMany(\App\Models\Entitie::class, 'entitie_services_pivot', 'service_id' ,'entitie_id');
    }
}
