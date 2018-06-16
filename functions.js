function add_to_cart(product_id) {
    jQuery.ajax({
        type: "POST",
        url: "add_to_cart.php",
        data: { product_id: product_id },
      
    });



}

function remove_from_cart(product_id) {
    jQuery.ajax({
        type: "POST",
        url: "remove_from_cart.php",
        data: { product_id: product_id },
    });

    document.getElementById("cart_block_" + product_id).remove();

}

function change_count(product_id, product_count) {
    jQuery.ajax({
        type: "POST",
        url: "change_count.php",
        data: { product_id: product_id, product_count: product_count.value },
    });
}

function send() {

}
function logout(){
     jQuery.ajax({
        type: "POST",
        url: "logout.php",
        data: {  },
    });
}

function remove_enrity(product_id){
     jQuery.ajax({
        type: "POST",
        url: "remove_enrity.php",
        data: { product_id: product_id },
    });
}


