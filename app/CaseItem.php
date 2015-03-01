<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseItem extends Model {

	protected  $fillable = ['user_id', 'title', 'description', 'category', 'image'];

}
