<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = "faqs";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question',
        'answer',
    ];

    public function getModePermissions() {
        return [
            "faqs" => [
                "faqs.index",
                "faqs.create",
                "faqs.edit",
                "faqs.destroy",
            ]
        ];
    }

}
