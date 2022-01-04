@extends('layouts.restaurant')
@section('title', __( 'restaurant.kitchen' ))

@section('content')
<!-- Main content -->
<section class="content min-height-90hv no-print">
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>@lang( 'restaurant.all_orders' ) @show_tooltip(__('lang_v1.tooltip_serviceorder'))</h3>
        </div>
        <div class="col-sm-12">
            <button type="button" class="btn btn-sm btn-primary pull-right" id="refresh_orders"><i class="fas fa-sync"></i> @lang( 'restaurant.refresh' )</button>
        </div>
    </div>
    <br>
    <div class="row">
    @component('components.widget', ['title' => 'Lines Order'])
        <input type="hidden" id="single" value="{{$id}}">
        <input type="hidden" id="orders_for" value="kitchen">
        <div class="row" id="orders_div">
         @include('restaurant.partials.line_orders', array('orders_for' => 'kitchen','line_orders' => $orders))   
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    @endcomponent
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', 'a.mark_as_cooked_btn', function (e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: "info",
                buttons: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var _this = $(this);
                    var href = _this.data('href');
                    $.ajax({
                        method: "GET",
                        url: href,
                        dataType: "json",
                        success: function (result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                _this.closest('.order_div').remove();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', 'a.mark_as_served_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    refresh_orders();
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_line_order_as_served', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((sure) => {
                    if (sure) {
                        var _this = $(this);
                        var href = _this.attr('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    refresh_orders();
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $('.print_line_order').click( function(){
                let data = {
                    'line_id' : $(this).data('id'),
                    'service_staff_id' : $("#service_staff_id").val()
                };
                $.ajax({
                    method: "GET",
                    url: '/modules/print-line-order',
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if (result.success == 1 && result.html_content != '') {
                            $('#receipt_section').html(result.html_content);
                            __print_receipt('receipt_section');
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });
    });
</script>
@endsection