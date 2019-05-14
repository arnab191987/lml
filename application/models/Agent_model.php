<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agent_model extends MY_Model {

    protected $tableName = 'agent'; /* This is the table name */
    public $primaryKey = 'agent_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>