<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'option' => 'array',
    ];

    public function survey() {
        return $this->belongsTo(Survey::class);
    }
    
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
