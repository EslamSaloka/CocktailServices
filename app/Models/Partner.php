<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = "partners";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
    ];

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"logo");
    }

    public function getModePermissions() {
        return [
            "partners" => [
                "partners.index",
                "partners.create",
                "partners.edit",
                "partners.destroy",
            ]
        ];
    }

}
