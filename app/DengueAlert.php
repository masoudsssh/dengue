<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DengueAlert extends Model {

	protected $table = 'dengue_alerts';
	protected  $fillable = ['area', 'road_name', 'user_id'];

}
