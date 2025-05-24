<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ijazah extends Model
{
    use HasFactory;
    protected $table = 'ijazahs';
    protected $guarded = [];

    /**
     * Get the student that owns the Ijazah
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}
