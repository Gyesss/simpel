<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * Get the student who leads this application.
     */
    public function leaderStudent()
    {
        return $this->belongsTo(
            User::class,
            'leader_student_id'
        );
    }

    /**
     * Get the company for this application.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the group members of this application.
     */
    public function groupMembers()
    {
        return $this->hasMany(GroupMember::class);
    }
}
