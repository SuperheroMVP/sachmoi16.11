@php

@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')
    <!-- Main content wrapper start -->

    <link rel="stylesheet" href="{{ asset($sc_templateFile.'/css/select2.min.css')}}">
    <div class="main-content-wrapper">
        <form class="sc-shipping-address" id="form-order" role="form" method="POST" action="{{ sc_route('cart.process') }}">
            {{ csrf_field() }}
            <div class="checkout-area pt--40 pb--80 pt-sm--30 pb-sm--60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- Checkout Area Start -->
                            <div class="checkout-wrapper bg--white">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="checkout-title">
                                            <h2>Địa chỉ của bạn</h2>
                                        </div>
                                        <div class="checkout-form">
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-md-6 mb-sm--30">
                                                        <label for="billing_lname" class="form__label">{{ trans('cart.last_name') }}<span>*</span></label>
                                                        <input type="text" name="last_name" id="last_name" class="form__input" value="{{old('last_name')}}">
                                                        @if($errors->has('last_name'))
                                                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form__group col-md-6">
                                                        <label for="billing_fname" class="form__label"> {{ trans('cart.first_name') }}: <span>*</span></label>
                                                        <input type="text" name="first_name" id="first_name" class="form__input" value="{{old('first_name')}}">
                                                        @if($errors->has('first_name'))
                                                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="billing_company" class="form__label">{{ trans('cart.email') }}<span>*</span></label>
                                                        <input type="email" name="email" id="email" class="form__input" value="{{old('email')}}">
                                                        @if($errors->has('email'))
                                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="billing_phone" class="form__label">{{ trans('cart.phone') }}<span>*</span></label>
                                                        <input type="telephone" name="phone" id="phone" class="form__input" value="{{old('phone')}}">
                                                        @if($errors->has('phone'))
                                                            <span class="help-block">{{ $errors->first('phone') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="billing_country" class="form__label">Tỉnh/Thành phố<span>*</span></label>
                                                        <select id="province" name="province" class="select2 form__input">>

                                                        </select>
                                                        @if($errors->has('province'))
                                                            <span class="help-block">{{ $errors->first('province') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-md-6 mb-sm--30">
                                                        <label for="billing_country" class="form__label">Quận/Huyện<span>*</span></label>
                                                        <select id="district" name="district" class="select2 form__input">>

                                                        </select>
                                                        @if($errors->has('district'))
                                                            <span class="help-block">{{ $errors->first('district') }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="form__group col-md-6">
                                                        <label for="billing_country" class="form__label">Xã/Phường/Thị trấn<span>*</span></label>
                                                        <select id="ward" name="ward" class="select2 form__input">>

                                                        </select>
                                                        @if($errors->has('ward'))
                                                            <span class="help-block">{{ $errors->first('ward') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-row mb--30">
                                                    <div class="form__group col-12">
                                                        <label for="billing_address" class="form__label">{{ trans('cart.address') }}<span>*</span></label>
                                                        <input type="text" name="address" id="address" class="form__input" placeholder="{{ trans('cart.address') }}" value="{{old('address')}}">
                                                        @if($errors->has('address'))
                                                            <span class="help-block">{{ $errors->first('address') }}</span>
                                                        @endif
                                                    </div>
                                               </div>
                                                 <div class="form-row mb--30">
                                                <div class="form__group col-12">
                                                    <label  class="control-label"><i class="fa fa-calendar-o"></i> {{ trans('cart.note') }}:</label>
                                                    <textarea rows="1" name="comment" placeholder="{{ trans('cart.note') }}....">{{old('comment')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-md--30">
                                        <div class="order-details">
                                            <h3 class="heading-tertiary color-main"><i class="fa fa-truck" aria-hidden="true"></i> PHƯƠNG THỨC VẬN CHUYỂN</h3>
                                            <div class="order-table table-content table-responsive mb--30">
                                                @foreach ($shippingMethod as $key => $shipping)
                                                    <div class="form-check">
                                                        <input type="radio" name="shippingMethod" checked value="{{ $shipping['key'] }}"  style="position: relative;"
                                                            {{ ($shipping['permission'])?'':'disabled' }}>
                                                        <label class="radio-inline" for="payment-{{ $shipping['key'] }}">
                                                            <span><img src="{{asset($shipping['image']) }}" width="40px" alt="{{$shipping['title']}}"><span class="title-payment">{{$shipping['title']}}</span></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="order-details mt-5">
                                            <h3 class="heading-tertiary color-main"><i class="fa fa-credit-card-alt"></i> PHƯƠNG THỨC THANH TOÁN</h3>
                                            <div class="order-table table-content table-responsive mb--30">
                                                @foreach ($paymentMethod as $key => $payment)

                                                    <div class="form-check">
                                                            <input type="radio" name="paymentMethod" checked value="{{ $payment['key'] }}"  style="position: relative;"
                                                                {{ ($payment['permission'])?'':'disabled' }}>
                                                            <label class="radio-inline" for="payment-{{ $payment['key'] }}">
{{--                                                                <img title="{{ $payment['title'] }}" alt="{{ $payment['title'] }}" src="{{ asset($payment['image']) }}" https://cdn0.fahasa.com/skin/frontend/base/default/images/payment_icon/ico_cashondelivery.svg>--}}
                                                                <span><img src="{{asset($payment['image']) }}" width="40px" alt="{{$payment['title']}}"><span class="title-payment">{{$payment['title']}}</span></span>
                                                            </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkout Area End -->
                        </div>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="heading-tertiary mt-5 pl-3 pb-3">KIỂM TRA LẠI ĐƠN HÀNG</h3>
                            <div class="cart-wrapper bg--white mb-sm--60">
                                <div class="cart-table table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr >
                                            <th>No.</th>
                                            <th>{{ trans('product.sku') }}</th>
                                            <th>{{ trans('product.name') }}</th>
                                            <th>{{ trans('product.price') }}</th>
                                            <th>{{ trans('product.quantity') }}</th>
                                            <th>{{ trans('product.total_price') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $item)
                                            @php
                                                $n = (isset($n)?$n:0);
                                                $n++;
                                                $product = $modelProduct->start()->getDetail($item->id);
                                            @endphp
                                            <tr class="row_cart form-group {{ session('arrErrorQty')[$product->id] ?? '' }}{{ (session('arrErrorQty')[$product->id] ?? 0) ? ' has-error' : '' }}">
                                                <td>{{ $n }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>
                                                    <a href="{{$product->getUrl() }}" class="row_cart-name">
                                                        <img width="100" src="{{asset($product->getImage())}}"
                                                             alt="{{ $product->name }}">
                                                        <span>
                                                {{ $product->name }}<br />
                                                {{-- Process attributes --}}
                                                            @if ($item->options->count())
                                                                @foreach ($item->options as $groupAtt => $att)
                                                                    <b>{{ $attributesGroup[$groupAtt] }}</b>: {!! sc_render_option_price($att) !!}
                                                                @endforeach
                                                            @endif
                                                            {{-- //end Process attributes --}}
                                            </span>
                                                    </a>
                                                </td>
                                                <td>{!! $product->showPrice() !!}</td>
                                                <td class="cart-col-qty">
                                                    {{$item->qty}}
                                                </td>
                                                <td align="right">{{sc_currency_render($item->subtotal)}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-sidebar">
               <div class="position-sidebar-content">
                   <div class="container">
                       <div class="sm_checkout_total_content">
                           @foreach ($dataTotal as $key => $element)
                               @if ($element['code']=='total')
                                   <div class="sm_checkout_total d-flex justify-content-end pb-3">
                                       <div class="title-total">{!! $element['title'] !!}:</div>
                                       <div class="sm-total" id="{{ $element['code'] }}">{{$element['text'] }}</div>
                                   </div>
                               @elseif($element['value'] !=0)
                                   <div class="sm_checkout_total d-flex justify-content-end pb-2">
                                       <div class="title-total">{!! $element['title'] !!}:</div>
                                       <div class="sm-total" id="{{ $element['code'] }}">{{$element['text'] }}</div>
                                   </div>
                               @elseif ($element['code']=='tax')
                                   <div class="sm_checkout_total d-flex justify-content-end pb-2">
                                       <div class="title-total">{!! $element['title'] !!}:</div>
                                       <div class="sm-total" id="{{ $element['code'] }}">{{$element['text'] }}</div>
                                   </div>
                               @elseif($element['code'] =='shipping')
                                   <div class="sm_checkout_total_grand-total d-flex justify-content-end pb-2">
                                       <div class="title-total2 " style="font-size: 18px">{!! $element['title'] !!}:</div>
                                       <div class="sm-total2" id="{{ $element['code'] }}">{{$element['text'] }}</div>
                                   </div>
                               @endif
                           @endforeach
                       </div>
                       <div class="sm_checkout_bottom mt-3 mb-3">
                           <div class="sm_checkout_bottom-content d-flex justify-content-between">
                               <div><a class="text-dark" href="{{route('cart')}}"><span class="pr-4 "><i class="fa fa-arrow-left" aria-hidden="true"></i></span>Quay về giỏ hàng</a></div>
                               <div><button type="submit" class="btn btn-9">Xác nhận thanh toán</button></div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </form>
    </div>

    <!-- Main content wrapper end -->
@endsection

@section('breadcrumb')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
                        <li class="current"><a>{{ $title }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    {{-- style css --}}
@endpush

@push('scripts')
    <script src="{{ asset($sc_templateFile.'/js/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            // get_province();
            get_default_ward();
            $(document).on('change', '#province', function () {
                let code = $(this).find('option:selected').data('code');
                get_district(code);
            });

            $(document).on('change', '#district', function () {
                let code = $(this).find('option:selected').data('code');
                get_ward(code);
            });
        });

        async function get_default_ward() {
            await get_default_district();
            let code = $('#district').find('option:selected').data('code');
            let ward = "{!! old()?old('ward'):$shippingAddress['ward']??'' !!}";
            $('#ward').append($('<option value="">Chọn xã/phường/thị trấn</option>'));
            $.getJSON('{{asset('hcvn/xa_phuong.json')}}', function (json) {
                jQuery.each(json, function (index, item) {
                    if (item.parent_code == code) {
                        let opt;
                        if (ward === item.name_with_type) {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '" selected>' + item.name_with_type + '</option>');
                        } else {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '">' + item.name_with_type + '</option>');
                        }
                        $('#ward').append(opt);
                    }
                });
            });
        }

        function get_ward(code) {
            let ward = "{!! old()?old('ward'):$shippingAddress['ward']??'' !!}";
            $.getJSON('{{asset('hcvn/xa_phuong.json')}}', function (json) {
                $('#ward').empty();
                $('#ward').append($('<option value="">Chọn xã/phường/thị trấn</option>'));
                jQuery.each(json, function (index, item) {
                    if (item.parent_code == code) {
                        let opt;
                        if (ward === item.name_with_type) {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '" selected>' + item.name_with_type + '</option>');
                        } else {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '">' + item.name_with_type + '</option>');
                        }
                        $('#ward').append(opt);
                    }
                });
            });
        }

        async function get_default_district() {
            await get_defaut_province();
            let code = $('#province').find('option:selected').data('code');
            let district = "{!! old()?old('district'):$shippingAddress['district']??'' !!}";
            $('#district').append($('<option value="">Chọn quận/huyện</option>'));
            return new Promise(resolve => {
                $.getJSON('{{asset('hcvn/quan_huyen.json')}}', function (json) {
                    jQuery.each(json, function (index, item) {
                        if (item.parent_code == code) {
                            let opt;
                            if (district === item.name_with_type) {
                                opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '" selected>' + item.name_with_type + '</option>');
                            } else {
                                opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '">' + item.name_with_type + '</option>');
                            }
                            $('#district').append(opt);
                        }
                    });
                    resolve($('#district'));
                });
            });
        }

        function get_district(code) {
            let district = "{!! old()?old('district'):$shippingAddress['district']??'' !!}";
            $.getJSON('{{asset('hcvn/quan_huyen.json')}}', function (json) {
                $('#district').empty();
                $('#district').append($('<option value="">Chọn quận/huyện</option>'));
                $('#ward').empty();
                $('#ward').append($('<option value="">Chọn xã/phường/thị trấn</option>'));
                jQuery.each(json, function (index, item) {
                    if (item.parent_code == code) {
                        let opt;
                        if (district === item.name_with_type) {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '" selected>' + item.name_with_type + '</option>');
                        } else {
                            opt = $('<option data-code="' + index + '" value="' + item.name_with_type + '">' + item.name_with_type + '</option>');
                        }
                        $('#district').append(opt);
                    }
                });
            });
        }

        function get_defaut_province() {
            return new Promise(resolve => {
                let province = "{!! old()?old('province'):$shippingAddress['province']??'' !!}";
                $('#province').append($('<option value="">Chọn tỉnh/thành</option>'));
                $.getJSON('{{asset('hcvn/tinh_tp.json')}}', function (json) {
                    jQuery.each(json, function (index, item) {
                        let opt;
                        if (province === item.name) {
                            opt = $('<option data-code="' + index + '" value="' + item.name + '" selected>' + item.name + '</option>');
                        } else {
                            opt = $('<option data-code="' + index + '" value="' + item.name + '">' + item.name + '</option>');
                        }
                        $('#province').append(opt);
                    });
                    resolve($('#province'));
                });
            });
        }

        function get_province() {
            let province = "{!! old()?old('province'):$obj['province']??'' !!}";
            $.getJSON('{{asset('hcvn/tinh_tp.json')}}', function (json) {
                $('#province').empty();
                $('#district').empty();
                $('#district').append($('<option value="">Chọn quận/huyện</option>'));
                $('#ward').empty();
                $('#ward').append($('<option value="">Chọn xã/phường/thị trấn</option>'));
                jQuery.each(json, function (index, item) {
                    let opt;
                    if (province === item.name) {
                        opt = $('<option data-code="' + index + '" value="' + item.name + '" selected>' + item.name + '</option>');
                    } else {
                        opt = $('<option data-code="' + index + '" value="' + item.name + '">' + item.name + '</option>');
                    }
                    $('#province').append(opt);
                });
            });
        }
    </script>
@endpush


