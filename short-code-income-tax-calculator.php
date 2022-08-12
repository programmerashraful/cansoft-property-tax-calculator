<?php



// Shortcode for Ontario sale tax calculator
function candaIncomeTaxCalculator($atts){
    
      //provice wise Tax Infromation
      $province_taxes = [
          ['province_name'=>'Alberta', 
           'conditions'=>[
              ['start'=>131220, 'parcent'=>10],
              ['start'=>26244,  'parcent'=>12],
              ['start'=>52488,  'parcent'=>13],
              ['start'=>104976, 'parcent'=>14],
              ['start'=>314928, 'parcent'=>15],
            ]
          ],
          
          ['province_name'=>'British Columbia', 
           'conditions'=>[
              ['start'=>42184, 'parcent'=>5.06],
              ['start'=>42185,  'parcent'=>7.7],
              ['start'=>12497,  'parcent'=>10.5],
              ['start'=>20757, 'parcent'=>12.29],
              ['start'=>41860, 'parcent'=>14.7],
              ['start'=>62937, 'parcent'=>16.8],
              ['start'=>222420, 'parcent'=>20.5],
            ]
          ],
          
          ['province_name'=>'Manitoba', 
           'conditions'=>[
              ['start'=>33723, 'parcent'=>10.8],
              ['start'=>39162,  'parcent'=>12.75],
              ['start'=>72885,  'parcent'=>17.4],
            ]
          ],
          
          ['province_name'=>'New Brunswick', 
           'conditions'=>[
              ['start'=>43835, 'parcent'=>9.68],
              ['start'=>43836,  'parcent'=>14.82],
              ['start'=>54863,  'parcent'=>16.52],
              ['start'=>19849,  'parcent'=>17.84],
              ['start'=>162383,  'parcent'=>20.3],
            ]
          ],
          
          ['province_name'=>'Newfoundland and Labrado', 
           'conditions'=>[
              ['start'=>38081, 'parcent'=>8.7],
              ['start'=>38080, 'parcent'=>14.5],
              ['start'=>59812, 'parcent'=>15.8],
              ['start'=>54390, 'parcent'=>17.3],
              ['start'=>190363, 'parcent'=>18.3],
            ]
          ],
          
          ['province_name'=>'Nova Scotia', 
           'conditions'=>[
              ['start'=>29590, 'parcent'=>8.79],
              ['start'=>29590, 'parcent'=>14.95],
              ['start'=>33820, 'parcent'=>16.67],
              ['start'=>57000, 'parcent'=>17.5],
              ['start'=>150000, 'parcent'=>21],
            ]
          ],
          
          ['province_name'=>'Ontario', 
           'conditions'=>[
              ['start'=>45142, 'parcent'=>5.05],
              ['start'=>45145, 'parcent'=>9.15],
              ['start'=>59713, 'parcent'=>11.16],
              ['start'=>70000, 'parcent'=>12.16],
              ['start'=>220000, 'parcent'=>13.16],
            ]
          ],
          
          ['province_name'=>'Prince Edward Island', 
           'conditions'=>[
              ['start'=>31984, 'parcent'=>9.8],
              ['start'=>31985, 'parcent'=>13.8],
              ['start'=>63969, 'parcent'=>16.7],
            ]
          ],
          
          ['province_name'=>'Québec', 
           'conditions'=>[
              ['start'=>45105, 'parcent'=>15],
              ['start'=>45095, 'parcent'=>20],
              ['start'=>19555, 'parcent'=>24],
              ['start'=>109755, 'parcent'=>25.75],
            ]
          ],
          
          ['province_name'=>'Saskachewan', 
           'conditions'=>[
              ['start'=>45677, 'parcent'=>10.5],
              ['start'=>84829, 'parcent'=>12.5],
              ['start'=>130506, 'parcent'=>14.5],
            ]
          ],
          
          ['province_name'=>'Northwest Territories', 
           'conditions'=>[
              ['start'=>44396 , 'parcent'=>5.9],
              ['start'=>44400, 'parcent'=>8.6],
              ['start'=>55566, 'parcent'=>12.2],
              ['start'=>144362, 'parcent'=>14.05],
            ]
          ],
          
          ['province_name'=>'Nunavut', 
           'conditions'=>[
              ['start'=>46740 , 'parcent'=>4],
              ['start'=>46740, 'parcent'=>7],
              ['start'=>58498, 'parcent'=>9],
              ['start'=>151978, 'parcent'=>11.5],
            ]
          ]
      ];
      
      
      $province_taxes_json = json_encode($province_taxes);
    
	extract( shortcode_atts(array (
		'p_value' => 1000,
		'selected' => null,
	), $atts, 'canada-income-tax-calculator' ) );
    
    $d_none = '';
    if($selected or $selected==0){
        $d_none = 'style="display:none"';
    }
    $data=null;
    $data.='
        
        <div class="incomeTaxCalculatorCanada" id="incomeTaxCalculatorCanada">
    <textarea style="width:0;height:0;display:none"  id="income_tax_calculator_all_data" >'.$province_taxes_json.'</textarea>

       <input type="hidden" name="income_tax_selected_province" id="income_tax_selected_province" value="'.$selected.'">
        <table>
            <tr class="gray_bg">
               <td style="min-width: 60%;"> Original amount in Dollar: </td>
               <td>
                   <input id="original_amount" type="number" aria-label="Amount" name="am" value="'.$p_value.'" class="curform calculator-input" >
               </td>
           </tr>
           <tr class="gray_bg" '.$d_none.'>
               <td>Province</td>
               <td>
                   <select name="income_tax_calculator_provinces" id="income_tax_calculator_provinces" aria-label="Province" class="curform  calculator-input" >
                       <option value="0">Alberta</option>
                        <option value="1">British Columbia</option>
                        <option value="2">Manitoba</option>
                        <option value="3">New Brunswick</option>
                        <option value="4">Newfoundland and Labrador</option>
                        <option value="5">Nova Scotia</option>
                        <option value="6">Ontario</option>
                        <option value="7">Prince Edward Island</option>
                        <option value="8">Québec</option>
                        <option value="9">Saskachewan</option>
                        <option value="10">Northwest Territories</option>
                        <option value="11">Nunavut</option>

                   </select>
               </td>
            </tr>

            <tr class="">
               <td>Only taxes</td>
               <td>
                   <span class="canadaSaleTaxResult incomTaxResultTax">$0</span>
               </td>
            </tr>
            <tr class="gray_bg">
               <td>Amount With taxes</td>
               <td>
                   <span class="canadaSaleTaxResult incomTaxResultTaxTotal">$0</span>
               </td>
            </tr>
            <tr>
               <td></td>
               <td>
                   <button id="incomeTaxCalculatorSubmit" class="calculator-submit-button">
                    Calculate
                </button>
               </td>
               </tr>
        </table>
   </div>
       
    ';
    return $data;
}
add_shortcode ('canada-income-tax-calculator', 'candaIncomeTaxCalculator' );
