<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perijinan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'perijinan_usaha';

    //create relationship with status perijinan
    public function statusPerijinan()
    {
        return $this->hasOne(StatusPerijinan::class, 'perijinan_usaha_id');
    }
}