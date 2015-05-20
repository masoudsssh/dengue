<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model {

	protected  $fillable = ['city', 'state', 'time', 'locality', 'gps', 'death', 'case'];

	// public function getSumAttribute()
	// {
	//     return $this->attributes['sum'] = $this->groupBy('road_name')->sum('no_of_cases');
	// }
	// protected $appends = array('sum');


	public function hotspotMaster(){
		return $this->hasOne('App\HotspotMaster', 'road_name', 'road_name');
	}

}
