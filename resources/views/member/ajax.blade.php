<script>
    @if(Auth::guard('member')->check())
        @php
            $get = new \App\Member();
            $student_id = $get->getStudentId();
        @endphp

    $(document).ready(function() {
        dataTableInit();
    });



    function dataTableInit() {
        $(".loader-ajax").fadeOut("slow").show();
        manageTable =   $("#list").DataTable({
            "ajax": "{{route('allResultById',$student_id)}}",
            "method": "get",
            "order": [],
            responsive: true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',

            buttons:[
                {
                    extend:"excel",
                    className:"btn bg-excel btn-flat margin",
                    text: '<img src="{{asset('public/images/icons/excel.svg')}}">',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
                ,{
                    extend:"pdf",
                    className:"btn bg-red btn-flat margin",
                    text: '<img src="{{asset('public/images/icons/pdf.svg')}}">',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                }
            ]
        });
        $('#list_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#list_wrapper .dataTables_filter').find('input').each(function () {
            // $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#list_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#list_wrapper .dataTables_filter').addClass('md-form');
        $('#list_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
        $('#list_wrapper select').addClass('mdb-select');
        $('#list_wrapper .mdb-select').material_select();
        $('#list_wrapper .dataTables_filter').find('label').remove();
        $(".loader-ajax").hide();
    }
    @endif


    function resetVideo() {
        $("#theory_video").empty();
        $("#solve_example_video").empty();
    }

    $('#modalYT').on('hidden.bs.modal', function () {
        $("#theory_video").empty();
        $("#solve_example_video").empty();
    });

    function getTheoryLink(id = null) {
        if (id) {
            $(".loader-ajax").fadeOut("slow").show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{route('getTheoryLink')}}',
                type: 'post',
                data: {id:id},
                dataType: 'json',

                success:function(response) {
                    $("#solve_example_video").hide();
                    $("#theory_video").show();
                    $("#theory_video").empty();
                    $("#theory_video").append(response.theory_link);
                    $(".loader-ajax").hide();
                }
            });
        }
        else {
            return false;
        }
    }

    function getSolveExampleLink(id = null) {
        if (id) {
            $(".loader-ajax").fadeOut("slow").show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '{{route('getSolveExampleLink')}}',
                type: 'post',
                data: {id:id},
                dataType: 'json',

                success:function(response) {
                    $("#solve_example_video").show();
                    $("#theory_video").hide();
                    $("#solve_example_video").empty();

                    $("#solve_example_video").append(response.solve_example_link);
                    $(".loader-ajax").hide();
                }
            });
        }
        else {
            return false;
        }
    }

    $("#submitBtn").on('click', function() {
        $(".loader-ajax").fadeOut("slow").show();
        $("#testForm").unbind('submit').bind('submit', function() {

             form = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             postData = new FormData($("#testForm")[0]);
            $.ajax({
                cache:false,
                contentType: false,
                processData: false,
                url : form.attr('action'),
                type : form.attr('method'),
                dataType : 'json',
                data : postData,
                success:function(response) {
                    /**
                     * Disabled List Group
                     * @type {string}
                     */
                    list = 'questions-list';
                    list_group = document.getElementsByClassName(list);
                    let disabled = "disabled";

                    for (let i = 0; i < list_group.length; ++i) {
                        let list_item = list_group[i];

                        arr = list_item.className.split(" ");
                        if (arr.indexOf(disabled) == -1) {
                            list_item.className += " " + disabled;
                        }
                    }



                    response.correctAnswers.forEach(changeStyle);

                    function changeStyle(item, index){
                        question = item[0];
                        option = item[1];
                        correctOrWrong = item[2];

                        option = 'li'+option;


                        ans = document.getElementById(option);

                        let correct = "correct";
                        let wrong = "wrong";

                        if (correctOrWrong == 1)
                        {
                            arr = ans.className.split(" ");
                            if (arr.indexOf(correct) == -1) {
                                ans.className += " " + correct;
                            }
                        }
                        else {

                            arr = ans.className.split(" ");
                            if (arr.indexOf(wrong) == -1) {
                                ans.className += " " + wrong;
                            }
                        }

                    }


                    getResult(response.result);
                    getSolutions(response.data);


                    if(response.success == true) {
                        toastr.success(response.messages, '', {timeOut: 3000});
                        $("#testForm")[0].reset();
                        $(".loader-ajax").hide();
                    }
                    else
                    {
                        toastr.error(response.messages, 'Error', {timeOut: 3000});
                        $(".loader-ajax").hide();
                    }
                } // success
            }); // ajax subit

            return false;
        }); // /submit form for create member
    });

    alert_message = '{{$alert}}';

    if (alert_message !== "" )
    {
        toastr.info(alert_message, '', {timeOut: 3000});
    }

    function getResult(item) {

        $(".loader-ajax").fadeOut("slow").show();

        attempt_quest = document.getElementById('attempt_quest');
        correct = document.getElementById('correct');
        marks = document.getElementById('marks');
        duration = document.getElementById('duration');


        attempt_quest.innerHTML = "";
        correct.innerHTML = "";
        marks.innerHTML = "";
        duration.innerHTML = "";

        attempt_quest.append(item['attempt_quest']);
        correct.append(item['correct']);
        marks.append(item['marks']);
        duration.append(item['duration']);
    }

    function getSolutions(data) {

        $(".loader-ajax").fadeOut("slow").show();
        $.ajax({
            url: '{{route('getSolutions')}}',
            type: 'post',
            data: data,
            dataType: 'json',
            success:function(response) {
                $(".loader-ajax").hide();

                response.forEach(showSolutions);

                function showSolutions(item, index){

                    answer = document.getElementById('correct'+item.question_id);
                    solution = document.getElementById('solution'+item.question_id);

                    answer.innerHTML = "";
                    answer.append(item['answer']);

                    solution.innerHTML = "";
                    solution.append(item['solution']);

                }

                /**
                 * Disabled List Group
                 * @type {string}
                 */
                list = 'solution-panel';
                list_group = document.getElementsByClassName(list);
                let disabled = "re-show";

                for (let i = 0; i < list_group.length; ++i) {
                    let list_item = list_group[i];

                    arr = list_item.className.split(" ");
                    if (arr.indexOf(disabled) == -1) {
                        list_item.className += " " + disabled;
                    }
                }

                $timer = document.getElementById('timer');
                let hide_timer = "un-show";

                arr = $timer.className.split(" ");
                if (arr.indexOf(hide_timer) == -1) {
                    $timer.className += " " + hide_timer;
                }

                $submitBtnContainer = document.getElementById('submitBtnContainer');
                let hide_btn = "un-show";

                arr = $submitBtnContainer.className.split(" ");
                if (arr.indexOf(hide_btn) == -1) {
                    $submitBtnContainer.className += " " + hide_btn;
                }
            }
        });

    }




</script>
