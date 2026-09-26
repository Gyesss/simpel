<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_application_id',
        'status',
        'responded_at',
    ];

    protected $casts = [
        'responded_at' => 'datetime',
    ];

    public function internshipApplication()
    {
        return $this->belongsTo(
            InternshipApplication::class,
            'internship_application_id'
        );
    }
}
