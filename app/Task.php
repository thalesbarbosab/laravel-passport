<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id','description','completed'];

    public function getCompletedAttribute()
{
      return $this->attributes['completed'] == 1 ? true : false;
}
}
