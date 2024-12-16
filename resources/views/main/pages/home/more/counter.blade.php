<!--=================================counter -->
<section class="page-section-ptb theme-bg position-relative">
    <h6 class="lacks-heading d-none">Lacks Heading</h6> <!-- lacks heading for w3c -->
    <div class="container">
        <div class="row" style="text-align:center;">

            @foreach (\App\Models\Counter::all() as $count)
                <div class="col-lg-3 col-sm-6">
                    <div class="counter text-white">
                        <span style="color:#000;" class="timer" data-to="{{ $count->count }}" data-speed="10000">{{ $count->count }}</span>
                        <label style="font-size:20px;color:#000;">{{ $count->name }}</label>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!--=================================counter -->
