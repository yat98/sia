<?php
  function getDropdownList($table,$column){
    $CI =& get_instance();

    $query = $CI->db->select($column)->from($table)->get();

    if($query->num_rows() >= 1){
      $option1 = ['' => '- Pilih -'];
      $option2 = array_column($query->result_array(),
      $column[1],$column[0]);
      $options = $option1 + $option2;
      return $options;
    }
    return $options = [''=>'- Pilih -'];
  }
