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
     
})(jQuery);
