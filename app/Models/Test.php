<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'questions'
    ];

    protected $casts = [
        'questions' => 'array'
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function testResult(): HasMany
    {
        return $this->hasMany(TestResult::class);
    }

    public function testResultForUser($userId)
    {
        $testResultForUser =  $this->testResult()->where('user_id', $userId)->first();
        return $testResultForUser;
//        return TestResult::where('user_id', $userId)->where('test_id', $test['id'])->first();
    }
}
