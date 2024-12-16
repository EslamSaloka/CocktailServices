<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "banks";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bank_name',
        'account_name',
        'account_number',
        'iban',
    ];

    public function getModePermissions() {
        return [
            "banks" => [
                "banks.index",
                "banks.create",
                "banks.edit",
                "banks.destroy",
            ]
        ];
    }

}
