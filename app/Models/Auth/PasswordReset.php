<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "password_resets";

    /**
     * Primary key attribute
     *
     * @var string
     */
    protected $primaryKey = 'email';

    /**
     * Incrementing attribute
     *
     * @var string
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token',
    ];
}
