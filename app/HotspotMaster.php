<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HotspotMaster extends Model {

	//
	public function hotspots(){
		return $this->hasMany('App\Hotspot', 'road_name', 'road_name');
	}
}
