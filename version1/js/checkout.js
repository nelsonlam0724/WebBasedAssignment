function pop_up_form_address() {
    $(".update-address-fill").show();
    $("#locationInput").val("");
    $("#receipent_namej").val("");
    $("#shippingPhonej").val("");
}

function cancel() {
    $(".update-address-fill").hide();
}

//address form-----------------------------------------------------------------------------------------------
function save_address() {
    const name = $.trim($("#receipent_namej").val());
    const tel = $.trim($("#shippingPhonej").val());
    const state = $.trim($("#state").val());
    const addressDetail = $.trim($("#locationInput").val());

    if (name === "" || tel === "" || addressDetail === "" || state === "") {
        alert("Please fill in all fields!");
    } else {
        const assembly_address = addressDetail + " " + state;
        $("#valueUpated").val(assembly_address);
        $("#receipent_name").val(name);
        $("#shippingPhone").val(tel);
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
