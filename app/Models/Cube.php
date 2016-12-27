<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cube
 * @package App\Models
 */
class Cube extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['queries_number', 'last_coordinate'];


    /**
     * @var int
     */
    protected  $first_coordinate = 1;

    /**
     * @var int
     */
    protected  $initial_blocks = 0;

    /**
     * @var
     */
    protected $coordinates ;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function testCase()
    {
        return $this->belongsTo(TestCase::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cubeQueries()
    {
        return $this->hasMany(CubeQuery::class);
    }

    /**
     *
     */
    public function initCoordinates()
    {
        for ($x = $this->first_coordinate; $x <= $this->last_coordinate; $x++)
        {
            for ($y = $this->first_coordinate; $y <= $this->last_coordinate; $y++)
            {
                for ($z = $this->first_coordinate; $z <= $this->last_coordinate; $z++)
                {
                    $this->coordinates[$x][$y][$z] = $this->initial_blocks;
                }
            }
        }
    }

    /**
     * @param $x1
     * @param $y1
     * @param $z1
     * @param $x2
     * @param $y2
     * @param $z2
     * @return int
     */
    public function cubeQuery($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $value = 0;
        for ($x = $x1; $x <= $x2; $x++)
        {
            for ($y = $y1; $y <= $y2; $y++)
            {
                for ($z = $z1; $z <= $z2; $z++)
                {
                    $value += $this->coordinates[$x][$y][$z];
                }
            }
        }
        return $value;
    }

    /**
     * @param $x
     * @param $y
     * @param $z
     * @param $w
     */
    public function updateBlockValue($x, $y, $z, $w)
    {
        $this->coordinates[$x][$y][$z] = $w;
    }
}
