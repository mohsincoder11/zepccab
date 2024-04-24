<script type="text/javascript" src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('public/js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="{{asset('public/js/addons/datatables.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('public/js/mdb.min.js')}}"></script>
<script src="{{asset('public/js/cookies.js')}}"></script>
<script src="{{asset('public/js/editor.js')}}"></script>


<script src="{{asset("public/datatables/1.10.16/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("public/datatables/1.10.16/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/Buttons-1.5.1/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/Buttons-1.5.1/js/buttons.bootstrap4.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/ajax/libs/jszip/3.1.3/jszip.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/ajax/libs/pdfmake/0.1.32/pdfmake.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/ajax/libs/pdfmake/0.1.32/vfs_fonts.js")}}"></script>
<script src="{{asset("public/datatables/extensions/Buttons-1.5.1/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/Buttons-1.5.1/js/buttons.print.min.js")}}"></script>
<script src="{{asset("public/datatables/extensions/Buttons-1.5.1/js/buttons.colVis.min.js")}}"></script>

<script>
    $(document).ready(function() {
        $('.edit-remark').richText();
    });
</script>


<!-- Initializations -->
<script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

     // Material Select Initialization
    $(document).ready(function () {
        $('.mdb-select').material_select();
    });
	

    // Data Picker Initialization
    $('.datepicker').pickadate();
    $('#input_starttime').pickatime({});
    //$('.file-upload').file_upload();


    // Tooltip Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>


<!-- Alerts -->
<script>
    $(function () {
        $('#folder-1').click(function () {
            toastr.error("Folder 1 has been clicked!", "Folder 1", {
                "positionClass": "toast-top-right",
            });
        });
        $('#folder-2').click(function () {
            // make it not dissappear
            toastr.info("Folder 2 has been clicked!", "Folder 2", );
        });
        $('#folder-3').click(function () {
            // make it not dissappear
            toastr.info("Folder 3 has been clicked!", "Folder 3", );
        });
    });


</script>

<script>

</script>

