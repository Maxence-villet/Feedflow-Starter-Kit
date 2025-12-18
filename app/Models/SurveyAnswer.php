<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 

class SurveyAnswer extends Model
{
    use HasFactory;

    protected $table    = 'survey_answers';
    public $timestamps  = true;
    
    protected $fillable = [
        'id', 'survey_id', 'survey_question_id', 'user_id',
        'answer',
        'created_at', 'updated_at'
    ];

    protected $casts = [
    ];

    public static function getData() {
        return self::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->startOfWeek())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }
}