<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_imagen extends MY_Model
{
    public $table = 'imagen'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(
		"id","img", "usuario_id"
    ); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    function __construct()
    {
        parent::__construct();
    }
}
