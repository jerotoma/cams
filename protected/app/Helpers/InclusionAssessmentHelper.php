    <?php

    class InclusionAssessmentHelper{


        public function __construct(){

        }

      public function getFirstTD($tdName,$rospan){

       return   '<td width="23px" class="text-center" rowspan="'.$rospan.'"><span class="rotate-vertically">'.$tdName.'</span></td>';
      }

      public function getTextFieldValue($text){
        if(!empty($text)){
          return $text;
        }else{
          $text = "";
          return $text;
        }
      }
      public function getCheckedBox($args, $checkbox ){
            $arr   = unserialize($args);
            //var_dump($arr);
          $found = false;
          if(!empty($arr)){

            for($i = 0; $i  < count($arr); $i++){
                  if($arr[$i] == $checkbox ){
                     $found = true;
                    break;
                  }
              }

            if($found){
                 $check = 'checked';

                 return $check;
               }else{
                   $text = "";
                  return   $text;
               }

           }else{
              $text = "";
              return $text;
            }
      }
      public function isChecked($text, $value){

          if(!empty($text) && ($text == $value)){
              $check = 'checked';
              return $check;
            }else{
              $text = "";
              return $text;
            }
      }



      public function getTableRow($arrArgs, $args = '' ){

        //  var_dump($args);
          if (empty($args)) {
             $args  = '';
          }
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
                           <td class="text-center"><input type="checkbox" name="rom_l_'.$this->slugify($key).'_'.$count.'_1" '.$this->wasChecked($args,'rom_l_'.$this->slugify($key).'_'.$count.'_1','Yes').' value="Yes"></td>
                           <td class="text-center"><input type="checkbox" name="rom_l_'.$this->slugify($key).'_'.$count.'_2" '.$this->wasChecked($args,'rom_l_'.$this->slugify($key).'_'.$count.'_2','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="rom_l_'.$this->slugify($key).'_'.$count.'_3" '.$this->wasChecked($args,'rom_l_'.$this->slugify($key).'_'.$count.'_3','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="rom_r_'.$this->slugify($key).'_'.$count.'_1" '.$this->wasChecked($args,'rom_r_'.$this->slugify($key).'_'.$count.'_1','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="rom_r_'.$this->slugify($key).'_'.$count.'_2" '.$this->wasChecked($args,'rom_r_'.$this->slugify($key).'_'.$count.'_2','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="rom_r_'.$this->slugify($key).'_'.$count.'_3" '.$this->wasChecked($args,'rom_r_'.$this->slugify($key).'_'.$count.'_3','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_l_'.$this->slugify($key).'_'.$count.'_1" '.$this->wasChecked($args,'ms_l_'.$this->slugify($key).'_'.$count.'_1','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_l_'.$this->slugify($key).'_'.$count.'_2" '.$this->wasChecked($args,'ms_l_'.$this->slugify($key).'_'.$count.'_2','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_l_'.$this->slugify($key).'_'.$count.'_3" '.$this->wasChecked($args,'ms_l_'.$this->slugify($key).'_'.$count.'_3','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_r_'.$this->slugify($key).'_'.$count.'_1" '.$this->wasChecked($args,'ms_r_'.$this->slugify($key).'_'.$count.'_1','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_r_'.$this->slugify($key).'_'.$count.'_2" '.$this->wasChecked($args,'ms_r_'.$this->slugify($key).'_'.$count.'_2','Yes').' value="Yes"> </td>
                           <td class="text-center"><input type="checkbox" name="ms_r_'.$this->slugify($key).'_'.$count.'_3" '.$this->wasChecked($args,'ms_r_'.$this->slugify($key).'_'.$count.'_3','Yes').' value="Yes"> </td>
                          </tr>';
                $count++;
               }


          }

      return $tr;
      }
      public function wasChecked($args,$label, $passedValue){
             $checked = '';

            if (!empty($args)) {

                foreach((array)$args as $key => $va) {

                 if ( $key != 'incl_assessment_id' && $key != 'id' && $key != 'created_at' && $key != 'updated_at' && isset($va) ){
                      $data =          unserialize($va);

                       foreach((array)$data as $k => $v) {
                              $checked = '';
                                 if ($k === $label) {
                                      if($v == $passedValue){
                                          $checked = 'checked';
                                         break 2;
                                      }
                                 }
                         }
                     }

                 }
                 return $checked;
            }else {
              return '';
            }


      }

     public function slugify($text){
               // replace non letter or digits by -
               $text = preg_replace('~[^\pL\d]+~u', '-', $text);

               // transliterate
               $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

               // remove unwanted characters
               $text = preg_replace('~[^-\w]+~', '', $text);

               // trim
               $text = trim($text, '_');

               // remove duplicate -
               $text = preg_replace('~-+~', '_', $text);

               // lowercase
               $text = strtolower($text);

               if (empty($text)) {
                 return 'n-a';
               }

       return $text;
     }

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

    }
