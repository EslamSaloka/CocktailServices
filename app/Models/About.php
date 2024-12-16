<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = "contents";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'content',
        'image',
    ];

    public function getModePermissions() {
        return [
            "contents" => [
                "contents.index",
                "contents.create",
                "contents.edit",
                "contents.destroy",
            ]
        ];
    }

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"image");
    }

}
