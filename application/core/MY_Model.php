<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * This is for insertion
     * @param type $dataArray may be single array or bunch of arrays
     * @return type integer if it is single row insert
     */
    public function add($dataArray) {
        if (is_array($dataArray)) {
        
            if (array_filter(array_keys($dataArray), 'is_string')) {
              
                $this->db->set($dataArray, false);
                $this->db->insert($this->tableName);

              //  echo $this->db->last_query();
                $result = $this->fetch("", "", 1);

                return $result;
            } else {
//                 $this->db->set($dataArray);
//                die("here");
                $this->db->insert_batch($this->tableName,$dataArray);
                
                 return true;
            }
        }
    }

    /**
     * 
     * @param type $dataToUpdate
     * @param type $id
     * @return type
     */
    public function edit($dataToUpdate, $id, $escape = true) {
        if ($escape)
            $this->db->set($dataToUpdate, false);
        else
            $this->db->set($dataToUpdate, false, $escape);
        if (!empty($id)) {

            $this->db->where($this->primaryKey, $id);
        }

        if (array_filter(array_keys($dataToUpdate), 'is_string')) {

            if ($this->db->update($this->tableName)) {
//                echo $this->db->last_query();die('');
                return $this->db->affected_rows();
            }
        } else {

            if ($this->db->update_batch($this->tableName, $dataToUpdate, $this->primaryKey)) {
                return $this->db->affected_rows();
            }
        }
    }

    /**
     * 
     * @param type $dataToUpdate
     * @param type $cond
     * @return type
     */
    public function edit_cond($dataToUpdate, $cond, $escape = true) {
        if ($escape)
            $this->db->set($dataToUpdate, false);
        else
            $this->db->set($dataToUpdate, false, $escape);

        if (!empty($cond)) {
            $this->db->where($cond);
        }

        if (array_filter(array_keys($dataToUpdate), 'is_string')) {

            if ($this->db->update($this->tableName)) {
                return $this->db->affected_rows();
            }
        } else {

            if ($this->db->update_batch($this->tableName)) {
                return $this->db->affected_rows();
            }
        }
    }

    /**
     * 
     * @param type $selector
     * @param type $condition
     * @param type $limit
     * @param type $offset
     * @param type $order
     * @return type array  
     */
    public function fetch($condition = '', $selector = '*', $limit = null, $offset = '', $order = '', $orderType = 'desc', $group = '') {



        $this->db->select($selector);


        if (empty($order)) {
            $order = $this->primaryKey;
        }
        if (!empty($condition))
            $this->db->where($condition);



        $this->db->order_by($order, $orderType);

        if ($limit != '') {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            } else {

                $this->db->limit($limit);
            }
        }

        if (!empty($group)) {
            $this->db->group_by($group);
        }


        $res = $this->db->get($this->tableName);
        $arr = $res->num_rows() > 0 ? $res->result_array() : array();


        return $arr;
    }

    /**
     * condition can be sample
     * $select='leaverequest.*,registration.fname,registration.lname';
     * $condtion="leaverequest.leavestatus!='Deleted'";
     * $joincondition=array('registration'=>array('registration.id = leaverequest.uId','left'),'leavedetails'=>array('registration.id = leavedetails.leavedetailsID');
     * $joincondition=array('min_merchants'=>'merchant_id=min_merchants.id'); // if you do't want to specify which type of join.
     */
    public function fetch_join($joinCond = null, $condition = null, $selector = '*', $limit = null, $offset = null, $order = '', $orderType = 'desc') {

        if (!empty($selector))
            $this->db->select($selector);

        if (!empty($joinCond)) {
            foreach ($joinCond as $key => $val) {
                $cond = is_array($val) ? $val[0] : $val;
                $this->db->join($key, $cond, !empty($val[1]) ? $val[1] : null);
            }
        }


        if (!empty($condition))
            $this->db->where($condition);

if (empty($order)) {
            $order = $this->tableName.'.'.$this->primaryKey;
        }
        if (!empty($order)) {
           // $order = $this->tableName . '.' . $this->primaryKey;
            $this->db->order_by($order, $orderType);
        }
        //$this->db->order_by($order, $orderType);

        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }

        $res = $this->db->get($this->tableName);
        //$this->db->join('registration', 'registration.id = leaverequest.uId');
        //$this->db->where('leaverequest.leavestatus =', 'Pending');
        return $res->num_rows() > 0 ? $res->result_array() : array();
    }
    
    public function fetch_join_groupby($joinCond = null, $condition = null, $selector = '*', $limit = null, $offset = null, $order = '', $orderType = 'desc',$groupby = '',$groupcond = '') {

        if (!empty($selector))
            $this->db->select($selector);

        if (!empty($joinCond)) {
            foreach ($joinCond as $key => $val) {
                $cond = is_array($val) ? $val[0] : $val;
                $this->db->join($key, $cond, !empty($val[1]) ? $val[1] : null);
            }
        }


        if (!empty($condition))
            $this->db->where($condition);

        if (!empty($order)) {
            //$order = $this->tableName . '.' . $this->primaryKey;
            $this->db->order_by($order, $orderType);
        }
        

        if (!empty($limit)) {
            if (!empty($offset)) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }
        
        if (!empty($groupby)) {
            $this->db->group_by($groupby);
        }
        
        $res = $this->db->get($this->tableName);
        //$this->db->join('registration', 'registration.id = leaverequest.uId');
        //$this->db->where('leaverequest.leavestatus =', 'Pending');
        return $res->num_rows() > 0 ? $res->result_array() : array();
    }

    /**
     * This method is for cont the record set with condition
     * @param type $condition
     * @return type integer
     */
    public function count_cond($condition) {
        if (!empty($condition)) {
            $this->db->where($condition);
            return $this->db->count_all($this->tableName);
        }
    }

    /**
     * This method is for count the total record set
     * @return type integer
     */
    public function count() {

        return $this->db->count_all($this->tableName);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
     public function delete($fieldName,$id=null) {
         $this->db->where($fieldName, $id);
         $this->db->delete($this->tableName);
        return $this->db->affected_rows();
    }
}