$('body').on('change', 'input[type="file"]', function (e) {
    let file = e.target.files[0];
    if(file){
        let reader = new FileReader();
            reader.onload = (e) => {
                $(this).closest('div').next().remove();
                $(this).closest('div').after('<img src="'+e.target.result+'" width="120px"/>');
            }
            reader.readAsDataURL(file);
    } else{
        $(this).closest('div').next().remove();
        $(this).closest('div').after('<img src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" width="120px"/>');
    }
});