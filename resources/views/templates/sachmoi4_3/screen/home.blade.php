@php
/*
$layout_page = home
*/ 
@endphp

@extends($sc_templatePath.'.layout')
@php
    $categories = $modelCategory->start()->getListAll(['sc_status' => 1]);
    $categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
    $productsNew = $modelProduct->start()->getProductLatest()->setlimit(sc_config('product_top'))->getData();
    $news = $modelNews->start()->setlimit(sc_config('item_top'))->getData();
    $banners = $modelBanner->start()->getBanner()->getData();
    $productsNew = $modelProduct->start()->getProductLatest()->setlimit(8)->getData();
    $bannerStore = $modelBanner->start()->getBannerStore()->setlimit(2)->getData();
    $background = $modelBanner->start()->getBackground()->setlimit(1)->getData();
    $list_brands = $modelBrand->start()->setlimit(5)->getData();
    $productsHot = $modelProduct->start()->getProductHot()->setlimit(4)->getData();
@endphp

@section('block_main')
      <main id="content" class="main-content-wrapper bg--zircon-light">
          <!-- Hero Area Start -->
          <div class="hero-area pb--40 pb-sm--30">
              <div class="container">
                  <div class="row custom-row">
                      <div class="col-lg-9 offset-lg-3">
                          <div class="slider-wrapper owl-carousel right-side-dot owl-loaded owl-drag" id="homepage-slider-2">
                             @if($banners->count()>0)
                                  @foreach($banners as $banner)
                                      <div class="single-slider single-slider--3 content-v-center" style="background-image: url({{ asset($banner->image)}});">
                                          <div class="slider-content text-center">
                                              <p class="color--white" data-animation="zoomIn" data-duration=".3s" data-delay=".2s" style="animation-delay: 0.2s; animation-duration: 0.3s;">HASTOTAL BOOKS </p>
                                              <h1 class="mb--20 color--white slider-heading-big" data-animation="zoomIn" data-duration=".3s" data-delay=".2s" style="animation-delay: 0.2s; animation-duration: 0.3s;">
                                                  {!!$banner->html!!}</h1>
                                              <div class="slider-btn-group" data-animation="fadeInBottom" data-duration=".3s" data-delay=".9s" style="animation-delay: 0.9s; animation-duration: 0.3s;">
                                                  <a href="{{route('product.all')}}" class="btn btn-borderd btn-slider color--white color-brand-2 btn-style-1">{{trans('front.shop')}}</a>
                                              </div>
                                          </div>
                                      </div>
                                  @endforeach
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Hero Area End -->
          <div class="new-products-area section-padding section-sm-padding">
             <div class="container">
                  <div class="row align-items-center mb--20">
                          <div class="section-title title-1 text-md-left text-center mb-sm--20">
                              <h2>Sản phẩm mới nhất</h2>
                          </div>
                  </div>
                  <div class="row">
                      <div class="col-12">
                          <div class="new-products-carousel bg--white owl-carousel js-new-products-carousel ">
                              @if(count($productsNew)>0)
                                @for($i=0;$i<count($productsNew); $i++)
                                <div class="new-products-group">
                                    <div class="product-box horizontal bg--white color-3 right-line bottom-line">
                                        <div class="product-box__img">
                                            <img src="{{asset($productsNew[$i]->image)}}" alt="product" class="primary-image">
                                            <img src="{{asset($productsNew[$i]->image) }}" alt="product" class="secondary-image">
                                        </div>
                                        <div class="product-box__content">
                                            <h3 class="product-box__title"><a href="{{$productsNew[$i]->getUrl()}}">{{ $productsNew[$i]->name }}</a></h3>

                                            <div class="product-box__price">
                                                <span class="sale-price">{{'Số lượng :' . $productsNew[$i]->stock }}</span>
                                            </div>
                                            <div class="product-box__price">
                                                <span class="sale-price">{{ $productsNew[$i]->price .'đ' }}</span>
                                            </div>
                                        </div>
                                        <div class="product-box__action action-1">
                                            <a onClick="addToCartAjax('{{ $productsNew[$i]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to cart"><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                    </div>

                                    <div class="product-box horizontal bg--white color-3 right-line">
                                        @if(isset($productsNew[$i+1]->image))
                                        <div class="product-box__img">
                                            <img src="{{asset($productsNew[$i+1]->image) }}" alt="product" class="primary-image">
                                            <img src="{{asset($productsNew[$i+1]->image)}}" alt="product" class="secondary-image">
                                        </div>
                                        <div class="product-box__content">
                                            <h3 class="product-box__title"><a href="{{ $productsNew[$i+1]->getUrl() }}">{{ $productsNew[$i+1]->name }}</a></h3>

                                            <div class="product-box__price">
                                                <span class="sale-price">{{ $productsNew[$i+1]->price .'đ' }}</span>
                                            </div>
                                        </div>
                                        <div class="product-box__action action-1">
                                            <a onClick="addToCartAjax('{{ $productsNew[$i]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to cart"><i class="fa fa-shopping-bag"></i></a>
                                        </div>
                                        @endif
                                    </div>

                                </div>

                                <?php $i++; ?>
                                @endfor
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Promo area Start -->
          <div class="promo-area section-padding section-sm-padding">
              <div class="container">
                  <div class="row">
                      @if(count($bannerStore)> 0)
                          @foreach($bannerStore as $banner_store)
                              <div class="col-md-6">
                                  <div class="promo-box image-box mb-sm--20">
                                      <a target="{{$banner_store->target}}" href="{{$banner_store->url}}">
                                          <img src="{{ asset($banner_store->image)}}" alt="promo"></a>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
          </div>
          <!-- Promo area End -->
          <!-- Category products area Start -->
          <div class="category-porducts-area section-padding section-sm-padding">
              <div class="container">
                  @foreach ($categoriesTop as $category)
                    <div class="row no-gutters  mt-4 mb-4 bg-white">
                      <div class="col-lg-3 col-md-4">
                          <div class="section-title title-2 yellow-dark-bg text-md-left text-center">
                              <h3>{{$category->title}}</h3>
                          </div>
                          <div class="promo-box full-width">
                              <a>
                                  <img src="{{asset($category->image)}}" alt="promo">
                              </a>
                          </div>
                      </div>
                      <div class="col-lg-9 col-md-8 text-md-right text-center">
                          <ul class="category-list list-2 brand-bg nav nav-tabs" role="tablist">
                              @if(!empty($categories[$category->id]))
                                  @foreach ($categories[$category->id] as $cateChild)
                                     <li><a class="" href="#tab-{{ $cateChild->id }}" role="tab" data-toggle="tab">{{$cateChild->title}}</a></li>
                                  @endforeach
                              @endif
                          </ul>

                          <div class="tab-content" id="v-pills-tabContent">
                              @php $i = 0;@endphp
                              @if(!empty($categories[$category->id]))
                               @foreach ($categories[$category->id] as $cateChild)
                                    <div role="tabpanel" class="{{ ($i==0) ? 'tab-pane fade show active' : 'tab-pane fade' }}" id="tab-{{ $cateChild->id }}">
                                        @if(count($cateChild->productDescription))
                                           <div class="row no-gutters equal-container ">
                                              <div class="col-lg-5 col-md-5 col-12 order-md-2 order-1 ">
                                                  @empty(!$cateChild->productDescription[0])
                                                  <div class="product-box limited-product bg--white color-3 ">
                                                      <div class="product-box__img">
                                                          <img src="{{asset($cateChild->productDescription[0]->image)}}" alt="product" class="primary-image">
                                                          <a href="{{$cateChild->productDescription[0]->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                      </div>
                                                      <div class="product-box__content">

                                                          <a href="{{$cateChild->productDescription[0]->getUrl()}}"><h3 class="product-box__title">{{$cateChild->productDescription[0]->descriptions[0]->name}}</h3></a>
                                                          <div class="product-box__price">
                                                              {!! $cateChild->productDescription[0]->showPrice() !!}
                                                          </div>
                                                          <a onClick="addToCartAjax('{{ $cateChild->productDescription[0]->id }}','default')" class="btn add-to-cart"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                      </div>
                                                  </div>
                                                  @endempty
                                              </div>

                                              <div class="col-lg-7 col-md-7 col-12 order-md-3 order-2 mt-md--30">
                                                  <div class="category-product-carousel product-carousel-hover owl-carousel js-category-product-carousel">
                                                      @for($j=0;$j<count($cateChild->productDescription); $j++)
                                                          <div class="category-product-group">
                                                              <div class="product-box product-box-hover-down bg--white color-1 border-right border-bottom">
                                                                  <div class="product-box__img">
                                                                      <img src="{{asset($cateChild->productDescription[$j]->image)}}" alt="product" class="primary-image">
                                                                      <img src="{{asset($cateChild->productDescription[$j]->image)}}" alt="product" class="secondary-image">
                                                                      <a href="{{$cateChild->productDescription[$j]->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                                  </div>
                                                                  <div class="product-box__content">
                                                                      <h3 class="product-box__title"><a href="{{$cateChild->productDescription[$j]->getUrl()}}">
                                                                              @foreach($cateChild->productDescription[$j]->descriptions as $description)
                                                                                  {{ ($description->lang == sc_get_locale()) ? $description->name : '' }}
                                                                              @endforeach

                                                                          </a></h3>
                                                                      <div class="product-box__price">
                                                                          <span class="sale-price">{!! $cateChild->productDescription[$j]->showPrice() !!}</span>
                                                                      </div>
                                                                  </div>
                                                                  <div class="product-box__action action-2">
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j]->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j]->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                                                  </div>
                                                              </div>
                                                              @isset($cateChild->productDescription[$j+1])
                                                                <div class="product-box product-box-hover-down bg--white color-1 border-right border-bottom">
                                                                  <div class="product-box__img">
                                                                      <img src="{{asset($cateChild->productDescription[$j+1]->image)}}" alt="product" class="primary-image">
                                                                      <img src="{{asset($cateChild->productDescription[$j+1]->image)}}" alt="product" class="secondary-image">
                                                                      <a href="{{$cateChild->productDescription[$j+1]->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                                  </div>
                                                                  <div class="product-box__content">
                                                                      <h3 class="product-box__title"><a href="{{$cateChild->productDescription[$j+1]->getUrl()}}">
                                                                              @foreach($cateChild->productDescription[$j+1]->descriptions as $description2)
                                                                                  {{ ($description2->lang == sc_get_locale()) ? $description2->name : '' }}
                                                                              @endforeach
                                                                          </a></h3>
                                                                      <div class="product-box__price">
                                                                          <span class="sale-price">{!! $cateChild->productDescription[$j+1]->showPrice() !!}</span>
                                                                      </div>
                                                                  </div>
                                                                  <div class="product-box__action action-2">
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j+1]->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j+1]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                                      <a onClick="addToCartAjax('{{ $cateChild->productDescription[$j+1]->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                                                  </div>
                                                              </div>
                                                              @endisset
                                                          </div>
                                                          <?php $j++; ?>
                                                      @endfor
                                                  </div>
                                              </div>
                                           </div>
                                        @endif
                                    </div>
                                  @php $i++;@endphp
                              @endforeach
                             @endif
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
          <!-- Category products area End -->
                    <!-- Promo area Start -->
          <div class="promo-area section-padding section-sm-padding">
              <div class="container">
                  <div class="row">
                      @if($background->count()>0)
                          @foreach($background as $bg)
                              <div class="col-12">
                                  <div class="promo-box">
                                      <a target="{{$bg->target}}" href="{{$bg->url}}"><img src="{{asset($bg->image)}}" alt="promo"></a>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
          </div>
          <!-- Promo area End -->
                    <!-- Category products area Start -->
          <div class="category-porducts-area pt--40 pb--80 pt-sm--30 pb-sm--60">
              <div class="container">
                  <div class="row no-gutters mb--20">
                      <div class="col-12">
                          <div class="section-title title-1">
                              <h2>{{trans('front.products_hot')}}</h2>
                          </div>
                      </div>
                  </div>
                  <div class="row no-gutters brand-tab">
                      <div class="col-lg-2 col-md-3 order-1">
                          <div class="nav flex-column brand-tab__head" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              @foreach($list_brands as $brand)
                                  <a class="nav-link brand-tab__link active" id="v-company-1-tab" data-toggle="tab"  role="tab" aria-selected="true">
                                      <img src="{{ asset($brand->getThumb()) }}" alt="brand">
                                  </a>
                              @endforeach
                          </div>
                      </div>
                      <div class="col-lg-5 col-12 order-lg-2 order-3 mt-md--30">
                          <div class="promo-box">
                              <a href="#">
                                  <img src="https://demo.hasthemes.com/lazio-preview/lazio/assets/img/banner/home1-brandsale.jpg" alt="promo">
                              </a>
                          </div>
                      </div>
                      <div class="col-lg-5 col-md-9 order-lg-3 order-2">
                          <div class="tab-content brand-tab__content" id="v-pills-tab-content">
                              <div class="tab-pane brand-tab__pane fade show active" id="v-company-1" role="tabpanel" aria-labelledby="v-company-1-tab">
                                  @for($h=0;$h<count($productsHot); $h++)
                                      <div class="brand-tab__pane-bottom">
                                      <div class="product-box product-box-hover-down bg--white color-3 border-left border-right border-bottom">
                                          <div class="product-box__img">
                                              <img src="{{asset($productsHot[$h]->image)}}" alt="product" class="primary-image">
                                              <img src="{{asset($productsHot[$h]->image)}}" alt="product" class="secondary-image">
                                              <a href="{{$productsHot[$h]->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                          </div>
                                          <div class="product-box__content">
                                              <h3 class="product-box__title"><a href="{{$productsHot[$h]->getUrl()}}">{{$productsHot[$h]->name}}</a></h3>
                                              <div class="product-box__price">
                                                  <span class="sale-price">{!! $productsHot[$h]->showPrice() !!}</span>
                                              </div>
                                          </div>
                                          <div class="product-box__action action-2">
                                              <a onClick="addToCartAjax('{{ $productsHot[$h]->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                              <a onClick="addToCartAjax('{{ $productsHot[$h]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                              <a onClick="addToCartAjax('{{ $productsHot[$h]->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                          </div>
                                      </div>
                                          @if(isset($productsHot[$h+1]->image))
                                          <div class="product-box product-box-hover-down bg--white color-3 border-right border-bottom">
                                                  <div class="product-box__img">
                                                      <img src="{{asset($productsHot[$h+1]->image)}}" alt="product" class="primary-image">
                                                      <img src="{{asset($productsHot[$h+1]->image)}}" alt="product" class="secondary-image">
                                                      <a href="{{$productsHot[$h+1]->getUrl()}}" data-toggle="modal" data-target="#productModal" class="product-box__quick-view"><i class="fa fa-search"></i></a>
                                                  </div>
                                                  <div class="product-box__content">
                                                      <h3 class="product-box__title"><a href="{{$productsHot[$h+1]->getUrl()}}">{{$productsHot[$h]->name}}</a></h3>

                                                      <div class="product-box__price">
                                                          <span class="sale-price">{!! $productsHot[$h+1]->showPrice() !!}</span>
                                                      </div>
                                                  </div>
                                                  <div class="product-box__action action-2">
                                                      <a onClick="addToCartAjax('{{ $productsHot[$h+1]->id }}','wishlist')" class="add-to-wishlist" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_wishlist')}}"><i class="fa fa-heart-o"></i></a>
                                                      <a onClick="addToCartAjax('{{ $productsHot[$h+1]->id }}','default')" class="add-to-cart" data-toggle="tooltip" data-placement="top" title="{{trans('front.add_to_cart')}}"><i class="fa fa-shopping-bag"></i>{{trans('front.add_to_cart')}}</a>
                                                      <a onClick="addToCartAjax('{{ $productsHot[$h+1]->id }}','compare')" class="add-to-compare" data-toggle="tooltip" data-placement="top" title="{{trans('front.compare_page')}}"><i class="fa fa-refresh"></i></a>
                                                  </div>
                                          </div>
                                          @endif
                                          @php  $h++;@endphp
                                      </div>
                                  @endfor
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Category products area End -->

      </main>
@endsection

@section('news')
{{--   @if ($news)
  <!-- Our Blog-->
  <section class="section section-xxl section-last bg-gray-21">
    <div class="container">
      <h2 class="wow fadeScale">{{ trans('front.blog') }}</h2>
    </div>
    <!-- Owl Carousel-->
    <div class="owl-carousel owl-style-7" data-items="1" data-sm-items="2" data-xl-items="3" data-xxl-items="4" data-nav="true" data-dots="true" data-margin="30" data-autoplay="true">
      @foreach ($news as $blog)
      <!-- Post Creative-->
      <article class="post post-creative"><a class="post-creative-figure" href="{{ $blog->getUrl() }}"><img src="{{ asset($blog->getThumb()) }}" alt="" width="420" height="368"/></a>
        <div class="post-creative-content">
          <h5 class="post-creative-title"><a href="{{ $blog->getUrl() }}">{{ $blog->title }}</a></h5>
          <div class="post-creative-time">
            <time datetime="{{ $blog->created_at }}">{{ $blog->created_at }}</time>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </section>
  @endif --}}
@endsection

@push('styles')
{{-- Your css style --}}
@endpush

@push('scripts')
{{-- Your scripts --}}
@endpush
