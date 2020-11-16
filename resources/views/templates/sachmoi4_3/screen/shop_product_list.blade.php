@php
/*
$layout_page = product_list
**Variables:**
- $subCategory: paginate
Use paginate: $subCategory->appends(request()->except(['page','_token']))->links()
- $products: paginate
Use paginate: $products->appends(request()->except(['page','_token']))->links()

*/ 
$categories = $modelCategory->start()->getListAll(['sc_status' => 1]);
$categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
@endphp

@extends($sc_templatePath.'.layout')

{{-- block_main_content_center --}}
@section('block_main_content_center')
    <!-- Main Wrapper Start -->
    <main id="content" class="main-content-wrapper">
        <div class="shop-area pt--40 pb--80 pt-sm--30 pb-sm--60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-lg-2 mb-md--40">
                        <!-- Shop Toolbar Start -->
                        <div class="shop-toolbar">
                            <div class="shop-toolbar__grid-list">
                                <ul class="nav">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#grid"><i class="fa fa-th"></i></a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#list"><i class="fa fa-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-toolbar__shorter">
                                <label>Sắp xếp:</label>
                                <form action="" method="GET" id="filter_sort">
                                    @php
                                        $queries = request()->except(['filter_sort','page']);
                                    @endphp
                                    @foreach ($queries as $key => $query)
                                        <input type="hidden" name="{{ $key }}" value="{{ $query }}">
                                    @endforeach
                                    <select class="short-select nice-select" name="filter_sort">
                                        <option value="price_asc" {{ ($filter_sort =='price_asc')?'selected':'' }}>{{ trans('front.filters.price_asc') }}</option>
                                        <option value="price_desc" {{ ($filter_sort =='price_desc')?'selected':'' }}>{{ trans('front.filters.price_desc') }}</option>
                                        <option value="sort_asc" {{ ($filter_sort =='sort_asc')?'selected':'' }}>{{ trans('front.filters.sort_asc') }}</option>
                                        <option value="sort_desc" {{ ($filter_sort =='sort_desc')?'selected':'' }}>{{ trans('front.filters.sort_desc') }}</option>
                                        <option value="id_asc" {{ ($filter_sort =='id_asc')?'selected':'' }}>{{ trans('front.filters.id_asc') }}</option>
                                        <option value="id_desc" {{ ($filter_sort =='id_desc')?'selected':'' }}>{{ trans('front.filters.id_desc') }}</option>
                                    </select>
                                </form>
                            </div>
                            <span class="shop-toolbar__product-count">{!! trans('front.result_item', ['item_from' => $products->firstItem(), 'item_to'=> $products->lastItem(), 'item_total'=> $products->total()  ]) !!}</span>
                        </div>
                        <!-- Shop Toolbar End -->

                        <!-- Shop Layout Start -->
                        <div class="main-shop-wrapper">
                            <div class="tab-content" id="myTabContent-2">
                                <div class="tab-pane show active" id="grid">
                                    <div class="product-grid-view three-column">
                                        @if (count($products) ==0)
                                            {{ trans('front.empty_product') }}
                                        @else
                                        <div class="row no-gutters">
                                            @foreach ($products as  $key => $product)
                                               <div class="col-md-4 col-sm-6">
                                                <div class="product-box product-box-hover-down bg--white color-1">
                                                    <div class="product-box__img">
                                                        <img src="{{asset($product->image)}}" alt="product" class="primary-image">
                                                        <img src="{{asset($product->image)}}" alt="product" class="secondary-image">
                                                        <a href="{{$product->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                    </div>
                                                    <div class="product-box__content">
                                                        <h3 class="product-box__title"><a href="{{$product->getUrl()}}">{{$product->name}}</a></h3>
                                                        <div class="product-box__price">
{{--                                                            <span class="regular-price">$100.00</span>--}}
{{--                                                            <span class="sale-price">$80.00</span>--}}
                                                            {!! $product->showPrice() !!}
                                                        </div>
                                                    </div>
                                                    <div class="product-box__action action-2">
                                                        <a onClick="addToCartAjax('{{ $product->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                                        <a onClick="addToCartAjax('{{ $product->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                        <a onClick="addToCartAjax('{{ $product->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                        <div class="col-12">
                                            {{ $products->appends(request()->except(['page','_token']))->links() }}
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="list">
                                    <div class="product-list-view">
                                        @if (count($products) ==0)
                                            {{ trans('front.empty_product') }}
                                        @else
                                            @foreach ($products as  $key => $product)
                                              <div class="product-box product-box--list bg--white">
                                                 <div class="row">
                                                <div class="col-md-4">
                                                    <div class="product-box__img">
                                                        <img src="{{asset($product->image)}}" alt="product" class="primary-image">
                                                        <img src="{{asset($product->image)}}" alt="product" class="secondary-image">
                                                        <a href="{{$product->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="product-box__content">
                                                        <h3 class="product-box__title"><a href="{{$product->getUrl()}}">{{$product->name}}</a></h3>
                                                        <div class="product-box__price">
{{--                                                            <span class="regular-price">$180.00</span>--}}
{{--                                                            <span class="sale-price">$160.00</span>--}}
                                                            {!! $product->showPrice() !!}
                                                        </div>
                                                        <p class="product-box__desc">
                                                            {{$product->description}}
                                                        </p>
                                                        <div class="product-box__action action-4">
                                                            <a onClick="addToCartAjax('{{ $product->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                            <a onClick="addToCartAjax('{{ $product->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                                            <a onClick="addToCartAjax('{{ $product->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              </div>
                                            @endforeach
                                        @endif
{{--                                        <ul class="pagination">--}}
{{--                                            <li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>--}}
{{--                                            <li><a href="#">1</a></li>--}}
{{--                                            <li class="current"><a href="#">2</a></li>--}}
{{--                                            <li><a href="#">3</a></li>--}}
{{--                                            <li><a href="#">4</a></li>--}}
{{--                                            <li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>--}}
{{--                                        </ul>--}}
                                            <div class="col-12">

                                                {{ $products->appends(request()->except(['page','_token']))->links() }}

                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Layout End -->
                    </div>
                    <div class="col-lg-3 order-lg-1">
                        <aside class="sidebar">
                            <!-- Product Categories Widget Start -->
                            <div class="sidebar-widget product-widget product-cat-widget">
                                <h3 class="widget-title">{{trans('front.categories')}}</h3>
                                <div class="widget_conent">
                                    @if($categoriesTop->count())
                                      <ul class="product-categories">
                                          @foreach($categoriesTop as $category)
                                              @if(!empty($categories[$category->id]))
                                                <li class="cat-item cat-parent">
                                                <a href="{{$category->getUrl()}}">{{$category->title}}</a>
{{--                                                <span class="count">(10)</span>--}}
                                                <ul class="children">
                                                    @foreach($categories[$category->id] as $cateChild)
                                                    <li class="cat-item">
                                                        <a href="{{$cateChild->getUrl()}}">{{$cateChild->title}}</a>
                                                        <span class="count">({{count($cateChild->productDescription)}})</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                              @else
                                                <li class="cat-item">
                                                <a href="{{$category->getUrl()}}">{{$category->title}}</a>
{{--                                                <span class="count">(12)</span>--}}
                                            </li>
                                              @endif
                                          @endforeach
                                      </ul>
                                    @endif
                                </div>
                            </div>
                            <!-- Product Categories Widget End -->
                            @php
                                $brands = $modelBrand->start()->getData()
                            @endphp
                            @if (!empty($brands))
                                <div class="sidebar-widget product-widget product-color-widget">
                                    <h3 class="widget-title">{{ trans('front.brands') }}</h3>
                                    <div class="widget_conent">
                                        <ul class="product-color">
                                            @foreach ($brands as $brand)
                                                <li><a href="{{ $brand->getUrl() }}">{{ $brand->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        <!--brands_products-->
                                    </div>
                                </div>
                                <!--/brands_products-->
                            @endif

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Main Wrapper End -->
@endsection
{{-- //block_main_content_center --}}


{{-- breadcrumb --}}
@section('breadcrumb')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ sc_route('home') }}">{{ trans('front.home') }}</a></li>
                        <li class="current"><a>{{ $title}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- //breadcrumb --}}

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
<script type="text/javascript">
  $('[name="filter_sort"]').change(function(event) {
      $('#filter_sort').submit();
  });
</script>
@endpush