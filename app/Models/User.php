<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'login_id',
        'nis_nip',
        'full_name',
        'class',
        'email',
        'password',
        'role',
        'company_id',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the company associated with this user.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the internship applications led by this student.
     */
    public function internshipApplications()
    {
        return $this->hasMany(
            InternshipApplication::class,
            'leader_student_id'
        );
    }

    /**
     * Get the group memberships of this student.
     */
    public function groupMembers()
    {
        return $this->hasMany(
            GroupMember::class,
            'student_id'
        );
    }
}
