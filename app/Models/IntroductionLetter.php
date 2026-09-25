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
    ];

    protected $casts = [
        'letter_date' => 'date',
    ];

    public function internshipApplication()
    {
        return $this->belongsTo(
            InternshipApplication::class,
            'internship_application_id'
        );
    }
}
