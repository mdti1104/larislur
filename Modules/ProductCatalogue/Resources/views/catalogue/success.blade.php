@extends('layouts.guest')
@section('title', 'Kokuja')

@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Content Header (Page header) -->

<!-- Main content -->
<section class="content pt-0">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3">
                <br><br>
                <h2 style="color:#0fad00">Berhasil Melakukan Pemesanan</h2>
                <div id="qr"></div>
                <h3>No Order : {{$order_no}}</h3>
                <p style="font-size:20px;color:#5C5C5C;">Terima Kasih Telah Memesan,Harap Simpan No Order Anda Dan berikan Kepada Kasir Untuk Melakukan Pembayaran</p>
                <br><br>
            </div>

        </div>
    </div>
    <div class='scrolltop no-print'>
        <div class='scroll icon'><i class="fas fa-angle-up"></i></div>
    </div>
</section>
<!-- /.content -->
<!-- Add currency related field-->

<div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
<script src="{{ asset('modules/productcatalogue/plugins/easy.qrcode.min.js') }}"></script>
<script type="text/javascript">
    (function($) {
        "use strict";

    $(document).ready( function(){
        $('#color').colorpicker();
        new QRCode(document.getElementById("qr"), '{{$order_no}}');

    });

    })(jQuery);

</script>
@endsection