<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'internship_application_id',
        'student_id',
    ];

    /**
     * Get the internship application for this group member.
     */
    public function internshipApplication()
    {
        return $this->belongsTo(
            InternshipApplication::class,
            'internship_application_id'
        );
    }

    /**
     * Get the student who belongs to this group.
     */
    public function student()
    {
        return $this->belongsTo(
            User::class,
            'student_id'
        );
    }
}
