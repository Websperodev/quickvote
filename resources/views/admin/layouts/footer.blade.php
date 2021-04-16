<!-- Footer Start -->
<script>
    var startDate;
    $("#startdate1").datetimepicker({
        timepicker: true,
        closeOnDateSelect: false,
        closeOnTimeSelect: true,
        initTime: true,
        format: 'm/d/Y H:i',
        minDate: 0,
        roundTime: 'ceil',
        onChangeDateTime: function (dp, $input) {
            startDate = $("#startdate1").val();
        }
    });
    $("#enddate1").datetimepicker({
        timepicker: true,
        closeOnDateSelect: false,
        closeOnTimeSelect: true,
        initTime: true,
        format: 'm/d/Y H:i',
        minDate: 0,
        roundTime: 'ceil',
        onClose: function (current_time, $input) {
            var endDate = $("#enddate1").val();
            if (startDate > endDate) {
                $('#enddate1').val('');
                $('#closedateerror').html('<p style="color:red;">Close date should be greater than start date');
            }
        }
    });
</script>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                &copy; {{date('Y')}} - Quickvote - All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->