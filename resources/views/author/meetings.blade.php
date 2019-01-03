@extends('layouts.frontLayout.front_design')

@section('content')

    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/img-05.jpg)">
                <h1 class="animated-element slow text-extra-thin text-white text-s-size-16 text-m-size-20 text-size-30 text-line-height-1 margin-bottom-10 margin-top-30">
                    Meetings for
                    @foreach($company as $comp)
                        <b>
                            {{ $comp->name }}


                        </b>
                    @endforeach
                </h1>
                <p>
                    @if(!empty($comp->photo_id))
                        <img src="{{ asset('/images/backend_images/companies/'. $comp->photo_id) }}" class="center" >
                    @endif
                </p>
                <br />
                <p class="animated-element text-dark-hover text-s-size-12 text-m-size-16 text-size-20">Please choose meeting to view details, add/view comments or upload/download documents.</p>

                <!-- white full width arrow object -->
                <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
            </header>

            <!-- Section 1 -->
            <section class="section background-white">

                <div class="line">
                    <table id="tab1" class="table" data-paging="true" data-filtering="true" data-sorting="true">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
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
                                    <td>
                                        @if($meeting->finished == 1)
                                            <p style="color:dodgerblue"><b>FINISHED</b></p>
                                        @else
                                            <p style="color:crimson"><b>ACTIVE</b></p>
                                        @endif
                                    </td>
                                    <td><a href="{{ url('/author/meetings_details/' . $meeting->id) }}" class="button button-primary-stroke">Details</a></td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </section>



        </article>
    </main>

@endsection
