<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'jumlah',
        'tanggal_pengeluaran',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // public static function getTotalPengeluaran()
    // {
    //     return Pengeluaran::sum('jumlah');
    // }

    // public static function getTotalPengeluaranByDateRange($mulai, $sampai)
    // {
    //     return Pengeluaran::whereBetween('tanggal_pengeluaran', [$mulai, $sampai])->sum('jumlah');
    // }
}
