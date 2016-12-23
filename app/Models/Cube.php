<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    protected $fillable = ['name', 'cell_phone', 'document', 'document_type', 'home_address'];

    protected $value_last_coordinate;

    protected static $value_first_coordinate = 1;

    protected static $value_initial_blocks = 0;

    protected $coordinates = array();
}
