<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="plugins/counterJquery/animationCounter.js"></script>


</head>

<style>

</style>



<div class="value">100</div>
<script>
    $('.value').animationCounter({
        start: 0,
        end: 30,
        delay: 50,
    });
</script>