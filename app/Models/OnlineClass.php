<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    use HasFactory;

    protected $table = 'online_classes';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'link',
        'description',
        'status',
        'course_id',
    ];

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
