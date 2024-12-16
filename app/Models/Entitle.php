<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entitle extends Model
{
    use HasFactory;

    protected $table = "entities";
    protected $fillable = ['name','whatsapp'];

    public function getModePermissions() {
        return [
            "entitles" => [
                "entitles.index",
                "entitles.create",
                "entitles.edit",
                "entitles.destroy",
            ]
        ];
    }

    public function services() {
        return $this->belongsToMany(\App\Models\Service::class, 'entitle_services_pivot', 'entitle_id' ,'service_id');
    }
}
