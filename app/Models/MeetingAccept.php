<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingAccept extends Model
{
    protected $fillable = [
        'connection_id',
        'user_id',
        'accepted',
    ];
}