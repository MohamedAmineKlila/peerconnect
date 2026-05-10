<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meeting extends Model
{
    protected $fillable = [
        'connection_id',
        'scheduled_at',
        'duration_hours',
        'subject',
        'location',
        'agenda',
        'online',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'online' => 'boolean',
    ];

    public function connection(): BelongsTo
    {
        return $this->belongsTo(Connection::class);
    }
}
