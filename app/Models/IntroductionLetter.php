<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroductionLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_application_id',
        'letter_number',
        'letter_date',
        'status',
        'withdrawal_reason',
        'withdrawn_at',
        'withdrawn_by',
        'file_path',
    ];

    protected $casts = [
        'letter_date' => 'date',
        'withdrawn_at' => 'datetime',
    ];

    /**
     * The internship application that owns this letter.
     */
    public function internshipApplication()
    {
        return $this->belongsTo(
            InternshipApplication::class,
            'internship_application_id'
        );
    }

    /**
     * The user who withdrew this letter.
     */
    public function withdrawnBy()
    {
        return $this->belongsTo(
            User::class,
            'withdrawn_by'
        );
    }
}
