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

$student_id = $get->getStudentId();

$subscription_days = $get->getRemainingSubscription($student_id);


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
    @if(!empty($service))

    @if($service == 'facebook')
        <div class="title m-b-md">
            Welcome {{ $details->user['name']}} ! <br> Your email is : {{
    $details->user['email'] }}
        </div>
    @endif

    @endif

    <div class="card-body toast-bottom-full-width white-text rgba-black-strong text-center">
        <!--Grid row-->
        <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <div class="col-md-6">
                <h3 class="font-weight-light h3-responsive">Explorer the various course content of <b>MATHARON ACADEMY</b> </h3>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->
    </div>
    <div class="">
        <!-- Main docs tabs -->
        <div class="main-tabs-docs">
            <!-- Nav tabs -->
            <ul class="nav nav-mtd tabs-orange z-depth-1" role="tablist">
                <li class="nav-item">
                    <a id="docs-tab-overview" class="nav-link waves-light waves-effect waves-light active show  text-white m-1" data-toggle="tab" href="#docsTabsOverview" role="tab" aria-selected="true"><i class="fa fa-book mr-2"></i>Explore</a>
                </li>
                @if(Auth::guard('member')->check())
                    @if ($subscription_days>0)
                    <li class="nav-item">
                        <a id="docs-tab-overview" class="nav-link waves-light waves-effect waves-light text-white m-1" data-toggle="tab" href="#additionalTest" role="tab" aria-selected="true"><i class="fa fa-book mr-2"></i>Additional Test</a>
                    </li>
                    @endif
                        <li class="nav-item">
                            <a id="docs-tab-gettingstarted" class="nav-link waves-light waves-effect waves-light  text-white m-1" data-toggle="tab" href="#docsTabsAPI" role="tab" aria-selected="false"><i class="fa fa-download mr-2"></i>Result</a>
                        </li>
                @endif
            </ul>
            <div class="tab-content">
                <!--API-->
                <div class="tab-pane fade in active show" id="docsTabsOverview" role="tabpanel">
                    @php
                        $get = new \App\Member();
                        $chapters = $get->getChapters();
                    @endphp
                    <!--Grid row-->
                    <div class="row">
                        <!--Grid column: Content-->
                        <!--Grid column: Scrollspy-->
                        <div class="col-md-2">
                            <!-- Sticky content -->
                                <!--Scrollspy-->
                                <div id="scrollspy" class="sticky">
                                    <!-- Links -->
                                    <ul class="nav nav-pills default-pills smooth-scroll  z-depth-1 pin-card" data-allow-hashes="true">
                                        @foreach($chapters as $chapter)
                                        <li class="nav-item"><a class="nav-link" href="#chapter-{{$chapter->id}}"><b>>></b>  {{$chapter->name}}</a></li>
                                        @endforeach
                                    </ul>
                                    <!-- Links -->
                                </div>
                                <!--Scrollspy-->
                            <!-- Sticky content -->
                        </div>
                        <!--Grid column: Scrollspy-->
                        <!--Grid column: Scrollspy-->
                        <div class="col-lg-10 col-md-12">
                            <!--Section: Docs content-->
                            <section class="documentation">
                            @foreach($chapters as $chapter)
                                <!--Accordion wrapper-->
                                <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                                    <!-- Accordion card -->
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="chapter-{{$chapter->id}}">
                                            <a class="collapsed" data-toggle="collapse" href="#chapter-collapse-{{$chapter->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                <h6 class="mb-0">{{$chapter->name}}
                                                    <i class="fa fa-angle-down rotate-icon"></i>
                                                </h6>
                                            </a>
                                        </div>
                                        <!-- Card body -->
                                        <div id="chapter-collapse-{{$chapter->id}}" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordionEx">
                                            <div class="card-body">
                                                @php
                                                    $topics = $get->getTopicsById($chapter->id);
                                                @endphp
                                                <ul class="list-group">
                                                    @foreach($topics as $topic)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <a href="{{ route('course_content', ['chapter_id' => $chapter->id,'topic_id' => $topic->id]) }}">
                                                                    {{$topic->name}}
                                                                </a>
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
                            </section>
                            <!--Section: Docs content-->
                        </div>
                    </div>
                    <!--Grid row-->
                </div>

            @if(Auth::guard('member')->check())
                    @if ($subscription_days>0)
                    <div class="tab-pane fade " id="additionalTest" role="tabpanel">

                    @php
                        $get = new \App\Member();
                        $tests = $get->getAdditionalTest();
                    @endphp
                    <!--Grid row-->
                    <div class="row">

                        <div class="col-lg-12 col-md-12">

                            <!--Section: Docs content-->
                            <section class="documentation">
                            @foreach($tests as $test)
                                <!--Accordion wrapper-->

                                @php
                                    $created_at = $test->created_at;
                                    $created_at = Carbon\Carbon::parse($created_at)->diffForHumans();

                                @endphp
                                    <div class="card-deck">
                                        <!--Panel-->
                                        <div class="card">
                                            <div class="card-body">
                                                <form id="preTestActionForm" role="form" action="{{route('preAdditionalTestAction')}}" method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="count" value="1">
                                                    <input type="hidden" name="test_id" value="{{$test->id}}">
                                                    <input type="hidden" name="member_id" value="{{ $student_id}}">
                                                <h5 class="card-title">{{$test->name}}</h5>
                                                   <div class="row">
                                                       <div class="col-lg-5 offset-lg-1">
                                                           <span class="text-align-left"><i class="fa fa-question-circle-o" aria-hidden="true"></i> {{$test->display_questions}} Questions</span>
                                                       </div>
                                                       <div class="col-lg-5 offset-lg-1">
                                                           <span class="text-align-right"><i class="fa fa-clock-o"></i> {{$test->duration}} Minutes</span>
                                                       </div>
                                                   </div>

                                                <button id="preTestActionBtn" class="btn btn-success btn-rounded float-right" type="submit">TAKE TEST</button>
                                                <p class="card-text"><small class="text-muted">{{$created_at}}</small></p>
                                                </form>


                                            </div>
                                        </div>
                                        <!--/.Panel-->
                                    </div>
                                    <br>
                                @endforeach


                            </section>
                            <!--Section: Docs content-->

                        </div>
                    </div>
                    <!--Grid row-->

                </div>
                    @endif
                <!--/.API-->
                <!--Overview-->
                <div class="tab-pane fade " id="docsTabsAPI" role="tabpanel">
                    <!--Grid row-->
                    <!--Main layout-->
                    <section class="mb-5">
                        <!--Card-->
                        <div class="card card-cascade narrower">
                            <!--Card header-->
                            <div class="view view-cascade py-3 gradient-card-header info-color-dark mx-4 d-flex justify-content-between align-items-center">

                                <div>

                                </div>

                                <a href="" class="white-text mx-3">Results  List</a>

                                <div class="text-center">

                                </div>
                            </div>
                            <!--/Card header-->

                            <!--Card content-->
                            <div class="card-body card-body-cascade">

                                <div class="table-responsive text-nowrap">
                                    <table id="list" class="table table-striped" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="th-sm">Exam
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                            <th class="th-sm">Date
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                            <th class="th-sm">Marks
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                            <th class="th-sm">Percentage
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                            <th class="th-sm">Attempted Question
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                            <th class="th-sm">Time Taken
                                                <i class="fa fa-sort float-right" aria-hidden="true"></i>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>

                                    </table>

                                </div>


                            </div>
                            <!--/.Card content-->

                        </div>
                        <!--/.Card-->

                    </section>
                    <!--Section: Table-->

                    <!--Grid row-->

                </div>
                @endif
                <!--/.Overview-->

            </div>
            <!--/.Examples-->
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
@endsection

