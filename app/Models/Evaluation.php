<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluation extends Model
{
    protected $guarded = ['id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function evaluasiAns(): HasMany
    {
        return $this->hasMany(EvaluationAnswer::class, 'evaluation_id');
    }
}
