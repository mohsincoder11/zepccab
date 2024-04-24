@extends('member.layout.auth')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    TEST: MATHARON
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    <form id="testForm" action="{{route('submitTest')}}" method="POST">
        {{csrf_field()}}

    <div id="timer" class="fa-pull-right">
        <button type="button" class="btn btn-warning btn-rounded">
            <span class="time"> </span>
        </button>
    </div>
     <div id="back_button" class="fa-pull-right solution-panel un-show">
        <a href="{{url('member/home')}}" type="button" class="btn btn-warning btn-rounded">
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
@endsection

@php
    $get = new \App\Member();
    $x = 0;
    $y = 0;
    $queNo=1;

$student_id = $get->getStudentId();

    if (count($questions_data)> 0)
    {
          foreach($questions_data as $question)
          {
           $questions[]= $question;
          }
    }
    else
    {
        $questions = array();
        $exam_data= array();
    }

    if (count($questions_data)> 0)
    {
        $displayLimit = $exam_data['display_questions'];
        $total_marks = $exam_data['total_marks'];

            $quizID = $exam_data['id'];
            $totalTime = $exam_data['duration'];
            $totalTime = $totalTime*60;

        if (isset($_SESSION['TIMER']))
            {
                $timer=$_SESSION['TIMER'];
               }
            else
            {
                $timer= time()+ $totalTime;
                $_SESSION['TIMER']= $timer;
                $timer=$_SESSION['TIMER'];
            }
            $cookie_name ='timer';
            $cookie_value =$timer;

        if(!isset($_COOKIE[$cookie_name])) {
           setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        } else {
            $timer= $_COOKIE[$cookie_name];
        }
    }
    else
    {
        return redirect()->back()->with('msg','Start Test Again');
    }

if ($errors->any())
    {
        $alert = $errors->first();
    }
    else
    {
        $alert = null;
    }
@endphp


