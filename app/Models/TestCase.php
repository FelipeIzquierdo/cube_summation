<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestCase
 * @package App\Models
 */
class TestCase extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['tests_number'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cubes()
    {
        return $this->hasMany(Cube::class);
    }

    public function saveTest($data){
        $this->fill($data);
        $this->save();
    }
}
