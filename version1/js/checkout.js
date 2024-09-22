function pop_up_form_address() {
    $(".update-address-fill").show();
    $("#postal_code").val("");
    $("#street").val("");
    $("#country").val("");
    $("#city").val("");
    $("#state").val("");
    showMap();
}

function cancel() {
    $(".update-address-fill").hide();
}

function showMap() {
    $('#maps').show();
   
    setTimeout(function() {
        map.invalidateSize();
    }, 100);

    centerMapOnUserLocation();
}


//address form-----------------------------------------------------------------------------------------------
function save_address() {
    const city = $.trim($("#city").val());
    const postal = $.trim($("#postal_code").val());
    const state = $.trim($("#state").val());
    const street = $.trim($("#street").val());
    const country = $.trim($("#country").val());
    

    // const addressDetail = $.trim($("#locationInput").val());

    if (city === "" || postal === "" || street === "" || state === ""  || country === "") {
        alert("Please fill in all fields!");
    } else {
        const assembly_address = street + ", " + postal + ", "+ city + ", " + state + ", "+ country;
        $("#valueUpated").val(assembly_address);
        $(".owner-address").text(assembly_address);
        $(".update-address-fill").hide();
        alert("Updated successfully");
    }
}

//ship method form-----------------------------------------------------------------------------------------------

$(document).ready(function() {

    let payText = $('#pays').text(); 
    const amount = parseFloat(payText.replace('RM', '').trim()); 

    $('#totals').val(amount);

    $('.shipMethod').on('change', function() {
        let total = amount;
        const shippingMethod = $('input[name="shipMethod"]:checked').val();

        if (shippingMethod === 'pick') {
            total += 1.60; 
        } else if (shippingMethod === 'door') {
            total += 4.60; 
        }
        $('#pays').text(`RM${total.toFixed(2)}`);
        $('#totals').val(total);
    });
});
