<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Accionistas extends Model
{
    protected $table = 'accionistas';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
