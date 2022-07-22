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
                   <label for="province">Province</label>
                   <select id="province" class="calculator-input">
                       '.$province_options.'
                    </select>
               </p>
               <p>
                   <label for="city">City</label>
                   <select id="city" class="calculator-input">
                       '.$city_options.'
                    </select>
               </p>
               <p>
                    <button class="calculator-submit-button">
                        Calculate
                    </button>
               </p>
           </div>
           <div class="calculator-right">
               <div class="calculator-result-box">
                   <p>'.$value_title.'</p>
                   <h1 class="displa_property_value">$'.$first_property_value.'</h1>
               </div>
               <div class="calculator-result-box">
                   <p>'.$rate_title.'</p>
                   <h1 class="display_property_rate">'.$first_property_rate.' %</h1>
               </div>
           </div>
       </div>
    ';
    return $data;
}
add_shortcode ('property_calculator', 'cansoft_property_calculator' );


?>