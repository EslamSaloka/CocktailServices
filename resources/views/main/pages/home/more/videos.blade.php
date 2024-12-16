<!--=================================videos carousel -->
<section class="page-section-ptb bg-overlay-black-10 position-relative jarallax" data-speed="0.6" >
    <div class="container">
        <div class="row mt-0">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-title text-center">
                    <h6>الق نظرة على</h6>
                    <h2 class="title-effect">معرض الفيديو</h2>
                </div>
                <div class="owl-carousel" style="margin-top:0px;" data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="2" data-xs-items="2" data-xx-items="1" data-space="20">
                    @foreach (\App\Models\Banner::all() as $v)
                        <div class="item" style="margin-top:-30px;">
                            <video width="100%" height="auto"  controls="controls" autoplay muted>
                                <source src="{{ $v->video }}" type="video/mp4">
                            </video>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================videos carousel -->
