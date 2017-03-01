<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'app_outlets';

	/**
	 * Fillable fields
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description'
	];
}
