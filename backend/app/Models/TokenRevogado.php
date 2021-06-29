<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenRevogado extends Model {
    
    public const TIPO_ACCESS_TOKEN = 'access';
    public const TIPO_REFRESH_TOKEN = 'refresh';
    
    protected $table = 'token_revogado';

    protected $fillable = ['tipo', 'token', 'expiracao'];
}