
    <div class="ticket" id="register_details">
        <div class="text-box">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">End Of Day KOKUJA</span>
                <br />

            </p>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <b>@lang('report.user'):</b> {{ $register_details->user_name}}<br>
                <b>@lang('business.email'):</b> {{ $register_details->email}}<br>
                <b>@lang('business.business_location'):</b> {{ $register_details->location_name}}<br>
            </div>
            @if(!empty($register_details->closing_note))
            <div class="col-xs-6">
                <strong>@lang('cash_register.closing_note'):</strong><br>
                {{$register_details->closing_note}}
            </div>
            @endif
        </div>

        <br>
        <div class="textbox-info border-bottom">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">Payment Method</span>
                <br />

            </p>
        </div>
        <table class="table table-condensed">
            <tr>
                <th>@lang('lang_v1.payment_method')</th>
                <th>@lang('sale.sale')</th>
                <th>@lang('lang_v1.expense')</th>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.cash_in_hand'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->cash_in_hand }}</span>
                </td>
                <td>--</td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.cash_payment'):
                    </th>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cash }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cash_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.checque_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cheque }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_cheque_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.card_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_card }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_card_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('cash_register.bank_transfer'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_bank_transfer }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_bank_transfer_expense }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    @lang('lang_v1.advance_payment'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_advance }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_advance_expense }}</span>
                </td>
            </tr>
            @if(array_key_exists('custom_pay_1', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_1']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_1 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_1_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_2', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_2']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_2 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_2_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_3', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_3']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_3 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_3_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_4', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_4']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_4 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_4_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_5', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_5']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_5 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_5_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_6', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_6']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_6 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_6_expense }}</span>
                </td>
            </tr>
            @endif
            @if(array_key_exists('custom_pay_7', $payment_types))
            <tr>
                <td>
                    {{$payment_types['custom_pay_7']}}:
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_7 }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_custom_pay_7_expense }}</span>
                </td>
            </tr>
            @endif
            <tr>
                <td>
                    @lang('cash_register.other_payments'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_other }}</span>
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_other_expense }}</span>
                </td>
            </tr>
        </table>
        <hr>

        <div class="textbox-info border-bottom">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">Sales</span>
                <br />

            </p>
        </div>
        <table class="table table-condensed">
            <tr>
                <td>
                    @lang('cash_register.total_sales'):
                </td>
                <td>
                    <span class="display_currency"
                        data-currency_symbol="true">{{ $register_details->total_sale }}</span>
                </td>
            </tr>
            <tr class="danger">
                <th>
                    @lang('cash_register.total_refund')
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_refund }}</span></b><br>
                    <small>
                        @if($register_details->total_cash_refund != 0)
                        Cash: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_cash_refund }}</span><br>
                        @endif
                        @if($register_details->total_cheque_refund != 0)
                        Cheque: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_cheque_refund }}</span><br>
                        @endif
                        @if($register_details->total_card_refund != 0)
                        Card: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_card_refund }}</span><br>
                        @endif
                        @if($register_details->total_bank_transfer_refund != 0)
                        Bank Transfer: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_bank_transfer_refund }}</span><br>
                        @endif
                        @if(array_key_exists('custom_pay_1', $payment_types) &&
                        $register_details->total_custom_pay_1_refund != 0)
                        {{$payment_types['custom_pay_1']}}: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_1_refund }}</span>
                        @endif
                        @if(array_key_exists('custom_pay_2', $payment_types) &&
                        $register_details->total_custom_pay_2_refund != 0)
                        {{$payment_types['custom_pay_2']}}: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_2_refund }}</span>
                        @endif
                        @if(array_key_exists('custom_pay_3', $payment_types) &&
                        $register_details->total_custom_pay_3_refund != 0)
                        {{$payment_types['custom_pay_3']}}: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_custom_pay_3_refund }}</span>
                        @endif
                        @if($register_details->total_other_refund != 0)
                        Other: <span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->total_other_refund }}</span>
                        @endif
                    </small>
                </td>
            </tr>
            <tr class="success">
                <th>
                    @lang('lang_v1.total_payment')
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ $register_details->cash_in_hand + $register_details->total_cash - $register_details->total_cash_refund }}</span></b>
                </td>
            </tr>
            <tr class="success">
                <th>
                    @lang('lang_v1.credit_sales'):
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ $details['transaction_details']->total_sales - $register_details->total_sale }}</span></b>
                </td>
            </tr>
            <tr class="success">
                <th>
                    @lang('cash_register.total_sales'):
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ number_format($details['transaction_details']->total_sales,0,',','.') }}</span></b>
                </td>
            </tr>
            <tr class="danger">
                <th>
                    @lang('report.total_expense'):
                </th>
                <td>
                    <b><span class="display_currency"
                            data-currency_symbol="true">{{ number_format($register_details->total_expense,0,',','.') }}</span></b>
                </td>
            </tr>
        </table>
        <!-- product -->
        <div class="textbox-info border-bottom">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">products sold by category</span>
                <br />

            </p>
        </div>
        <table style="margin-top: 25px !important" class="width-100 table-f-12 mb-12">
            <thead>
                <tr>
                    <th class="serial_number centered">#</th>
                    <th class="description centered">
                        Category
                    </th>
                    <th class="quantity centered">
                        Quantity
                    </th>

                    <th class="price centered">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details['product_group_category'] as $value)
                <tr>
                    <td class="serial_number centered" style="vertical-align: top;">
                        {{$loop->iteration}}
                    </td>
                    <td class="description centered">
                    {{$value->category_name}}
                    </td>
                    <td class="quantity centered"> {{number_format($value->total_quantity,0,',','.')}}</td>
                    <td class="quantity centered"> {{number_format($value->total_amount,0,',','.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="textbox-info border-bottom">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">products sold by Location</span>
                <br />

            </p>
        </div>
        <table style="margin-top: 25px !important" class="width-100 table-f-12 mb-12">
            <thead>
                <tr>
                    <th class="serial_number centered">#</th>
                    <th class="description centered">
                        Location
                    </th>
                    <th class="quantity centered">
                        Quantity
                    </th>

                    <th class="price centered">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($details['product_group_location'] as $value)
                <tr>
                <td class="serial_number centered" style="vertical-align: top;">
                        {{$loop->iteration}}
                    </td>
                    <td class="description centered">
                    {{$value->location_name}}
                    </td>
                    <td class="quantity centered"> {{number_format($value->total_quantity,0,',','.')}}</td>
                    <td class="quantity centered"> {{number_format($value->total_amount,0,',','.')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="textbox-info border-bottom">
            <!-- Logo -->
            <p class="centered">
                <!-- Header text -->
                <span class="headings">products sold by Name</span>
                <br />

            </p>
        </div>
        <table style="margin-top: 25px !important" class="width-100 table-f-12 mb-12">
            <thead>
                <tr>
                    <th class="serial_number centered">#</th>
                    <th class="description centered">
                        Product
                    </th>
                    <th class="quantity centered">
                        Quantity
                    </th>

                    <th class="price centered">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($details['product_group_name'] as $value)
                <tr>
                <td class="serial_number centered" style="vertical-align: top;">
                        {{$loop->iteration}}
                    </td>
                    <td class="description centered">
                    {{$value->product_name}}
                    </td>
                    <td class="quantity centered"> {{number_format($value->total_quantity,0,',','.')}}</td>
                    <td class="quantity centered"> {{number_format($value->total_amount,0,',','.')}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <!-- end product -->

    </div>
<style type="text/css">
    .f-8 {
        font-size: 8px !important;
    }

    @media print {
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
            word-break: break-all;
        }

        .f-8 {
            font-size: 8px !important;
        }

        .headings {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .sub-headings {
            font-size: 15px !important;
            font-weight: 700 !important;
        }

        .border-top {
            border-top: 1px solid #242424;
        }

        .border-bottom {
            border-bottom: 1px solid #242424;
        }

        .border-bottom-dotted {
            border-bottom: 1px dotted darkgray;
        }

        td.serial_number,
        th.serial_number {
            width: 5%;
            max-width: 5%;
        }

        td.description,
        th.description {
            width: 35%;
            max-width: 35%;
        }

        td.quantity,
        th.quantity {
            width: 20%;
            max-width: 35%;
            word-break: break-all;
        }

        td.unit_price,
        th.unit_price {
            width: 25%;
            max-width: 25%;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 20%;
            max-width: 20%;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 100%;
            max-width: 100%;
        }

        img {
            max-width: inherit;
            width: auto;
        }

        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }

    .table-info {
        width: 100%;
    }

    .table-info tr:first-child td,
    .table-info tr:first-child th {
        padding-top: 8px;
    }

    .table-info th {
        text-align: left;
    }

    .table-info td {
        text-align: right;
    }

    .logo {
        float: left;
        width: 35%;
        padding: 10px;
    }

    .text-with-image {
        float: left;
        width: 65%;
    }

    .text-box {
        width: 100%;
        height: auto;
    }

    .textbox-info {
        clear: both;
    }

    .textbox-info p {
        margin-bottom: 0px
    }

    .flex-box {
        display: flex;
        width: 100%;
    }

    .flex-box p {
        width: 50%;
        margin-bottom: 0px;
        white-space: nowrap;
    }

    .table-f-12 th,
    .table-f-12 td {
        font-size: 12px;
        word-break: break-word;
    }

    .bw {
        word-break: break-word;
    }
</style>