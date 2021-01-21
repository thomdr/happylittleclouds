<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    protected $fillable = ['name', 'description', 'date'];

    /**
     * Return the month
     *
     * @return string
     */
    public function month():string
    {
        return substr($this->date, 5, 2);
    }

    /**
     * Return the year
     *
     * @return string
     */
    public function year():string
    {
        return substr($this->date, 0, 4);
    }
}
