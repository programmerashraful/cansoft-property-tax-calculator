<?php



// Shortcode for Ontario sale tax calculator
function canadaInflauationCalculator($atts){
    global $taxCalculator;
	extract( shortcode_atts(array (
		'p_value' => 1000,
	), $atts, 'inflauation-calculator' ) );
    
    $data=null;
    $data.='
        
   
       
   <div class="canada_inflauation_rate_calculator" id="canada_inflauation_rate_calculator">
      <form id="inflauationCalculatorForm" name="inflation" onsubmit="return false;">
       <table>
           <tr class="gray_bg">
               <td style="min-width: 60%;"> Original amount in Dollar: </td>
               <td>
                   <input id="inflauationAmount" type="number" aria-label="Amount" name="am" value="'.$p_value.'" class="curform calculator-input" >
               </td>
           </tr>
           
           <tr>
               <td>Start year:</td>
               <td>
                   <select name="y1" id="inflauationStartYear" aria-label="First year" class="curform  calculator-input" >
                       <option value="1960" selected="">1960</option>
   <option value="1961">1961</option>
   <option value="1962">1962</option>
   <option value="1963">1963</option>
   <option value="1964">1964</option>
   <option value="1965">1965</option>
   <option value="1966">1966</option>
   <option value="1967">1967</option>
   <option value="1968">1968</option>
   <option value="1969">1969</option>
   <option value="1970">1970</option>
   <option value="1971">1971</option>
   <option value="1972">1972</option>
   <option value="1973">1973</option>
   <option value="1974">1974</option>
   <option value="1975">1975</option>
   <option value="1976">1976</option>
   <option value="1977">1977</option>
   <option value="1978">1978</option>
   <option value="1979">1979</option>
   <option value="1980">1980</option>
   <option value="1981">1981</option>
   <option value="1982">1982</option>
   <option value="1983">1983</option>
   <option value="1984">1984</option>
   <option value="1985">1985</option>
   <option value="1986">1986</option>
   <option value="1987">1987</option>
   <option value="1988">1988</option>
   <option value="1989">1989</option>
   <option value="1990">1990</option>
   <option value="1991">1991</option>
   <option value="1992">1992</option>
   <option value="1993">1993</option>
   <option value="1994">1994</option>
   <option value="1995">1995</option>
   <option value="1996">1996</option>
   <option value="1997">1997</option>
   <option value="1998">1998</option>
   <option value="1999">1999</option>
   <option value="2000">2000</option>
   <option value="2001">2001</option>
   <option value="2002">2002</option>
   <option value="2003">2003</option>
   <option value="2004">2004</option>
   <option value="2005">2005</option>
   <option value="2006">2006</option>
   <option value="2007">2007</option>
   <option value="2008">2008</option>
   <option value="2009">2009</option>
   <option value="2010">2010</option>
   <option value="2011">2011</option>
   <option value="2012">2012</option>
   <option value="2013">2013</option>
   <option value="2014">2014</option>
   <option value="2015">2015</option>
   <option value="2016">2016</option>
   <option value="2017">2017</option>
   <option value="2018">2018</option>
   <option value="2019">2019</option>
   <option value="2020">2020</option>
   <option value="2021">2021</option>
                   </select>
               </td>
           </tr>
           
            <tr class="gray_bg">
               <td style="min-width: 60%;"> End year: </td>
               <td>
                   <select name="y2" id="inflauationEndYear" aria-label="End year" class="curform  calculator-input" >
                       <option value="1961">1961</option>
   <option value="1962">1962</option>
   <option value="1963">1963</option>
   <option value="1964">1964</option>
   <option value="1965">1965</option>
   <option value="1966">1966</option>
   <option value="1967">1967</option>
   <option value="1968">1968</option>
   <option value="1969">1969</option>
   <option value="1970">1970</option>
   <option value="1971">1971</option>
   <option value="1972">1972</option>
   <option value="1973">1973</option>
   <option value="1974">1974</option>
   <option value="1975">1975</option>
   <option value="1976">1976</option>
   <option value="1977">1977</option>
   <option value="1978">1978</option>
   <option value="1979">1979</option>
   <option value="1980">1980</option>
   <option value="1981">1981</option>
   <option value="1982">1982</option>
   <option value="1983">1983</option>
   <option value="1984">1984</option>
   <option value="1985">1985</option>
   <option value="1986">1986</option>
   <option value="1987">1987</option>
   <option value="1988">1988</option>
   <option value="1989">1989</option>
   <option value="1990">1990</option>
   <option value="1991">1991</option>
   <option value="1992">1992</option>
   <option value="1993">1993</option>
   <option value="1994">1994</option>
   <option value="1995">1995</option>
   <option value="1996">1996</option>
   <option value="1997">1997</option>
   <option value="1998">1998</option>
   <option value="1999">1999</option>
   <option value="2000">2000</option>
   <option value="2001">2001</option>
   <option value="2002">2002</option>
   <option value="2003">2003</option>
   <option value="2004">2004</option>
   <option value="2005">2005</option>
   <option value="2006">2006</option>
   <option value="2007">2007</option>
   <option value="2008">2008</option>
   <option value="2009">2009</option>
   <option value="2010">2010</option>
   <option value="2011">2011</option>
   <option value="2012">2012</option>
   <option value="2013">2013</option>
   <option value="2014">2014</option>
   <option value="2015">2015</option>
   <option value="2016">2016</option>
   <option value="2017">2017</option>
   <option value="2018">2018</option>
   <option value="2019">2019</option>
   <option value="2020">2020</option>
   <option value="2021">2021</option>
   <option value="2022" selected="">2022</option>
                   </select>
               </td>
           </tr>
           <tr>
               <td></td>
               <td>
                    <input id="inflauationCalculatorSubmit" type="submit" class="btn calculator-submit-button" name="btn" aria-label="Calculate" value="Calculate" style="margin:5px 8px 8px 0;background-color:#747474;color:#fff;">
               </td>
           </tr>
           <tr class="gray_bg">
               <td colspan="2">
                   <div class=floater id=infresult style="display:none; border:1px solid transparent; margin-top:15px; background-color:#ddd; padding:8px; border-radius:10px;">
                     <span id=w2></span><br><br><span id=ps></span><br><br><span id=avgps data-cur="Dollar"></span>
                     <div id=est_hint style="font-size:0.9em; display:none;"><br><br>Note: Inflation rates after 2021 are not yet available here. For the following years, the last available rate of 3.40% is used in this calculator.</div>
                  </div>
               </td>
           </tr>
           
       </table>
       </form>
   </div>
   
    ';
    return $data;
}
add_shortcode ('inflauation-calculator', 'canadaInflauationCalculator' );
