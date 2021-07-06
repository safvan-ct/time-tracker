<script>
    let timer;

    function timeStart(id){

        var action = "{{ route('task.start', ':id') }}";
        action = action.replace(':id', id);
        $.ajax({
            url: action,
            type: "get",
            success: function(response) {

            }
        });

        let millisecound = 0;
        const watch = document.querySelector("#stopwatch"+id);
        document.getElementById("start"+id).disabled = true;
        document.getElementById("pause"+id).disabled = false;

        watch.style.color = "#0f62fe";
        clearInterval(timer);
        timer = setInterval(() => {
            millisecound += 10;

            let dateTimer = new Date(millisecound);

            watch.innerHTML =
            ('0'+dateTimer.getUTCHours()).slice(-2) + ':' +
            ('0'+dateTimer.getUTCMinutes()).slice(-2) + ':' +
            ('0'+dateTimer.getUTCSeconds()).slice(-2);
        }, 10);
    }


    function timePaused(id) {
        const watch = document.querySelector("#stopwatch"+id);
        var total = watch.innerHTML;

        var action = "{{ route('task.stop', [':id', ':total']) }}";
        action = action.replace(':id', id);
        action = action.replace(':total', total);
        $.ajax({
            url: action,
            type: "get",
            success: function(response) {
                location.reload();
            }
        });
        document.getElementById("start"+id).disabled = false;
        document.getElementById("pause"+id).disabled = true;
        watch.style.color = "red";
        clearInterval(timer);
    }
</script>