@section('content')
            @include('layouts.loader')
            <input type="hidden" name="member_id" value="{{$student_id}}">
            <input type="hidden" name="total_ques" value="{{$displayLimit}}">
            <input type="hidden" name="total_ques_display_in_exam" value="{{count($questions)}}">
            <input type="hidden" name="total_marks" value="{{$total_marks}}">
            <input type="hidden" name="total_time" value="{{$totalTime}}">
            <input type="hidden" name="exam_id" value="{{$quizID}}">

    <div class="" style="margin-top: -50px;">
        <!-- Main docs tabs -->
        <div class="main-tabs-docs">
            <!-- Nav tabs -->
            <div class="tab-content">
                <!--API-->
                <div class="tab-pane fade in active show" id="docsTabsOverview" role="tabpanel">
                    <!--Grid row-->
                    <div class="row">
                        <!-- Card -->

                        <div class="col-8 offset-4">
                            <div class="card w-50 mb-3 solution-panel un-show">

                                <div class="card testimonial-card" >

                                    <!-- Background color -->
                                    <div class="card-up indigo lighten-1"><h5 class="text-center white-text mt-2">Result</h5></div>

                                    <!-- Content -->
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="card-text">Questions Attempt:</span>
                                                <h6 class="card-title green-text" >
                                                    <span id="attempt_quest"></span>
                                                </h6>
                                            </div>
                                            <div class="col-6">
                                                <span class="card-text">Correct:</span>
                                                <h6 class="card-title text-default">
                                                    <span id="correct"></span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="card-text">Marks:</span>
                                                <h6 class="card-title text-default">
                                                    <span id="marks"></span>
                                                    <span >/{{$total_marks}}</span>
                                                </h6>
                                            </div>
                                            <div class="col-6">
                                                <span class="card-text">Time Taken:</span>
                                                <h6 class="card-title text-default">
                                                    <span id="duration"></span>
                                                </h6>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>
                        </div>

                        <blockquote class="blockquote bq-success solution-panel un-show">
                            <p class="bq-title"> Test Review : View answers and explanation for this test.</p>
                        </blockquote>

                        <div class="col-lg-12 col-md-12">
                            @if(count($questions) == 0)

                                <p class="border border-danger p-3">
                                    <strong>
                                        <span class="font-weight-normal">There are no content</span>
                                    </strong></p>
                            @endif
                        <!--Section: Docs content-->


                            <section class="documentation">
                            @if(count($questions) > 0)
                                    @foreach($questions as $question)
                                        @php

                                            $question = array_first($question);

                                            $question_id = $question->id;

                                            $question_no = $queNo++;
                                            $question_name = $question->question;
                                            $contents = $get->getQuestionOptionsById($question_id);

                                        @endphp

                                        <input type="hidden" name="question_ids[]" value="{{$question_id}}">
                                        <div class="accordion" id="accordionEx{{$question_id}}" role="tablist" aria-multiselectable="true">

                                            <!-- Accordion card -->
                                            <div class="card">

                                                <!-- Card header -->
                                                <div class="card-header" role="tab" id="chapter-{{$question_id}}">
                                                    <a class="collapsed" data-toggle="collapse" href="#chapter-collapse-{{$question_id}}" aria-expanded="false" aria-controls="collapseThree">
                                                        <h6 class="mb-0"><b class="black-text">{{++$x}}. </b> {{$question_name}}
                                                            <i class="fa fa-angle-down rotate-icon"></i>
                                                        </h6>
                                                    </a>
                                                </div>

                                                <!-- Card body -->
                                                <div id="chapter-collapse-{{$question_id}}" class="collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordionEx{{$question_id}}">
                                                    <div class="card-body">

                                                        <ul class="list-group questions-list">
                                                            <br>
                                                            @foreach($contents as $option)

                                                                <li class="list-group-item list-group-item-action d-flex nav-link" id="li{{$option->id}}">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input" id="option-{{$option->id}}" name="ans{{$question_no}}" value="{{$option->id}}">
                                                                        <label class="form-check-label" for="option-{{$option->id}}">
                                                                                {{$option->answer}}
                                                                        </label>
                                                                    </div>
                                                                </li>


                                                            @endforeach
                                                        </ul>
                                                        <br>
                                                        <div class="card w-100 mb-3 solution-panel un-show">
                                                            <div class="card-body">
                                                                <span class="card-text">Correct answer:</span>
                                                                <h6 class="card-title green-text" >
                                                                    <span id="correct{{$question_id}}"></span>
                                                                </h6>

                                                            </div>
                                                            <div class="card-body">
                                                                <span class="card-text">Explanation:</span>
                                                                <h6 class="card-title text-default">
                                                                    <span id="solution{{$question_id}}"></span>
                                                                </h6>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Accordion card -->

                                        </div>
                                        <!--/.Accordion wrapper-->
                                    @endforeach
                                @endif

                            </section>
                            <!--Section: Docs content-->

                        </div>
                    </div>
                    <!--Grid row-->

                </div>

            </div>
        </div>
    </div>

            <div  class="fa-pull-left" id="submitBtnContainer">
                <button id="submitBtn" type="submit" class="btn btn-warning btn-rounded">
                    <i class="fa fa-upload">  </i> Submit Test
                </button>
            </div>

    </form>
    <section id="fixed-buttons">
        <!--Section: Live preview-->
        <section>
            <div class="fixed-action-btn" >
                <a href="#" onclick="openQuestionList()"  class="btn-floating btn-lg black waves-effect waves-light" >
                    <i class="fa fa-gear"></i>
                </a>
            </div>
        </section>
    </section>

    <div class="modal fade" id="modalQL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-height modal-right modal-notify  bg-orange" role="document">
            <div class="modal-content bg-orange">
                <!--Header-->
                <div class="modal-header bg-orange">
                    <p class="heading lead">Questions List
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                @if(count($questions) > 0)
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                @foreach($questions as $question)
                                    @php
                                        $question = array_first($question);
                                        $question_id = $question->id;
                                        $question_name = $question->question;
                                    @endphp
                                <div class="btn-group" role="group" aria-label="First group">
                                    <a href="#chapter-{{$question_id}}"><button type="button" class="btn btn-default"><b class="white-text">{{++$y}}</b></button></a>
                                </div>
                                @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('member.ajax')

    <script>
        $(function () {
            $(".sticky").sticky({
                topSpacing: 90
                , zIndex: 2
            });
        });
    </script>
    <script>

        window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "You have attempted to leave this page. Are you sure?";
        }
        // Tooltips Initialization
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        function test_submit(){
            window.onbeforeunload = null;
            document.getElementById('submitBtn').click();
        }

        function openQuestionList(){
            $('#modalQL').modal('show');
        }

        // Open Question List
        $('ul.list-group li').click( function() {
            $redio = $(this).find(":radio");
            if (!$redio.prop("checked")) {
                $redio.prop("checked", true);
                return true;
            } else {
                $redio.prop("checked", false);
                return false;
            }
        });

        $('ul.list-group li .form-check-label').click( function() {
            $redio = $(this).prev('.form-check-input');
            if (!$redio.prop("checked")) {
                $redio.prop("checked", true);
                return false;
            } else {
                $redio.prop("checked", false);
                return false;
            }
        });
    </script>
    <script>
        TimeLimit = new Date('{{ date('r',$timer)}}');
        function timer(){
            ele = document.getElementById("timer");
            $(ele).addClass('display-digit');
            date = Math.round((TimeLimit - new Date())/1000);
            hours = Math.floor(date/3600);
            date = date - (hours*3600);
            mins= Math.floor(date/60);
            date = date - (mins*60);
            secs = date;

            time = ele.querySelector('.time');

            time.innerHTML = ('0' + hours).slice(-2)+':'+('0' + mins).slice(-2)+':'+('0' + secs).slice(-2);

            if(date <= 0 &&  hours <=0 && mins <=0 && secs <= 0   ){
                test_submit();
            } else {
                if (hours < 0 ) {
                    time.innerHTML = 'EXPIRED';
                }
                else {
                    setTimeout('timer()',1000);
                }
            }
        }


        timer();
    </script>
@endsection

