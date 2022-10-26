<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
      'brand',
      'model',
      'plate',
      'city',
      'user_id',
      'change_oil_at'
    ];

    protected $hidden = [
      'created_at',
      'updated_at',
    ];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function documents(){
      return $this->hasMany(Document::class);
    }
}

