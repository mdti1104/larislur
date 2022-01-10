@extends('layouts.guest')
@section('title', 'Kokuja')

@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        vertical-align: middle;
    }

    @media screen and (max-width: 600px) {
        table#cart tbody td .form-control {
            width: 20%;
            display: inline !important;
        }

        .actions .btn {
            width: 36%;
            margin: 1.5em 0;
        }

        .actions .btn-info {
            float: left;
        }

        .actions .btn-danger {
            float: right;
        }

        table#cart thead {
            display: none;
        }

        table#cart tbody td {
            display: block;
            padding: .6rem;
            min-width: 320px;
        }

        table#cart tbody tr td:first-child {
            background: #333;
            color: #fff;
        }

        table#cart tbody td:before {
            content: attr(data-th);
            font-weight: bold;
            display: inline-block;
            width: 8rem;
        }



        table#cart tfoot td {
            display: block;
        }

        table#cart tfoot td .btn {
            display: block;
        }

    }
</style>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Content Header (Page header) -->
<section class="content-header text-center" id="top">
    <h2>Cart</h2>
</section>

<!-- Main content -->
<section class="content pt-0">
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $value)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..."
                                    class="img-responsive" /></div>
                            <div class="col-sm-10">
                                <h4 class="nomargin">{{$value['name']}}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{"Rp " . number_format($value['harga'],2,',','.')}}</td>
                    <td data-th="Quantity">
                        <input type="number" class="form-control text-center"disabled value="{{$value['quantity']}}">
                    </td>
                    <td data-th="Subtotal" class="text-center">{{"Rp " . number_format($value['subtotal'],2,',','.')}}</td>
                    <td class="actions" data-th="">
                        <a href="/cart/delete/{{$value['id']}}"class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a >
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              
                <tr>
                    <td><a href="{{url()->previous()}}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total {{"Rp " . number_format($total,2,',','.')}}</strong></td>
                    <td><a @if(!empty($cart)) href="/success" @else href="#"  @endif  class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a>
                    </td>
                </tr>
            </tfoot>
        </table>
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
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            //Set global currency to be used in the application
            __currency_symbol = $('input#__symbol').val();
            __currency_thousand_separator = $('input#__thousand').val();
            __currency_decimal_separator = $('input#__decimal').val();
            __currency_symbol_placement = $('input#__symbol_placement').val();
            if ($('input#__precision').length > 0) {
                __currency_precision = $('input#__precision').val();
            } else {
                __currency_precision = 2;
            }

            if ($('input#__quantity_precision').length > 0) {
                __quantity_precision = $('input#__quantity_precision').val();
            } else {
                __quantity_precision = 2;
            }

            //Set page level currency to be used for some pages. (Purchase page)
            if ($('input#p_symbol').length > 0) {
                __p_currency_symbol = $('input#p_symbol').val();
                __p_currency_thousand_separator = $('input#p_thousand').val();
                __p_currency_decimal_separator = $('input#p_decimal').val();
            }

            __currency_convert_recursively($('.content'));
        });
        $(document).on('click', '.order_now', function () {
            const id = $(this).data('id')
            const variant = $('#variant_id_' + id).val()
            var v_token = "{{csrf_token()}}";

            $.ajax({
                url: $(this).data('href'),
                type: "POST",
                data: {
                    id: id,
                    variant: variant,
                    _token: v_token
                },
                success: function () {
                    swal("Berhasil!", "", "success");
                }
            });

        })
        $(document).on('click', '.show-product-details', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).data('href'),
                dataType: 'html',
                success: function (result) {
                    $('.product_modal')
                        .html(result)
                        .modal('show');
                    __currency_convert_recursively($('.product_modal'));
                },
            });
        });

        $(document).on('click', '.menu', function (e) {
            e.preventDefault();
            $('.navbar-toggle').addClass('collapsed');
            $('.navbar-collapse').removeClass('in');

            var cat_id = $(this).attr('href');
            if ($(cat_id).length) {
                $('html, body').animate({
                    scrollTop: $(cat_id).offset().top
                }, 1000);
            }
        });

    })(jQuery);

    $(window).scroll(function () {
        var height = $(window).scrollTop();

        if (height > 180) {
            $('nav').addClass('navbar-fixed-top');
            $('.scrolltop:hidden').stop(true, true).fadeIn();
        } else {
            $('nav').removeClass('navbar-fixed-top');
            $('.scrolltop').stop(true, true).fadeOut();
        }
    });

    $(document).on('click', '.scroll', function (e) {
        $("html,body").animate({
            scrollTop: $("#top").offset().top
        }, "1000");
        return false;
    });
</script>
@endsection