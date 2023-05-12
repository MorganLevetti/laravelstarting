<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    protected $table = 'password_reset_tokens';

    public function findByUser($email)
    {
        return $this->where('email', $email)->get();
    }
}
