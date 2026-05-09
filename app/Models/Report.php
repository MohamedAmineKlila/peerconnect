<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    public const CATEGORIES = [
        'bullying' => 'Bullying',
        'harassment' => 'Harassment',
        'hate_speech' => 'Hate speech',
        'threats' => 'Threats or intimidation',
        'spam' => 'Spam or scam',
        'other' => 'Other safety concern',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'reviewing' => 'Reviewing',
        'resolved' => 'Resolved',
        'dismissed' => 'Dismissed',
    ];

    protected $fillable = [
        'reporter_id',
        'reported_id',
        'category',
        'details',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function reported(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
