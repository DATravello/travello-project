function previewImage() {
    var file = document.getElementById("file").files;
    if (file.length > 0) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById("previewImg").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(file[0]);
    }
}

function previewImage2() {
    var file = document.getElementById("file2").files;
    if (file.length > 0) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById("previewImg2").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(file[0]);
    }
}