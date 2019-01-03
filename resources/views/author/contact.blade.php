@extends('layouts.frontLayout.front_design')

@section('content')

    <body class="size-1280">


    <!-- MAIN -->
    <main role="main">
        <article>
            <!-- Header -->
            <header class="section background-image text-center" style="background-image:url(/images/frontend_images/carousel-02.jpg)">
                <h1 class="animated-element slow text-extra-thin text-white text-s-size-30 text-m-size-40 text-size-50 text-line-height-1 margin-bottom-30 margin-top-130">
                    Contact Us
                </h1>
                <p class="animated-element text-white">Donau trade</p>

                <!-- white full width arrow object -->
                <img class="arrow-object" src="/images/frontend_images/arrow-object-white.svg" alt="">
            </header>

            <!-- Section 1 -->
            <section class="section-small-padding background-white text-center">
                <div class="line">
                    <i class="icon-sli-heart text-primary text-size-40"></i>
                    <h2 class="text-dark text-size-50 text-m-size-40">We are here for you <b class="text-primary">24/7</b></h2>
                </div>
            </section>

            <!-- Section 2 -->
            <section class="full-width background-grey">
                <div class="m-12 l-6">
                    <div class="padding-3x">
                        <div class="margin2x">

                            <div class="l-12 xl-6 margin-bottom-60">
                                <div class="float-left">
                                    <i class="icon-sli-location-pin text-primary text-size-40 text-line-height-1"></i>
                                </div>
                                <div class="margin-left-60">
                                    <h2 class="text-size-20 margin-bottom-10 text-strong">Company Address</h2>
                                    <p>Mišarska 6</p>
                                    <p>Beograd, Serbia</p>
                                </div>
                            </div>

                            <div class="l-12 xl-6 margin-bottom-60">
                                <div class="float-left">
                                    <i class="icon-sli-envelope text-primary text-size-40 text-line-height-1"></i>
                                </div>
                                <div class="margin-left-60">
                                    <h2 class="text-size-20 margin-bottom-10 text-strong">E-mail</h2>
                                    <p><a class="text-primary-hover" href="mailto:contact@sampledomain.com">sales@donautrade.com</a></p>
                                    <p><a class="text-primary-hover" href="mailto:office@sampledomain.com">office@donautrade.com</a></p>
                                </div>
                            </div>

                            <div class="l-12 xl-6 margin-bottom-60">
                                <div class="float-left">
                                    <i class="icon-sli-earphones-alt text-primary text-size-40 text-line-height-1"></i>
                                </div>
                                <div class="margin-left-60">
                                    <h2 class="text-size-20 margin-bottom-10 text-strong">Phone Numbers</h2>
                                    <p>+381 11 3035 120</p>
                                    <p>+381 11 3035 120</p>
                                    <p>+381 11 3035 120</p>
                                </div>
                            </div>

                            <div class="l-12 xl-6">
                                <div class="float-left">
                                    <i class="icon-sli-paper-plane text-primary text-size-40 text-line-height-1"></i>
                                </div>
                                <div class="margin-left-60">
                                    <h2 class="text-size-20 margin-bottom-10 text-strong">Billing information</h2>
                                    <p>Donau trade d.o.o. - Mišarska 5, 11000 Beograd, Srbija</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-12 l-6">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1cl4X-krGn9xQso6ANUk96DyCOa4" width="640" height="480" frameborder="0" style="border:0"></iframe>

                </div>
            </section>

            <!-- Section 3 -->
            <section class="section background-dark">
                <div class="s-12 m-12 l-4 center">
                    <h3 class="text-size-30 margin-bottom-40 text-center"><b>Contact Form</b></h3>
                    <form class="customform text-white" method="post" enctype="multipart/form-data" id="contact_form" name="contact_form" novalidate="novalidate">
                        <div class="line">
                            <div class="margin">
                                <div class="s-12 m-12 l-6">
                                    <input id="email" name="email" class="required email" placeholder="Your e-mail" title="Your e-mail" type="text" />
                                </div>
                                <div class="s-12 m-12 l-6">
                                    <input id="name" name="name" class="name" placeholder="Your name" title="Your name" type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="line">
                            <div class="s-12">
                                <input id="subject" name="subject" class="required subject" placeholder="Subject" title="Subject" type="text" />
                            </div>
                            <div class="s-12">
                                <textarea id="message" name="message" class="required message" placeholder="Your message" rows="3"></textarea>
                            </div>
                            <div class="s-12"><button class="button border-radius text-white background-primary" type="submit">Send</button></div>
                        </div>
                    </form>
                </div>
            </section>
        </article>
    </main>

    </body>

@endsection