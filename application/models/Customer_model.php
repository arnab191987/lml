<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_model extends MY_Model {

    protected $tableName = 'customer'; /* This is the table name */
    public $primaryKey = 'customer_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>
