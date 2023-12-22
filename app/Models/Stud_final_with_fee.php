<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class stud_final_with_fee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'stud_final_with_fee';

    public $timestamps = false;
    
    protected $primaryKey = 'reg_id';

    public $incrementing = true;

    protected $keyType = 'string';

    protected $fillable = [
        'reg_id',
        'contact_no',
        'email',
    ];
}
