<script>

function previewImage() {
    var file = document.getElementById("file").files;
    if(file.length > 0) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById("previewImg").setAttribute("src", e.target.result);
        };

        reader.readAsDataURL(file[0]);
    }
}

</script>

<form action="">
<img id="previewImg">
<input type="file" name="HinhAnh" id="file" accept="image/*" onchange="previewImage()">
</form>