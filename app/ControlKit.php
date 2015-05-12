<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlKit extends Model {

	protected $table = 'controlkits';
	protected  $fillable = ['name', 'email', 'address'];

}
