<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends MY_Model {

    protected $tableName = 'user'; /* This is the table name */
    public $primaryKey = 'user_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>