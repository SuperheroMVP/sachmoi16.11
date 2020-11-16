@php
    /*
    $layout_page = shop_cart
    $cart: no paginate
    $shippingMethod: string
    $paymentMethod: string
    $totalMethod: array
    $dataTotal: array
    $shippingAddress: array
    $countries: array
    $attributesGroup: array
    */
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')

    <section class="section section-xl bg-default text-md-left">

        <div class="container">
            <div class="row">
                @if (count($cart) ==0)
                    <div class="col-md-12">
                        {!! trans('cart.cart_empty') !!}!
                    </div>
                @else
                    <div class="col-md-12">
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
                                    <th>XÓA</th>
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
                                            <div class="cart-qty">
                                                <input style="width: 150px; margin: 0 auto" type="number" data-id="{{ $item->id }}"
                                                       data-rowid="{{$item->rowId}}" onChange="updateCart($(this));"
                                                       class="item-qty form-control" name="qty-{{$item->id}}" value="{{$item->qty}}">
                                            </div>
                                            <span class="text-danger item-qty-{{$item->id}}" style="display: none;"></span>
                                            @if (session('arrErrorQty')[$product->id] ?? 0)
                                                <span class="help-block">
                                        <br>{{ trans('cart.minimum_value', ['value' => session('arrErrorQty')[$product->id]]) }}
                                    </span>
                                            @endif
                                        </td>
                                        <td align="right">{{sc_currency_render($item->subtotal)}}
                                        </td>
                                        <td align="center">
                                            <a onClick="return confirm('Bạn có chắc xóa sản phẩm này ra khỏi giỏ hàng không ?')" title="Remove Item" alt="Remove Item"
                                               class="cart_quantity_delete"
                                               href="{{ sc_route("cart.remove",['id'=>$item->rowId]) }}"><i class="fa fa-times"
                                                                                                            aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="apply-coupon-wrapper bg-white">
                            <div class="form__group d-flex justify-content-between flex-sm-row flex-column">
                                <button onClick="location.href='{{ sc_route('home') }}'" type="button" class="btn btn-5 btn-style-1 color-1"><i class="fa fa-arrow-left"></i>  {{ trans('cart.back_to_shop') }}</button>
                                <button onClick="location.href='{{route('cart.shipping_address') }}'" type="button" class="btn btn-5 btn-style-1 color-1">Xác nhận đơn hàng<i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                <button onClick="if(confirm('Bạn muốn có chắc muốn xóa tất cả giỏ hàng ?')) window.location.href='{{ sc_route('cart.clear') }}';" type="button" class="btn btn-5 btn-style-1 color-1"><i class="fa fa-window-close" aria-hidden="true"></i>  {{ trans('cart.remove_all') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-5">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-4">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-8">
                                <div class="cart-page-total bg--white">
                                    <h2>Đơn hàng của bạn</h2>
                                    <div class="cart-calculator-table table-content table-responsive">
                                        <table class="table">
                                            <tbody>
{{--                                            {{dd($dataTotal)}}--}}
                                            @foreach ($dataTotal as $key => $element)
                                                @if ($element['code']=='total')
                                                    <tr class="cart-total">
                                                        <th>{!! $element['title'] !!}</th>
                                                        <td><span class="price-ammount" id="{{ $element['code'] }}">{{$element['text'] }}</span></td>
                                                    </tr>

                                                @elseif($element['value'] !=0)
                                                    <tr class="cart-subtotal">
                                                        <th>{!! $element['title'] !!}</th>
                                                        <td><span class="price-ammount" id="{{ $element['code'] }}">{{$element['text'] }}</span></td>
                                                    </tr>
{{--                                                @elseif ($element['code']=='tax')--}}
{{--                                                    <tr class="cart-subtotal">--}}
{{--                                                        <th>{!! $element['title'] !!}</th>--}}
{{--                                                        <td><span class="price-ammount" id="{{ $element['code'] }}">{{$element['text'] }}</span></td>--}}
{{--                                                    </tr>--}}
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </section>
@endsection


{{-- breadcrumb --}}
@section('breadcrumb')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
                        <li><a href="{{route('product.all')}}">{{trans('front.shop')}}</a></li>
                        <li class="current"><a>{{ $title }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- //breadcrumb --}}


@push('scripts')
    <script type="text/javascript">
        @foreach ($totalMethod as $key => $plugin)
        @if (view()->exists($plugin['pathPlugin'].'::script'))
        @include($plugin['pathPlugin'].'::script')
        @endif
        @endforeach

        function updateCart(obj){
            var new_qty = obj.val();
            var rowid = obj.data('rowid');
            var id = obj.data('id');
            $.ajax({
                url: '{{ sc_route('cart.update') }}',
                type: 'POST',
                dataType: 'json',
                async: false,
                cache: false,
                data: {
                    id: id,
                    rowId: rowid,
                    new_qty: new_qty,
                    _token:'{{ csrf_token() }}'},
                success: function(data){
                    error= parseInt(data.error);
                    if(error ===0)
                    {
                        window.location.replace(location.href);
                    }else{
                        $('.item-qty-'+id).css('display','block').html(data.msg);
                    }

                }
            });
        }

        function buttonQty(obj, action){
            var parent = obj.parent();
            var input = parent.find(".item-qty");
            if(action === 'reduce'){
                input.val(parseInt(input.val()) - 1);
            }else{
                input.val(parseInt(input.val()) + 1);
            }
            updateCart(input)
        }

        $('#submit-order').click(function(){
            $('#form-order').submit();
            $(this).prop('disabled',true);
        });

        $('#addressList').change(function(){
            var id = $('#addressList').val();
            if(!id) {
                return;
            } else if(id == 'new') {
                $('#form-order [name="first_name"]').val('');
                $('#form-order [name="last_name"]').val('');
                $('#form-order [name="phone"]').val('');
                $('#form-order [name="postcode"]').val('');
                $('#form-order [name="company"]').val('');
                $('#form-order [name="country"]').val('');
                $('#form-order [name="address1"]').val('');
                $('#form-order [name="address2"]').val('');
            } else {
                $.ajax({
                    url: '{{ sc_route('member.address_detail') }}',
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    cache: false,
                    data: {
                        id: id,
                        _token:'{{ csrf_token() }}'},
                    success: function(data){
                        error= parseInt(data.error);
                        if(error === 1)
                        {
                            alert(data.msg);
                        }else{
                            $('#form-order [name="first_name"]').val(data.first_name);
                            $('#form-order [name="last_name"]').val(data.last_name);
                            $('#form-order [name="phone"]').val(data.phone);
                            $('#form-order [name="postcode"]').val(data.postcode);
                            $('#form-order [name="company"]').val(data.company);
                            $('#form-order [name="country"]').val(data.country);
                            $('#form-order [name="address1"]').val(data.address1);
                            $('#form-order [name="address2"]').val(data.address2);
                        }

                    }
                });
            }
        });

    </script>
    <script src="https://nhatranghome.com.vn/admin/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
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
