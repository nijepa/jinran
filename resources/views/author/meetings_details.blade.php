@extends('layouts.frontLayout.front_design')

@section('content')

    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/img-05.jpg)">
                <h1 class="animated-element slow text-extra-thin text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30">
                    <p>
                        @if(!empty($meetings->company->photo_id))
                            <img src="{{ asset('/images/backend_images/companies/'. $meetings->company->photo_id) }}" class="center" >
                        @endif
                    </p>
                    <b>{{$meetings->company->name}}</b> - details for Meeting :
                </h1>

                <p><b>Date : </b><h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{date('d-M-y', strtotime($meetings->date_m))}}</h3></p>
                <p><b>Title : </b><h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{$meetings->title}}</h3></p>
                <p><b>Description :</b> <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-2">{{$meetings->description}}</h3></p>
                <br />
                <p class="animated-element text-dark-hover text-s-size-12 text-m-size-16 text-size-20">Please choose detail to add/view comments or upload/download documents.</p>

                <!-- white full width arrow object -->
                <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
            </header>

            <section class="section background-white">

                <div class="line">

                    <table id="tab2" class="table" data-paging="true" data-filtering="true" data-sorting="true" >
                        <thead>
                        <tr>
                            <th>Company</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        @if($meetingDet)
                            @foreach($meetingDet as $meeting)
                                <tr>
                                    <td>@if(!empty($meeting->company->photo_id))
                                            <img src="{{ asset('/images/backend_images/companies/'. $meeting->company->photo_id) }}" style="width:50px;" >
                                        @endif{{$meeting->company ? $meeting->company->name : 'Meeting has no company'}}</td>
                                    <td>{{$meeting->title}}</td>
                                    <td>{{$meeting->description}}</td>
                                    <td><a href="{{ url('/author/comments/' . $meeting->id) }}" class="button button-primary-stroke">Comments</a>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>

    </section>
            </article>

@endsection