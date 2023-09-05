<?php

namespace App\Models\QuizApp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualMarks extends Model
{
    protected $table = "quiz_app.quiz_app_individual_marks";
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
