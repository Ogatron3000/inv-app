function fillSerialNumbers(currentSerialNumber = null){
    let equipment_id = $("#equipment_select").val();
    if(equipment_id === ''){
        $("#serial_number_select").html('');
        return;
    }
    $.ajax({
       'url' : '/serial-numbers-by-equipment/' + equipment_id,
       'type' : 'GET',
       'success': (response) => {
           let serialNumbers = response;
           let options = '';
           serialNumbers.forEach((sn) => {
               let selected = '';
               if(currentSerialNumber && currentSerialNumber === sn.serial_number) selected = 'selected';
               options += `<option value=\"${sn.id}\" ${selected}>${sn.serial_number}</option>`;
           });
           $("#serial_number_select").html(options);
       }
    });
}
