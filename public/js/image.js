$("body").on("change", 'input[type="file"]', function(e) {
    let file = e.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = e => {
            $(this)
                .closest("div")
                .next()
                .remove();
            $(this)
                .closest("div")
                .after('<img src="' + e.target.result + '" width="120px"/>');
        };
        reader.readAsDataURL(file);
    } else {
        $(this)
            .closest("div")
            .next()
            .remove();
        $(this)
            .closest("div")
            .after(
                '<img src="https://via.placeholder.com/120x80.png" width="120px"/>'
            );
    }
});
