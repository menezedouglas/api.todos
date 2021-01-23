<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'todos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'fixed',
        'created_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    /**
     * Relationship with user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo {

        return $this->belongsTo(User::class, 'user_id');

    }
}
