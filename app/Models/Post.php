<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Автор удален'
        ]);
    }

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    protected $dates = [
        'created_at',
        'updates-at',
    ];
}
