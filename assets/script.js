(function($){

    if(!$("#calculator-app").length){
        return;
    }
    
    
    $(document).ready(function(){
        
        
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
    

     
})(jQuery);
