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
