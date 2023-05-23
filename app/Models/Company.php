<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';

    protected $fillable = ['name', 'number_siret'];


    /*
     * Cette fonction permets de mettre en place la relation avec le model User
    */
    public function users():BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
