<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = "testimonials";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'message',
    ];

    public function getDisplayImageAttribute() {
        return (new \App\Support\Image)->displayImageByModel($this,"avatar");
    }

    public function getModePermissions() {
        return [
            "testimonials" => [
                "testimonials.index",
                "testimonials.create",
                "testimonials.edit",
                "testimonials.destroy",
            ]
        ];
    }

}
