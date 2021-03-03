<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->CI->load->helper('date');

function prefix_name($index=0){
    $name_prefix = array('','Captain', 'Cnl.', 'Colonel', 'Dr.', 'Gen.', 'Judge','Lady','Lieutenant','Lord','Lt.','Madam','Major','Master','Miss','Mister','Mr.','Maj.','Mrs.','Ms.','Pastor','Private','Prof.','Pvt.','Rev.','Sergeant','Sgt','Sir');
    if($index<0 || $index>=count($name_prefix)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $name_prefix[$index];
}

function suffix_name($index=0){
    $name_suffix = array('','DS','Esq.', 'II', 'III','IV.','Jr.','MA','MBA','MD','MS','PhD','RN','Sr.');
    if($index<0 || $index>=count($name_suffix)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $name_suffix[$index];
}

function mmr($index=0){
    $mmrate = array('0.00','20.00','24.99', 'II', 'III','IV.','Jr.','MA','MBA','MD','MS','PhD','RN','Sr.');
    if($index<0 || $index>=count($mmrate)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $mmrate[$index];
}

function days_of_month($index=0){
    $days = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30');
    if($index<0 || $index>=count($days)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $days[$index];
}

function string_max_length($string, $max_length) {
    if (!is_string($string)) {
       return "";
    }
    if (!is_int($max_length) || $max_length < 3) {
        $max_length = 50;
    }
    if (strlen($string) > $max_length) {
        return mb_strimwidth($string, 0, $max_length - 2, '...');
    } else {
        return $string;
    }
}

function time_selector($index=0){

}

function time_availability($index=0,$count=FALSE){
    $time = array('5:00 am','5:30 am','6:00 am', '6:30 am', '7:00 am','7:30 am','8:00 am','8:30 am','9:00 am','9:30 am','10:00 am','10:30 am','11:00 am','11:30 am','12:00 pm','12:30 pm','1:00 pm','1:30 pm','2:00 pm','2:30 pm','3:00 pm','3:30 pm','4:00 pm','4:30 pm');
    if($index<0 || $index>=count($time)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }

    if($count){
        return count($time);
    }
    return $time[$index];
}

if (!function_exists('get_employee_name')){
    function get_employee_name($id=null){
        $CI = &get_instance();
        $CI->load->model('General_model', 'general');
        $get_employee = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        return $CI->general->get_data_with_param($get_employee,FALSE);
    }
}

if (!function_exists('get_total_item_qty')){
    function get_total_item_qty($id=null){
        $CI = &get_instance();
        $CI->load->model('General_model', 'general');
        $get_item_qty_total = array(
            'where' => array(
                'item_id' => $id
            ),
            'table' => 'items_has_storage_loc',
            'select' => 'id,SUM(qty) as total_qty',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        return $CI->general->get_column_sum($get_item_qty_total);
    }
}
?>