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
    $name_suffix = array('','DS','Esq..', 'II', 'III','IV.','Jr.','MA','MBA','MD','MS','PhD','RN','Sr.');
    if($index<0 || $index>=count($name_suffix)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $name_suffix[$index];
}

?>