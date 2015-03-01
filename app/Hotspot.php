<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model {

	protected  $fillable = ['city', 'state', 'time', 'locality', 'gps', 'death', 'case'];

}
