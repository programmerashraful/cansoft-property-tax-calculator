(function($){

    
    $(document).ready(function(){
        
        if(!$("#calculator-app").length){
            return;
        }
    
        
        function listCities(calculator_data, province_id){
            let cities = calculator_data['province_id_'+province_id].cities;
            let total_cities = Object.keys(cities).length;
            $('#calculater_city').html('');
            for (const city_id of Object.keys(cities)) {
                
                 $('#calculater_city').append('<option value="'+cities[city_id].city_id+'">' + cities[city_id].city_name + '</option>');
            }
        }
        
        //calculate and print data
        function calculate(property_value, calculator_data, province_id, city_id){
            
            let city = calculator_data['province_id_'+province_id].cities['city_id_'+city_id];
            
            if(!city || city=='undefined'){
               return;
            }
            
            let tax_rate = Number(city.tax_rate);
            let calculation = Number(property_value) * tax_rate / 100;
            calculation = calculation.toFixed(6);
            $('.display_property_rate span').html(tax_rate);
            $('.displa_property_value span').html(calculation);
        }
        
        let property_value = $('#property_value').val();
        let calculator_all_data = $('#calculator_all_data').val();
        calculator_all_data = JSON.parse(calculator_all_data);
        let province_id = null;
        let city_id = null;
        
        $('#calculater_province').on('change', function() {
            province_id = $('#calculater_province').val();
            city_id = $('#calculater_city').val();
            listCities(calculator_all_data, province_id);
        });
        
        //calculator submit button
        $('#calculator_submit').on('click', function() {
            
            property_value = $('#property_value').val();
            province_id = $('#calculater_province').val();
            city_id =  $('#calculater_city').find(':selected').val()
            
            calculate(property_value, calculator_all_data, province_id, city_id);
            
        });
        
        
        
        
    });
    

    //ontario tax calculator
    $(document).ready(function(){
        
        if(!$("#ontario_sales_tax_calculator").length){
            return;
        }
        
        function calculate(){
            let ontario_sale_tax_amount = $('#ontario_sale_tax_amount').val();
            let ontario_sale_tax_parcent = $('#ontario_sale_tax_parcent').val();
            let display_parcent = $('.display_parcent');
            let display_parcent_rate = $('.display_parcent_rate');
            let ontario_sale_tax_amount_with_tax = $('.ontario_sale_tax_amount_with_tax');
            let parcent_rate = 0;
            let total_amount = 0;
            
            display_parcent.html(ontario_sale_tax_parcent);
            parcent_rate = Number(ontario_sale_tax_amount) * Number(ontario_sale_tax_parcent) / 100;
            display_parcent_rate.html(parcent_rate);
            total_amount = Number(ontario_sale_tax_amount) + parcent_rate;
            ontario_sale_tax_amount_with_tax.html('$'+total_amount);
        }
        
        $('#ontario_sale_tax_amount').on('change', function() {
            calculate();
        });
        $('#ontario_sale_tax_parcent').on('change', function() {
            calculate();
        });
        $('#ontario_sale_tax_calculator_submit').on('click', function() {
            calculate();
        });
        $("#ontario_sale_tax_amount").keyup(function(){
          calculate();
        });
        
    });

    //Inflauation calculator calculator
    $(document).ready(function(){
        
        if(!$("#canada_inflauation_rate_calculator").length){
            return;
        }
        
        
        function inflationCalc() {
        var d = document,
            cf = d.inflation,
            v1 = cf.am.value,
            jahre = 0,
            cur = d.getElementById("avgps").dataset.cur;
        y1 = parseInt(d.getElementById("inflauationStartYear")[d.getElementById("inflauationStartYear").selectedIndex].value, 10);
        y2 = parseInt(d.getElementById("inflauationEndYear")[d.getElementById("inflauationEndYear").selectedIndex].value, 10);
        let rates = {
            "1960": 1.36,
            "1961": 1.02,
            "1962": 1.06,
            "1963": 1.63,
            "1964": 1.91,
            "1965": 2.33,
            "1966": 3.82,
            "1967": 3.58,
            "1968": 4.06,
            "1969": 4.56,
            "1970": 3.35,
            "1971": 2.7,
            "1972": 4.99,
            "1973": 7.49,
            "1974": 11,
            "1975": 10.67,
            "1976": 7.54,
            "1977": 7.98,
            "1978": 8.97,
            "1979": 9.14,
            "1980": 10.13,
            "1981": 12.47,
            "1982": 10.77,
            "1983": 5.86,
            "1984": 4.3,
            "1985": 3.96,
            "1986": 4.19,
            "1987": 4.36,
            "1988": 4.03,
            "1989": 4.98,
            "1990": 4.78,
            "1991": 5.63,
            "1992": 1.49,
            "1993": 1.87,
            "1994": 0.17,
            "1995": 2.15,
            "1996": 1.57,
            "1997": 1.62,
            "1998": 1,
            "1999": 1.73,
            "2000": 2.72,
            "2001": 2.53,
            "2002": 2.26,
            "2003": 2.76,
            "2004": 1.86,
            "2005": 2.21,
            "2006": 2,
            "2007": 2.14,
            "2008": 2.37,
            "2009": 0.3,
            "2010": 1.78,
            "2011": 2.91,
            "2012": 1.52,
            "2013": 0.94,
            "2014": 1.91,
            "2015": 1.13,
            "2016": 1.43,
            "2017": 1.6,
            "2018": 2.27,
            "2019": 1.95,
            "2020": 0.72,
            "2021": 3.4,
            "2022": 3.4,
        };
        if (isNaN(parseInt(v1, 10))) {
            alert("Please only enter amounts with integers here.");
            return false;
        }
        if (y1 >= y2) {
            alert("The final year must be after the first year.");
            return false;
        }
        var v1 = parseInt(v1, 10),
            v2 = v1;
        for (y = y1; y < y2; y++) {
            v2 += (v2 / 100) * parseFloat(rates[y], 10);
            jahre++;
        }
        if (v2 >= v1) {
            ps = Number.parseFloat(((v2 - v1) * 100) / v1).toFixed(1);
            d.getElementById("ps").innerHTML = "Price increase (= depreciation) in " + jahre + " years: <b>" + ps + "%</b>";
            d.getElementById("avgps").innerHTML = "This corresponds to an average depreciation of " + Number.parseFloat((v2 - v1) / jahre).toFixed(2) + " " + cur + " p.a..";
        } else {
            ps = Number.parseFloat(((v1 - v2) * 100) / v1).toFixed(1);
            d.getElementById("ps").innerHTML = "Price decline (= increase in value) in " + jahre + " years: <b>" + ps + "%</b>";
            d.getElementById("avgps").innerHTML = "This corresponds to an average increase in value of " + Number.parseFloat((v1 - v2) / jahre).toFixed(2) + " " + cur + " p.a..";
        }
        if (y2 > 2020) {
            d.getElementById("est_hint").style.display = "block";
        } else {
            d.getElementById("est_hint").style.display = "none";
        }
        d.getElementById("w2").innerHTML = "Value at the beginning of " + y2 + ": <b>" + Number.parseFloat(v2).toFixed(2) + " " + cur + "</b>";
        d.getElementById("infresult").style.display = "block";
        return false;
    }
        
        
        
        $('#inflauationAmount').on('change', function() {
            inflationCalc();
        });
        $('#inflauationStartYear').on('change', function() {
            inflationCalc();
        });
        $('#inflauationEndYear').on('change', function() {
            inflationCalc();
        });
        $('#inflauationCalculatorSubmit').on('click', function() {
            inflationCalc();
        });
        $("#inflauationAmount").keyup(function(){
          inflationCalc();
        });

        
    });
     
})(jQuery);
