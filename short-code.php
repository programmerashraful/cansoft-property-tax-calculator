<?php

// Shortcode for property calculator
function cansoft_property_calculator($atts){
	extract( shortcode_atts(array (
		'p_value' => 500000,
	), $atts, 'property_calculator' ) );
    
    $data=null;
    
    $data.='
        <div id="vue-app" class="cansoft-property-calculator-wrapper">
           <div class="calculator-left">
               <p>
                   <label for="assessedValue">Assessed Value of the Property</label>
                   <input type="number" id="assessedValue" placeholder="0.00" step="1" min="0" inputmode="numeric" class="calculator-input" value="'.$p_value.'">
               </p>
               <p>
                   <label for="province">Province</label>
                   <select id="province" class="calculator-input">
                       <option value="AB" class="jsx-1596909444">Alberta</option>
                       <option value="BC" class="jsx-1596909444">British Columbia</option>
                       <option value="MB" class="jsx-1596909444">Manitoba</option>
                       <option value="NB" class="jsx-1596909444">New Brunswick</option>
                       <option value="NL" class="jsx-1596909444">Newfoundland and Labrador</option>
                       <option value="NS" class="jsx-1596909444">Nova Scotia</option>
                       <option value="ON" class="jsx-1596909444">Ontario</option>
                       <option value="PE" class="jsx-1596909444">Prince Edward Island</option>
                       <option value="QC" class="jsx-1596909444">Québec</option>
                       <option value="SK" class="jsx-1596909444">Saskachewan</option>
                    </select>
               </p>
               <p>
                   <label for="city">City</label>
                   <select id="city" class="calculator-input">
                       <option value="airdrie">Airdrie</option>
                       <option value="beaumont">Beaumont</option>
                       <option value="brooks">Brooks</option>
                       <option value="calgary">Calgary</option>
                       <option value="camrose">Camrose</option>
                       <option value="canmore">Canmore</option>
                       <option value="chestermere">Chestermere</option>
                       <option value="cochrane">Cochrane</option>
                       <option value="coldlake">Cold Lake</option>
                       <option value="edmonton">Edmonton</option>
                       <option value="fortsaskatchewan">Fort Saskatchewan</option>
                       <option value="grandeprairie">Grande Prairie</option>
                       <option value="highriver">High River</option>
                       <option value="lacombe">Lacombe</option>
                       <option value="leduc">Leduc</option>
                       <option value="lethbridge">Lethbridge</option>
                       <option value="lloydminster">Lloydminster</option>
                       <option value="medicinehat">Medicine Hat</option>
                       <option value="okotoks">Okotoks</option>
                       <option value="reddeer">Red Deer</option>
                       <option value="sprucegrove">Spruce Grove</option>
                       <option value="stalbert">St. Albert</option>
                       <option value="stonyplain">Stony Plain</option>
                       <option value="strathmore">Strathmore</option>
                       <option value="sylvanlake">Sylvan Lake</option>
                       <option value="wetaskiwin">Wetaskiwin</option>
                       <option value="whitecourt">Whitecourt</option>
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
                   <p>2021 Property Tax Value:</p>
                   <h1>$3,055</h1>
               </div>
               <div class="calculator-result-box">
                   <p>2021 Residential Property Tax Rate:</p>
                   <h1>0.611013 %</h1>
               </div>
           </div>
       </div>
    ';
    return $data;
}
add_shortcode ('property_calculator', 'cansoft_property_calculator' );


?>