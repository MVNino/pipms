<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use Notifiable;
    // Table
	protected $table = 'notifications';
    //Primary Key
	public $primaryKey = 'id';
    // Timestamps
	public $timestamps = true;
}
