<?php

class InclusionAssessmentHelper{
    
    public $arrLowerLimb = array( 'HIP'=>[
                                                array('title'=>'Flex','deg'     => '(120&deg;)'),
                                                array('title'=>'Ext','deg'      => '(30&deg;)'),
                                                array('title'=>'ABD','deg'      => '(45&deg;)'),
                                                array('title'=>'ADD','deg'      => '(30&deg;)'),
                                                array('title'=>'Rot. Ext','deg' => '(45&deg;)'),
                                                array('title'=>'Rot. Int','deg' => '(35&deg;)')
                                            ], 
                                    'KNEE'=>[
                                                array('title'=>'Flex','deg' => '(130&deg;)'),
                                                array('title'=>'Ext','deg'  => '(0&deg;)')
                                            ], 
                                    'FOOT'=>[
                                                array('title'=>'Forefoot inv','deg' => '(30&deg;)'),
                                                array('title'=>'Forefoot ev','deg'  => '(15&deg;)'),
                                                array('title'=>'Dorsiflex','deg'   => '(30&deg;)'),
                                                array('title'=>'Plantaflex','deg'  => '(45&deg;)')
                                             ], 
                                    'TRUNK'=>[
                                                array('title'=>'Flexion','deg'    => '(abdo)'),
                                                array('title'=>'Extension','deg'  => ''),
                                             ], 
                                   );
    
    public $arrUpperLimb = array( 'SHOULDER AND ARM'        =>[
                                                                array('title'=>'Flex','deg'     => '(180&deg;)'),
                                                                array('title'=>'Ext','deg'      => '(60&deg;)'),
                                                                array('title'=>'ABD','deg'      => '(90&deg;)'),
                                                                array('title'=>'ADD','deg'      => '(30&deg;)'),
                                                               ], 
                                    'ELBOW & FOREARM'        =>[
                                                                    array('title'=>'Flex','deg'     => '(135&deg; - 150&deg;)'),
                                                                    array('title'=>'Ext','deg'      => '(0&deg;)'),
                                                                    array('title'=>'Supination','deg'    => '(80&deg; - 90&deg;)'),
                                                                    array('title'=>'Peonation','deg'     => '(80&deg; - 90&deg;)'),
                                                                ], 
                                    'WIRST'                   =>[
                                                                    array('title'=>'Flexion','deg' => '(80&deg)'),
                                                                    array('title'=>'Extention','deg'  => '(70&deg)')
                                                                 ], 
                                    'HANDS'                    =>[
                                                                    array('title'=>'Fingers Triple Fex','deg' => ''),
                                                                    array('title'=>'Fingers Triple Ext','deg'  => ''),
                                                                  ], 
                                                         );
    
    
    
    
    
    
    
    
    
    public function __construct(){
        
    }
   public function getTableRow($arrArgs){
      
       $tr    = '';
       $title = '';
       $deg   = '';
       foreach($arrArgs as $key => $arrArg ){
            //var_dump($arrArg);
           $count = 0;
           
           while($count < count($arrArg) ){
                $tr   .= '<tr >';
                
               if($count === 0 ){
                   $tr   .=$this->getFirstTD($key,count($arrArg));  
                }
               
                $title  = $arrArg[$count]['title'];
                $deg    = $arrArg[$count]['deg'];
              
            $tr    .=  '<td class="text-center" width="23px">'.$title.' <br>'.$deg.'</td>
                        <td class="text-center"><input type="checkbox" name="rom_l_'.strtolower($key).'_'.$count.'_1" ></td>
                        <td class="text-center"><input type="checkbox" name="rom_l_'.strtolower($key).'_'.$count.'_2" </td>
                        <td class="text-center"><input type="checkbox" name="rom_l_'.strtolower($key).'_'.$count.'_3" </td>
                        <td class="text-center"><input type="checkbox" name="rom_r_'.strtolower($key).'_'.$count.'_1" </td>
                        <td class="text-center"><input type="checkbox" name="rom_r_'.strtolower($key).'_'.$count.'_2" </td>
                        <td class="text-center"><input type="checkbox" name="rom_r_'.strtolower($key).'_'.$count.'_3" </td>
                        <td class="text-center"><input type="checkbox" name="ms_l_'.strtolower($key).'_'.$count.'_1" </td>
                        <td class="text-center"><input type="checkbox" name="ms_l_'.strtolower($key).'_'.$count.'_2" </td>
                        <td class="text-center"><input type="checkbox" name="ms_l_'.strtolower($key).'_'.$count.'_3" </td>
                        <td class="text-center"><input type="checkbox" name="ms_r_'.strtolower($key).'_'.$count.'_1" </td>
                        <td class="text-center"><input type="checkbox" name="ms_r_'.strtolower($key).'_'.$count.'_2" </td>
                        <td class="text-center"><input type="checkbox" name="ms_r_'.strtolower($key).'_'.$count.'_3" </td>
                       </tr>';
           $count++;
            } 
       
       
       }
    
   return $tr;
   }
  public function getFirstTD($tdName,$rospan){
  
   return   '<td width="23px" class="text-center" rowspan="'.$rospan.'"><span class="rotate-vertically">'.$tdName.'</span></td>';
  }
}