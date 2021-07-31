<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['print_dpi_id', 'name', 'm10', 'm50', 'm200', 'm200plus'];
    public $timestamps = false;
}
