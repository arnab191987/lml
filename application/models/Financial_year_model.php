<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Financial_year_model extends MY_Model {

    protected $tableName = 'financial_year'; /* This is the table name */
    public $primaryKey = 'fin_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>