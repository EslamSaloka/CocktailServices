<!--=================================clients -->
<section class="white-bg page-section-ptb">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-title text-center">
                <h6></h6>
                <h2 class="title-effect">شركاء النجاح</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <div class="clients-list mt-10">
                    <div class="owl-carousel" data-nav-dots="false" data-items="4" data-md-items="4" data-sm-items="3" data-xs-items="2" data-xx-items="2">

                        @foreach (\App\Models\Partner::all() as $p)
                            <div class="item">
                                <img class="img-fluid mx-auto" src="{{ $p->display_image }}" style="width:100%;height:150px;">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!--=================================clients-->
