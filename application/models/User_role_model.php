<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_role_model extends MY_Model {

    protected $tableName = 'user_role'; /* This is the table name */
    public $primaryKey = 'role_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>