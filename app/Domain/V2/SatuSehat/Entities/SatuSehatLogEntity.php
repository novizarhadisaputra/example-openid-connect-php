<?php

namespace App\Domain\V2\SatuSehat\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuSehatLogEntity extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'satusehat_log';
    protected $fillable = [
        'id',
        'response_id',
        'action',
        'url',
        'payload',
        'response',
        'user_id',
    ];
}
