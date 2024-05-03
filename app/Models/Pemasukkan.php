<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemasukkan extends Model
{
    use HasFactory;
    protected $table = 'pemasukkans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'sumber_pemasukkan',
        'deskripsi',
        'jumlah',
        'tanggal_pemasukkan',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public static function getTotalPemasukkanByDateRange($mulai, $sampai)
    // {
    //     return Pemasukkan::whereBetween('tanggal_pemasukkan', [$mulai, $sampai])->sum('jumlah');
    // }

}
