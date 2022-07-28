<?php


// Shortcode for property calculator
function cansoft_property_calculator($atts){
    global $taxCalculator;
	extract( shortcode_atts(array (
		'p_value' => 500000,
		'value_title' => '2021 Property Tax Value:',
		'rate_title' => '2021 Residential Property Tax Rate:',
	), $atts, 'property_calculator' ) );
    
    $provinces = $taxCalculator->load_terms('cansoft_province');
    $province_options = '';
    $city_options = '';
    $first_province = null;
    $first_city = null;
    $first_property_value = 0.00;
    $first_property_rate = 0.00;
    
    
    if($provinces){
        foreach($provinces as $province){
            $province_options.= '<option value="'.$province['term_id'].'" >'.$province['name'].'</option>';
            if(!$first_province)
                $first_province=$province['term_id'];
        }
    }
    
    $cities = $taxCalculator->getCitiesByProvince($first_province);
    
    if($cities){
        foreach($cities as $city){
            $city_options .= '<option value="'.$city->ID.'">'.$city->post_title.'</option>';
            if(!$first_city)
                $first_city = $city;
        }
    }
    
    if($first_city)
        $first_property_rate = get_post_meta($first_city->ID, 'tax_rate', true);
    
    if($p_value  and $first_property_rate){
         $first_property_value = (int) ($p_value*$first_property_rate/100);
    }
    
    $data=null;
    
    $province_cities = $taxCalculator->jsonObjectOfCities();
    $json_cities = json_encode($province_cities);
   
    
    $data.='
        <div id="calculator-app" class="cansoft-property-calculator-wrapper">
        <textarea style="width:0;height:0;display:none"  id="calculator_all_data" >'.$json_cities.'</textarea>
           <div class="calculator-left">
               <p>
                   <label for="property_value">Assessed Value of the Property</label>
                   <input type="number" id="property_value" placeholder="0.00" step="1" min="0" inputmode="numeric" class="calculator-input" value="'.$p_value.'">
               </p>
               <p>
                   <label for="calculater_province">Province</label>
                   <select id="calculater_province" class="calculator-input">
                       '.$province_options.'
                    </select>
               </p>
               <p>
                   <label for="calculater_city">City</label>
                   <select id="calculater_city" class="calculator-input">
                       '.$city_options.'
                    </select>
               </p>
               <p>
                    <button id="calculator_submit" class="calculator-submit-button">
                        Calculate
                    </button>
               </p>
           </div>
           <div class="calculator-right">
               <div class="calculator-result-box">
                   <p>'.$value_title.'</p>
                   <h1 class="displa_property_value">$<span>'.$first_property_value.'</span></h1>
               </div>
               <div class="calculator-result-box">
                   <p>'.$rate_title.'</p>
                   <h1 class="display_property_rate"> <span>'.$first_property_rate.'</span> %</h1>
               </div>
           </div>
       </div>
    ';
    return $data;
}
add_shortcode ('property_calculator', 'cansoft_property_calculator' );







// Shortcode for Ontario sale tax calculator
function cansoft_ontario_sale_tax_calculator($atts){
    global $taxCalculator;
	extract( shortcode_atts(array (
		'p_value' => 1000,
	), $atts, 'ontario_sale_tax_calculator' ) );
    
    $data=null;
    $sale_rate = 0;
    $total = 0;
    $sale_rate = $p_value * 13 / 100;
    $total = $p_value + $sale_rate;
    $data.='
        
   
       <div class="ontario_sales_tax_calculator" id="ontario_sales_tax_calculator">
           <table class="table_responsive no_border">
               <tr class="gray_bg">
                   <td style="min-width: 60%;">Amount without taxes</td>
                   <td>
                       <input type="number" min="0" value="'.$p_value.'" name="ontario_sale_tax_amount" class="calculator-input" id="ontario_sale_tax_amount">
                   </td>
               </tr>
               <tr>
                   <td>+ Rate type</td>
                   <td>
                       <select name="ontario_sale_tax_parcent" class="calculator-input" id="ontario_sale_tax_parcent">
                           <optgroup label="General rate">
                              <option value="13" selected="">13%</option>
                              <option value="5">5% Federal portion of the HST rate (ex: eligible first nations people, children\'s goods, books)</option>
                              <option value="8">8% Provincial portion of the HST rate</option>
                           </optgroup>
                        </select>
                   </td>
               </tr>
               <tr class="gray_bg">
                   <td>HST (<spane class="display_parcent">13</spane>%)</td>
                   <td>
                       <span class="ontario_sale_tax_parcent_amount"><spane class="display_parcent_rate">'.$sale_rate.'</spane></span>
                   </td>
               </tr>
               <tr>
                   <td>=</td>
                   <td></td>
               </tr>
               <tr class="gray_bg">
                   <td>Amount with taxes</td>
                   <td >
                       <span class="ontario_sale_tax_amount_with_tax">$'.$total.'</span>
                   </td>
               </tr>
               <tr>
                   <td></td>
                   <td>
                       <button id="ontario_sale_tax_calculator_submit" class="calculator-submit-button">
                            Calculate
                        </button>
                   </td>
               </tr>
           </table>
       </div>
   
    ';
    return $data;
}
add_shortcode ('ontario_sale_tax_calculator', 'cansoft_ontario_sale_tax_calculator' );


?>