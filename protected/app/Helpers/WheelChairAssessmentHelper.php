<?php 

  class WheelChairAssessmentHelper{
     
       public function __construct(){

        }   
       public function isCheckedBox($args, $checkbox){
            $found = false;
            $arr = unserialize($args);
          for($i = 0; $i  < count($arr); $i++){
              if($arr[$i] == $checkbox ){
               $found = true; 
                break;
              }
          }

          return $found;
      }
     public function isCheckedRadio($db_value, $radioValue){
           $found = false;
           if($db_value == $radioValue){
               $found = true; 
                
              }
           return $found;
      }
    public function _e($args){
    
		return (string)$args;        
    
	
	}
	
	public function getTextInputValue($inputText){
         if(!empty($inputText)){
			 
			 return $inputText;   
		 
		 }else{
			 
			$inputText = ''; 
			 
		   return $inputText; 
		 }
   }

  }