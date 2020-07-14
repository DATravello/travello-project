<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">


</head>

<style>
    #shiva {
        width: 100px;
        height: 100px;
        background: red;
        -moz-border-radius: 50px;
        -webkit-border-radius: 50px;
        border-radius: 50px;
        float: left;
        margin: 5px;
    }

    .count {
        line-height: 100px;
        color: white;
        margin-left: 30px;
        font-size: 25px;
    }

    #talkbubble {
        width: 120px;
        height: 80px;
        background: red;
        position: relative;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        float: left;
        margin: 20px;
    }

    #talkbubble:before {
        content: "";
        position: absolute;
        right: 100%;
        top: 26px;
        width: 0;
        height: 0;
        border-top: 13px solid transparent;
        border-right: 26px solid red;
        border-bottom: 13px solid transparent;
    }

    .linker {
        font-size: 20px;
        color: black;
    }
</style>

<body>
    <script>
        $(document).ready(function() {
            $("#depart").datepicker({
                showAnim: 'drop',
                numberOfMonth: 1,
                dateFormat: 'dd-mm-yy',
                onClose: function(selectedDate) {
                    $('return').datepicker("option", "minDate", selectedDate);
                }

            })
        })

        function animateValue(obj, start = 0, end = null, duration = 3000) {
            if (obj) {

                // save starting text for later (and as a fallback text if JS not running and/or google)
                var textStarting = obj.innerHTML;

                // remove non-numeric from starting text if not specified
                end = end || parseInt(textStarting.replace(/\D/g, ""));

                var range = end - start;

                // no timer shorter than 50ms (not really visible any way)
                var minTimer = 50;

                // calc step time to show all interediate values
                var stepTime = Math.abs(Math.floor(duration / range));

                // never go below minTimer
                stepTime = Math.max(stepTime, minTimer);

                // get current time and calculate desired end time
                var startTime = new Date().getTime();
                var endTime = startTime + duration;
                var timer;

                function run() {
                    var now = new Date().getTime();
                    var remaining = Math.max((endTime - now) / duration, 0);
                    var value = Math.round(end - (remaining * range));
                    // replace numeric digits only in the original string
                    obj.innerHTML = textStarting.replace(/([0-9]+)/g, value);
                    if (value == end) {
                        clearInterval(timer);
                    }
                }

                timer = setInterval(run, stepTime);
                run();
            }
        }

        animateValue(document.getElementById('value'));
    </script>
    <div class="container">
    <form action="" method="post">
        <input type="text" id="depart" placeholder="Depart">
        <input type="text" name="datepick" id="return">
    </form>


    <div id="value">+300% gross margin</div>

    </div>

</body>

</html>