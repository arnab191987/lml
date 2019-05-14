<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paymentmode_model extends MY_Model {

    protected $tableName = 'payment_mode'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>