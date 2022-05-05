<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPerijinan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'status_perijinan';


    public function perijinan()
    {
        return $this->belongsTo(Perijinan::class, 'perijinan_usaha_id');
    }
}
