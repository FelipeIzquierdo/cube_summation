<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CubeQuery extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['x1', 'y1', 'z1', 'x2', 'y2', 'z2', 'w', 'result'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cube()
    {
        return $this->belongsTo(Cube::class);
    }
}

