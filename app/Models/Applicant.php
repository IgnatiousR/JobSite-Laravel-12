<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'full_name',
        'contact_number',
        'contact_email',
        'message',
        'location',
        'resume_path'
    ];

    public function job(): BelongsTo{
        return $this->belongsTo(Job::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
