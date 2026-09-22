<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'company_name',
        'full_address',
        'hr_contact',
        'available_quota',
        'partner_status',
    ];

    /**
     * Get the users associated with this company.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the internship applications submitted to this company.
     */
    public function internshipApplications()
    {
        return $this->hasMany(InternshipApplication::class);
    }
}
