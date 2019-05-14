<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reciptvoucher_model extends MY_Model {

    protected $tableName = 'recipt_voucher'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>