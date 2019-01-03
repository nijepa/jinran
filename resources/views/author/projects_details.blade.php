@extends('layouts.frontLayout.front_design')

@section('content')

    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/img-05.jpg)">
                <h1 class="animated-element slow text-extra-thin text-white text-s-size-12 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30">
                    <p>
                        @if(!empty($projects->company->photo_id))
                            <img src="{{ asset('/images/backend_images/companies/'. $projects->company->photo_id) }}" class="center" >
                        @endif
                    </p>
                    <b>{{$projects->company->name}}</b> - details for Project :
                </h1>

                <p><b>Date : </b><h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{date('d-M-y', strtotime($projects->date_p))}}</h3></p>
                <p><b>Title : </b><h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-1">{{$projects->title}}</h3></p>
                <p><b>Description :</b> <h3 class="text-white text-s-size-12 text-m-size-16 text-size-20 text-line-height-2">{{$projects->description}}</h3></p>
                <br />
                <p class="animated-element text-dark-hover text-s-size-12 text-m-size-16 text-size-20">Please choose detail to add/view tasks or upload/download documents.</p>

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

                        @if($projectDet)
                            @foreach($projectDet as $project)
                                <tr>
                                    <td>{{$project->subtype ? $project->subtype->name : 'Meeting has no company'}}</td>
                                    <td>{{$project->title}}</td>
                                    <td>{{$project->description}}</td>
                                    <td><a href="{{ url('/author/solutions/' . $project->id) }}" class="button button-primary-stroke">Tasks</a>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>

    </section>
            </article>

@endsection