<!--=================================Our Testimonial -->
<section class="page-section-ptb gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center">
                    <h6>الق نظرة على</h6>
                    <h2 class="title-effect">أراء عملائنا</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="owl-carousel" data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="2" data-xs-items="1" data-xx-items="1">

                    @foreach (\App\Models\Testimonial::all() as $t)
                        <div class="item">
                            <div class="testimonial light">
                                <div class="testimonial-avatar"> <img alt="" src="{{ $t->display_image }}"> </div>
                                <div class="testimonial-info">
                                    {{ $t->message }}
                                </div>
                                <div class="author-info"> <strong>{{ $t->name }}</strong> </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================Our Testimonial -->
