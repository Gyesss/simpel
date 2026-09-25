<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_code',
        'leader_student_id',
        'company_id',
        'application_date',
        'internship_start_date',
        'internship_end_date',
        'status',
        'response_letter_file',
    ];

    public function leaderStudent()
    {
        return $this->belongsTo(
            User::class,
            'leader_student_id'
        );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class);
    }

    /**
     * All introduction letters belonging to this application.
     */
    public function introductionLetters()
    {
        return $this->hasMany(
            IntroductionLetter::class,
            'internship_application_id'
        );
    }

    /**
     * Get the latest introduction letter.
     */
    public function introductionLetter()
    {
        return $this->hasOne(
            IntroductionLetter::class,
            'internship_application_id'
        )->latestOfMany();
    }
}
