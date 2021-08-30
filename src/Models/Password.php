<?php

namespace Crumbls\CommonPasswords\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Password
 * @package Crumbls\CommonPasswords\Models
 */
class Password extends Model
{
    protected $table = 'common_passwords';
    public $timestamps = false;
}
