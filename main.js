 // Popup Open
 function popupOpen() {
    document.getElementById("openbox").style.display = "block";
    document.getElementById("overlay").style.display = "block";
}
// Popup Close
function popupClose() {
    document.getElementById("openbox").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

jQuery(document).on("click", '.featuredimg', function(){
    if (jQuery(this).is(':checked')) {
        jQuery('.hidden_input').attr("type", "text");
        jQuery('.hidden_input').attr("required", true);
    }
    else{
        jQuery('.hidden_input').attr("type", "hidden");
        jQuery('.hidden_input').attr("required", false);

    }
})