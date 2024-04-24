@extends('member.layout.auth')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    HOME: MATHARON
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    @include('layouts.member-header')
@endsection

@php
    $get = new \App\Member();
    $x = 0;
    $y = 0;

    if (count($sub_topics) > 0){
     $sub_topic_one = array_first($sub_topics);

    $chapter_id = $sub_topic_one->chapter_id;
    $topic_id = $sub_topic_one->topic_id;

     $chapter_name = $get->getChapterNameById($chapter_id);

     $topic_name =  $get->getTopicNameById($topic_id);
     $path = 'course/content/'.$chapter_id.','.$topic_id;
     $student_id = $get->getStudentId();


            $student_info = \App\Student::find($student_id);
            $plan_id = $student_info->plan_id;
     $subscription_days = $get->getRemainingSubscription($student_id);

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

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('explore-contents')}}">Course Content</a></li>
        @if(count($sub_topics) > 0)
        <li class="breadcrumb-item"><a href="{{url($path)}}">{{$chapter_name}}</a></li>
        <li class="breadcrumb-item active">{{$topic_name}}</li>
        @endif
    </ol>
    <div class="">
        <!-- Main docs tabs -->
        <div class="main-tabs-docs">
            <!-- Nav tabs -->
            <ul class="nav nav-mtd tabs-orange z-depth-1" role="tablist">
                <li class="nav-item">
                    <a id="docs-tab-overview" class="nav-link waves-light waves-effect waves-light active show  text-white m-1" data-toggle="tab" href="#docsTabsOverview" role="tab" aria-selected="true"><i class="fa fa-book mr-2"></i>Explore</a>
                </li>
            </ul>
            <div class="tab-content">
                <!--API-->
                <div class="tab-pane fade in active show" id="docsTabsOverview" role="tabpanel">


                <!--Grid row-->
                    <div class="row">
                        <div class="col-md-2">
                            <!-- Sticky content -->
                        @if(count($sub_topics) > 0)
                            <!--Scrollspy-->
                            <div id="scrollspy" class="sticky">
                                <!-- Links -->
                                <ul class="nav nav-pills default-pills smooth-scroll  z-depth-1 pin-card" data-allow-hashes="true">
                                    @foreach($sub_topics as $sub_topic)
                                        <li class="nav-item"><a class="nav-link" href="#chapter-{{$sub_topic->id}}"><b>>></b> {{$sub_topic->name}}</a></li>
                                    @endforeach
                                </ul>
                                <!-- Links -->
                            </div>
                        @endif
                        </div>

                        <div class="col-lg-10 col-md-12">
                            @if(count($sub_topics) == 0)

                                <p class="border border-danger p-3">
                                    <strong>
                                        <span class="font-weight-normal">There are no content</span>
                                    </strong></p>
                             @endif
                            <!--Section: Docs content-->
                            <section class="documentation">
                            @if(count($sub_topics) > 0)
                                 @foreach($sub_topics as $sub_topic)
                                <!--Accordion wrapper-->
                                    @php
                                        $contents = $get->getCourseContentById($sub_topic->chapter_id,$sub_topic->topic_id,$sub_topic->id);

                                    @endphp
                                    <div class="accordion" id="accordionEx{{$sub_topic->id}}" role="tablist" aria-multiselectable="true">
                                        <!-- Accordion card -->
                                        <div class="card">

                                            <!-- Card header -->
                                            <div class="card-header" role="tab" id="chapter-{{$sub_topic->id}}">
                                                <a class="collapsed" data-toggle="collapse" href="#chapter-collapse-{{$sub_topic->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                    <h6 class="mb-0">{{$sub_topic->name}}
                                                        <i class="fa fa-angle-down rotate-icon"></i>
                                                    </h6>
                                                </a>
                                            </div>

                                            <!-- Card body -->
                                            <div id="chapter-collapse-{{$sub_topic->id}}" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordionEx{{$sub_topic->id}}">
                                                <div class="card-body">

                                                    <ul class="list-group">
                                                        <br>
                                                        @foreach($contents as $content)
                                                            <div class="steps-form-2">
                                                                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
                                                                    <div class="steps-step-2">

                                                                        <a href="#step-{{$x++}}" type="button" class="btn btn-grey btn-circle-2 steps-icon-btn waves-effect ml-0" data-toggle="tooltip" data-placement="top" title="Theory">
                                                                            <i class="fa fa-book" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="steps-step-2">
                                                                        <a href="#step-{{$x++}}" type="button" class="btn btn-blue-grey btn-circle-2 steps-icon-btn waves-effect" data-toggle="tooltip" data-placement="top" title="Solve Example">
                                                                            <i class="fa fa-file" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="steps-step-2">
                                                                        <a href="#step-{{$x++}}" type="button" class="btn btn-blue-grey btn-circle-2 steps-icon-btn waves-effect mr-0" data-toggle="tooltip" data-placement="top" title="Test">
                                                                            <i class="fa fa-medkit" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <!-- Stepper -->
                                                                <!-- First Step -->
                                                                    <form id="preTestActionForm" role="form" action="{{route('preTestAction')}}" method="post">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="count" value="1">
                                                                        <input type="hidden" name="chapter_id" value="{{$sub_topic->chapter_id}}">
                                                                        <input type="hidden" name="topic_id" value="{{ $sub_topic->topic_id}}">
                                                                        <input type="hidden" name="sub_topic_id" value="{{ $sub_topic->id}}">
                                                                        <input type="hidden" name="member_id" value="{{ $student_id}}">

                                                                        <div class="row setup-content-2" id="step-{{$y++}}">
                                                                            <div class="col-md-12">
                                                                                <a class="btn-floating btn-lg bg-danger" data-toggle="modal" data-target="#modalYT" onclick="getTheoryLink({{$content->id}})"><i class="fa fa-youtube"></i></a> Theory Video
                                                                                <br>
                                                                                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Next</button>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Second Step -->
                                                                        <div class="row setup-content-2" id="step-{{$y++}}">
                                                                            <div class="col-md-12">
                                                                                <a class="btn-floating btn-lg bg-danger" data-toggle="modal" data-target="#modalYT" onclick="getSolveExampleLink({{$content->id}})"><i class="fa fa-youtube"></i></a> Solve Example Video
                                                                                <br>
                                                                                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Previous</button>
                                                                                <button class="btn btn-mdb-color btn-rounded nextBtn-2 float-right" type="button">Next</button>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Fourth Step -->
                                                                        <div class="row setup-content-2" id="step-{{$y++}}">
                                                                            <div class="col-md-12">
                                                                            @php
                                                                                if ($plan_id != 1)
                                                                                {
                                                                                     $pdf_link= $content->pdf;

                                                                                    if ($pdf_link!= null )
                                                                                       {
                                                                                            $filename = asset('/public/img/'.$pdf_link);
                                                                                       }
                                                                                       else
                                                                                        {
                                                                                            $filename = '#';
                                                                                        }
                                                                                }
                                                                                else
                                                                                {
                                                                                     if ($plan_id != 2)
                                                                                {
                                                                                     $pdf_link= $content->pdf;

                                                                                    if ($pdf_link!= null )
                                                                                       {
                                                                                            $filename = asset('/public/img/'.$pdf_link);
                                                                                       }
                                                                                       else
                                                                                        {
                                                                                            $filename = '#';
                                                                                        }
                                                                                }
                                                                                }

                                                                            @endphp

                                                                                <a class="btn btn-outline-amber btn-rounded  btn-flat margin " href="{{$filename}}"><img src="{{asset('public/images/icons/pdf.svg')}}"></a>
                                                                                <button class="btn btn-mdb-color btn-rounded prevBtn-2 float-left" type="button">Previous</button>
                                                                                @php
                                                                                    if ($plan_id != 1)
                                                                                    {
                                                                                       ?>  <button id="preTestActionBtn" class="btn btn-success btn-rounded float-right" type="submit">TAKE TEST</button> <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                     ?>    <button  class="btn btn-success btn-rounded float-right" type="submit">Upgrade To Gold Package</button> <?php
                                                                                    }

                                                                                @endphp

                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                            </li>
                                                        @endforeach
                                                    </ul>
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
            <!--/.Examples-->
        </div>
    </div>

    <!--Modal: modalYT-->
    <div class="modal fade" id="modalYT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Body-->
                <div class="modal-body mb-0 p-0">
                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="theory_video">
                    </div>

                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half" id="solve_example_video">
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-center flex-column flex-md-row">
                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal" onclick="resetVideo()">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalYT-->
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
        // Tooltips Initialization
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        // Steppers
        $(document).ready(function () {
            var navListItems = $('div.setup-panel-2 div a'),
                allWells = $('.setup-content-2'),
                allNextBtn = $('.nextBtn-2'),
                allPrevBtn = $('.prevBtn-2');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-amber').addClass('btn-blue-grey');
                    $item.addClass('btn-amber');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allPrevBtn.click(function(){
                var curStep = $(this).closest(".setup-content-2"),
                    curStepBtn = curStep.attr("id"),
                    prevStepSteps = $('div.setup-panel-2 div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                prevStepSteps.removeAttr('disabled').trigger('click');
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content-2"),
                    curStepBtn = curStep.attr("id"),
                    nextStepSteps = $('div.setup-panel-2 div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i< curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepSteps.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel-2 div a.btn-amber').trigger('click');
        });
    </script>
    <script>
        $(function() {
            $(".steps-icon-btn").click(function() {
                // remove classes from all
                $(".steps-icon-btn").removeClass("active");
                // add class to the one we clicked
                $(this).addClass("active");
            });
        });
    </script>

@endsection

