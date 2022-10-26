<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Document extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = [
    'type',
    'expires_at',
    'vehicle_id'
  ];

  protected $hidden = [
    'created_at',
    'updated_at',
  ];

  public function registerMediaCollections(): void
  {
    $this
      ->addMediaCollection('file')
      ->singleFile();
  }

  public function getStatusAttribute(){
    $date = Carbon::parse($this->expires_at);
    if( now() < $date->subDays(5) ){
      return 'ok';
    }
    if( (now() > $date->subDays(5)) && (now() < $date) ){
      return 'warning';
    }
    return 'danger';
  }
}
