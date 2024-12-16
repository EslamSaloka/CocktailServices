<script src="{{ url('/main/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ url('/main/js/plugins-jquery.js') }}"></script>
<script>var plugin_path = 'main/js/';</script>

<!-- REVOLUTION JS FILES -->
<script src="{{ url('/main/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<script src="{{ url('/main/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ url('/main/revolution/js/revolution-custom.js') }}"></script>

<script src="{{ url('/main/js/custom.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/85188/raindrops.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.0/sweetalert2.all.js" integrity="sha512-13385TgF1r3EtQdRsBYMM9orUX+AB96en1OwtIuVNadPEzAgVd8IbJgS//FcuDwF0lsdK3GkUpqGFKPwvu6MaA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery('#raind').raindrops(
        {color:'#2dc4ea',
            canvasHeight:50});
</script>

@if (Session::get('success'))
    @if (Session::get('link'))
        <script>
            Swal.fire({
                title: 'تم ارسال الطلب',
                text: "{{ Session::get('success') }}",
                icon: 'success',
                confirmButtonText: "<a href='{{ Session::get('link') }}' style='color:#fff;'>موافق</a>"
            })
        </script>
    @else
        <script>
            Swal.fire({
                title: 'عملية ناجحة',
                text: "{{ Session::get('success') }}",
                icon: 'success',
                confirmButtonText: 'موافق'
            })
        </script>
    @endif
@endif
@if (Session::get('danger'))
    <script>
        Swal.fire({
            title: 'حدث خطأ',
            text: "{{ Session::get('danger') }}",
            icon: 'error',
            confirmButtonText: 'موافق'
        })
    </script>
@endif
@stack('scripts')
