
@props(['testimonials'])

    <div class=" mask rgba-black-strong" style="width:100%;background:white;">
        <div class="container">
            <div class="row d-flex align-items-center " >
                <section align="center" style="padding:20px;"  class="wow fadeInUp" >
                        <h1 class="black-text" style="font-weight:bold;">TESTIMONIALS</h1>
                        <div style="border-bottom: 2px solid black;width:100px;margin-left:45%;"></div><br>
                           <!--  <p class="black-text" style=" font-family: 'Balsamiq Sans', cursive;">Here’s what some of our customers say about our work.</p>-->
                        <!-- List of Clients-->
                        <div align="center" id="carousel-example-multi2" class="carousel slide carousel-multi-item v-2 wow animated fadeInUp fast" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @if($testimonials && $testimonials->count())
                                    @foreach ($testimonials->chunk(3) as $chunk)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach ($chunk as $testimonial)
                                                    <div class="col-md-4">
                                                        <div class="card mb-2">
                                                            <a href="{{ url('/testimonial/' . $testimonial->id) }}" style="text-decoration: none; color: inherit;">
                                                                <div class="card-body">
                                                                    <p align="left" style="float:left;">
                                                                        <img src="{{ asset($testimonial->image_path) }}" class="z-depth-1" style="width:100px;">
                                                                    </p>
                                                                    <p><span style="font-weight:bold;">{{ $testimonial->name }}</span> <br>{{ $testimonial->title }}</p>
                                                                    <br><br>
                                                                    <p align="left" class="card-text" style="font-family: 'Balsamiq Sans', cursive;display:block;">
                                                                        <i>{{ Str::limit($testimonial->testimonial_text, 150) }}</i>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <p>No testimonials found.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--Controls-->
                        @if($testimonials && $testimonials->count() > 3)
                        <div class="controls-top">
                            <a class="animated pulse infinite slow" style="border-radius:50px;"  href="#carousel-example-multi2" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
                            <a class="px-3 animated pulse infinite slow" style="border-radius:50px;"  href="#carousel-example-multi2" data-slide="next"><i class="fas fa-chevron-right"></i></a>
                        </div>
                        @endif
                        <!--/.Controls-->

                </section>
            </div>
       </div>
    </div>
 