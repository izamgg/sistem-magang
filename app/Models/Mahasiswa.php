<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Mahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the jadwal associated with the Mahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jadwal(): HasOne
    {
        return $this->hasOne(Jadwal::class, 'mahasiswa_id');
    }

    /**
     * Get the nilai associated with the Mahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nilai(): HasOne
    {
        return $this->hasOne(Nilai::class, 'mahasiswa_id');
    }
}
