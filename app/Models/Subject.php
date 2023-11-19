<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    public function exam_categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ExamCategory::class);
    }
}
