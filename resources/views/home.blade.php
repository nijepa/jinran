@extends('layouts.frontLayout.front_design')

@section('content')


    <main role="main">
        <!-- Header -->
        <header class="section-top-padding background-image text-center" style="background-image:url(images/frontend_images/img-05.jpg)">
            <h1 class="text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1 margin-bottom-40 margin-top-130">
                Donau trade web app for business projects & meetings
            </h1>
            <p class="text-white">Please participate to improve<br> our businesses.</p>
            <i class="slow icon-sli-arrow-down text-white margin-top-20 text-size-16"></i>
            <!-- Image -->
            <img class="margin-top-20 center" src="/images/frontend_images/app.png" alt="">

            <!-- dark full width arrow object -->
            <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
        </header>

        <!-- Section 1 -->
        <!--<section class="section-small-padding background-dark text-center">
            <div class="line">
                <div class="m-10 l-3 xl-2 center">
                    <div class="margin">
                        <a class="s-12 m-6 margin-s-bottom" href="/">
                            <img class="full-img right" src="/images/frontend_images/google-play.png" alt="">
                        </a>
                        <a class="s-12 m-6" href="/">
                            <img class="full-img" src="/images/frontend_images/app-store.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>-->

        <!-- Section 2 -->
        <section class="margin-top-40 background-white">
            <div class="line text-center">
                <p>
                    @foreach($company as $comp)
                        @if(!empty($comp->photo_id))
                            <img src="{{ asset('/images/backend_images/companies/'. $comp->photo_id) }}" class="center" >
                        @endif
                    @endforeach
                </p>
                <!--<i class="icon-sli-heart text-primary text-size-40"></i>-->
                <h2 class="text-dark text-size-50 text-m-size-40">Business <b>Projects & Meetings</b></h2>
                <hr class="break background-primary break-small break-center margin-bottom-10">
            </div>

            <br />
            <div class="line">
                <div class="margin2x">
                    <div class="s-12 m-6 l-3 margin-bottom-60">
                        <div class="float-left">
                            <i class="icon-sli-badge text-primary text-size-40 text-line-height-1"></i>
                        </div>
                        <div class="margin-left-60">
                            <h3 class="text-dark text-size-20 text-line-height-1 margin-bottom-20">Company name</h3>
                            <p><h2>@foreach($company as $comp)
                                    <b>{{ $comp->name }}</b>
                                    @endforeach </h2></p>
                            <!--<a class="text-more-info text-primary" href="/">Read more</a>-->
                        </div>
                    </div>
                    <div class="s-12 m-6 l-3 margin-bottom-60">
                        <div class="float-left">
                            <i class="icon-sli-tag text-primary text-size-40 text-line-height-1"></i>
                        </div>
                        <div class="margin-left-60">
                            <h3 class="text-dark text-size-20 text-line-height-1 margin-bottom-20">Vrsta</h3>
                            <p><p>@foreach($company as $comp)
                                    <b>{{ $comp->category->name }}</b>
                                @endforeach </p>
                            <!--<a class="text-more-info text-primary" href="/">Read more</a>-->
                        </div>
                    </div>
                    <div class="s-12 m-6 l-3 margin-bottom-60">
                        <div class="float-left">
                            <i class="icon-sli-location-pin text-primary text-size-40 text-line-height-1"></i>
                        </div>
                        <div class="margin-left-60">
                            <h3 class="text-dark text-size-20 text-line-height-1 margin-bottom-20">Address</h3>
                            <p><p>@foreach($company as $comp)
                                    <b>{{ $comp->address }}, {{ $comp->city->name }}, {{ $comp->city->country->name }}</b>
                                @endforeach </p>
                        <!--<a class="text-more-info text-primary" href="/">Read more</a>-->
                        </div>
                    </div>
                    <div class="s-12 m-6 l-3 margin-bottom-60">
                        <div class="float-left">
                            <i class="icon-sli-globe text-primary text-size-40 text-line-height-1"></i>
                        </div>
                        <div class="margin-left-60">
                            <h3 class="text-dark text-size-20 text-line-height-1 margin-bottom-20">Website</h3>
                            <p>@foreach($company as $comp)
                                    <a class="text-more-info text-primary" href="{{ $comp->website }}">{{ $comp->website }}</a>
                                    @endforeach</p>
                            <!--<a class="text-more-info text-primary" href="/">Read more</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Projects -->
        <section>
            <div class="line">
                <div class="line text-center">
                    <i class="icon-sli-equalizer text-primary text-size-40"></i>
                    <h2 class="text-dark text-size-30 text-m-size-20">Business <b>Projects</b></h2>
                    <hr class="break background-primary break-small break-center margin-bottom-10">
                </div>
                <table id="tab1" class="table" data-paging="true" data-filtering="true" data-sorting="true">
                    <caption><b>ACTIVE</b></caption>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($projects)
                        @foreach($projects as $project)
                            <tr>
                                <td>{{date('d-M-y', strtotime($project->date_p))}}</td>
                                <td>{{$project->type->name}}</td>
                                <td>{{$project->title}}</td>
                                <td>{{$project->description}}</td>
                                <td><a href="{{ url('/author/projects_details/' . $project->id) }}" class="button button-primary-stroke">Details</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section Meetings -->
        <section class="margin-top-40">
            <div class="line">
                <div class="line text-center">
                    <i class="icon-sli-briefcase text-primary text-size-40"></i>
                    <h2 class="text-dark text-size-30 text-m-size-20">Business <b>Meetings</b></h2>
                    <hr class="break background-primary break-small break-center margin-bottom-10">
                </div>
                <table id="tab1" class="table" data-paging="true" data-filtering="true" data-sorting="true">
                    <caption><b>ACTIVE</b></caption>
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($meetings)
                        @foreach($meetings as $meeting)
                            <tr>
                                <td>{{date('d-M-y', strtotime($meeting->date_m))}}</td>
                                <td>{{$meeting->title}}</td>
                                <td>{{$meeting->description}}</td>
                                <td><a href="{{ url('/author/meetings_details/' . $meeting->id) }}" class="button button-primary-stroke">Details</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section Solutions % Replies -->
        <section class="background-primary full-width margin-top-20">
            <!-- Section Solutions -->
            <div class="m-12 l-6 xl-5 xxl-5 margin-top-20 margin-right-20 margin-left-15">
                <div class="line text-center">
                    <i class="icon-sli-bulb text-size-40"></i>
                    <h2 class="text-dark text-size-30 text-m-size-20">Projects <b>Tasks</b></h2>
                    <hr class="break background break-small break-center margin-bottom-10">
                </div>
                <!--<img class="full-img" src="/images/frontend_images/img-02.png"/>-->
                <table id="tab2" class="table" >
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Description</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($solutions as $solution)
                        <tr>
                            <td>{{ date('d-M-y', strtotime($solution->created_at)) }}</td>
                            <td>@if(!empty($solution->photo_id))
                                    <img src="{{ asset('/images/backend_images/users/'. $solution->photo_id) }}" style="width:30px;">
                                @else
                                    <img src="{{ asset('/images/backend_images/users/user.png') }}" style="width:50px;">
                                @endif{{$solution->name}}</td>
                            <td>{{$solution->description}}</td>
                            <td><a href="{{ asset('images/' . $solution->file) }}">{{ $solution->file }}</a></td>
                            <td><a href="{{ url('/author/solutions/' . $solution->project_detail_id) }}" class="button button-primary-stroke">View Details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Section Replies -->
            <div class="m-12 l-6 xl-5 xxl-5 margin-top-20 margin-left-20">
                <div class="line text-center">
                    <i class="icon-sli-bubbles text-size-40"></i>
                    <h2 class="text-dark text-size-30 text-m-size-20">Meetings <b>Replies</b></h2>
                    <hr class="break background break-small break-center margin-bottom-10">
                </div>
                <table id="tab2" class="table" >
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Reply</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($replies as $reply)
                            <tr>
                                <td>{{ date('d-M-y', strtotime($reply->created_at)) }}</td>
                                <td>@if(!empty($reply->user_id))
                                        <img src="{{ asset('/images/backend_images/users/'. $reply->photo_id) }}" style="width:30px;">
                                    @else
                                        <img src="{{ asset('/images/backend_images/users/user.png') }}" style="width:50px;">
                                    @endif{{$reply->name}}</td>
                                <td>{{$reply->reply}}</td>
                                <td><a href="{{ asset('images/' . $reply->file_r) }}">{{ $reply->file_r }}</a></td>
                                <td><a href="{{ url('/author/comments/' . $reply->meeting_detail_id) }}" class="button button-primary-stroke">View Details</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section 3 -->
        <section class="section background-white">
            <div class="line text-center">
                <p class="text-primary text-size-20">Successfully develop your business</p>
                <h2 class="text-dark text-size-50 text-m-size-40">Meetings <b>& Projects</b></h2>
                <i class="icon-chevron_down text-primary margin-bottom-50 text-size-20"></i>
            </div>

            <div class="l-12 xl-7 center">
                <div class="margin">
                    <!-- Left Column -->
                    <div class="s-12 m-12 l-4 text-right">
                        <div class="margin-right-50">
                            <i class="icon-sli-briefcase text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Business <b>Meetings</b></h3>
                            <p>View the contents of meetings with Your and our partners.</p>
                        </div>

                        <div class="line">
                            <hr class="break background-primary break-small right margin-top-bottom-40">
                        </div>

                        <div class="margin-right-50">
                            <i class="icon-sli-bubble text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Comments</h3>
                            <p>Add comments related to the content of the meetings.</p>
                        </div>

                        <div class="line">
                            <hr class="break background-primary break-small right margin-top-bottom-40">
                        </div>

                        <div class="margin-right-50">
                            <i class="icon-sli-bubbles text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Replies</h3>
                            <p>Read our answers to your comments.</p>
                        </div>
                    </div>

                    <!-- Middle Column (carousel)-->
                    <div class="s-12 m-12 l-4">
                        <div class="carousel-default owl-carousel carousel-hide-arrows margin-m-top-bottom-50">
                            <div class="item">
                                <img src="/images/frontend_images/responsive-01.png"/>
                            </div>
                            <div class="item">
                                <img src="/images/frontend_images/responsive-02.png"/>
                            </div>
                            <div class="item">
                                <img src="/images/frontend_images/responsive-03.png"/>
                            </div>
                            <div class="item">
                                <img src="/images/frontend_images/responsive-04.png"/>
                            </div>
                            <div class="item">
                                <img src="/images/frontend_images/responsive-05.png"/>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="s-12 m-12 l-4">
                        <div class="margin-left-50">
                            <i class="icon-sli-equalizer text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Projects</h3>
                            <p>Successfully develop and finish projects with us.</p>
                        </div>

                        <div class="line">
                            <hr class="break background-primary break-small margin-top-bottom-40">
                        </div>

                        <div class="margin-left-50">
                            <i class="icon-sli-bulb text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Tasks</h3>
                            <p>Add tasks to project, and follow project development.</p>
                        </div>

                        <div class="line">
                            <hr class="break background-primary break-small margin-top-bottom-40">
                        </div>

                        <div class="margin-left-50">
                            <i class="icon-sli-book-open text-primary text-size-40 margin-bottom-20"></i>
                            <h3 class="text-strong text-size-20 text-line-height-1 margin-bottom-20">Documents</h3>
                            <p>Upload, download projects/meetings documents.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
