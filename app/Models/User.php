<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',     // opsional (admin)
        'nisn',      // login utama siswa
        'password',
        'role',
        'choice',
    ];

    /**
     * Relasi ke kandidat yang dipilih (voting)
     * choice → election_number
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'choice', 'election_number');
    }

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        // email_verified_at DIHAPUS karena tidak ada di migrasi
        // 'email_verified_at' => 'datetime',
    ];
}
