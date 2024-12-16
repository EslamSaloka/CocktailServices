<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $table = "counters";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'count',
    ];

    public function getModePermissions() {
        return [
            "counters" => [
                "counters.index",
                "counters.create",
                "counters.edit",
                "counters.destroy",
            ]
        ];
    }

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"logo");
    }

}
