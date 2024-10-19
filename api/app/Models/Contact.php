<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Contact extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The table associated with the model contacts.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'nome',
        'email',
        'telefone',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'status',
    ];

}