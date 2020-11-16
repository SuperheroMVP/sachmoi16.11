      <!-- Page Header-->
@php
    $categories = $modelCategory->start()->getListAll(['sc_status' => 1]);
    $categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
@endphp
<header class="header header-1">
    <div class="header-top header-1--top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-lg-left text-center">
                    <!-- Contact Info Start -->
                    <ul class="contact-info contact-info--1">
                        <li class="contact-info__list"><i class="fa fa-envelope-open"></i><a href="{{sc_store('email')}}">{{sc_store('email')}}</a></li>
                        <li class="contact-info__list"><i class="fa fa-phone"></i><a href="{{sc_store('phone')}}">{{sc_store('phone')}}</a></li>
                    </ul>
                    <!-- Contact Info End -->
                </div>
                <div class="col-lg-6 text-right">
                    <!-- Header Top Nav Start -->
                    <div class="header-top__nav header-top__nav--1 d-flex justify-content-lg-end justify-content-center">
                        @if (count($sc_languages)>1)
                            <div class="language-selector header-top__nav--item">
                                <div class="dropdown header-top__dropdown">
                                    <a class="dropdown-toggle" id="languageID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>{{trans('front.language')}} : </span>
                                        <img src="{{ asset($sc_languages[app()->getLocale()]['icon']) }}" alt="">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="languageID">
                                        @foreach ($sc_languages as $key => $language)
                                            <a class="dropdown-item" href="{{ sc_route('locale', ['code' => $key]) }}"><img src="{{ asset($language['icon']) }}" alt="{{ $language['name'] }}"> {{ $language['name'] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Header Top Nav End -->
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-1--middle brand-bg-2 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 tex-xl-left text-center">
                    <!-- Logo Start -->
                    <a href="{{asset('')}}" class="logo-box">
                        <img src="{{ asset(sc_store('logo')) }}" width="188px" alt="logo">
                    </a>
                    <!-- Logo End -->
                </div>
                <div class="col-xl-6 col-lg-7 d-none d-lg-block">
                    <nav class="main-navigation" style="display: block;">
                        <!-- Mainmenu Start -->
                        <ul class="mainmenu">
                            <li class="mainmenu__item active ">
                                <a href="{{asset('')}}" class="mainmenu__link">{{trans('front.home')}}</a>
                            </li>
                            <li class="mainmenu__item menu-item-has-children">
                                <a href="{{route('product.all')}}" class="mainmenu__link">{{trans('front.shop')}}</a>
                                @if ($categoriesTop->count())
                                    <ul class="sub-menu">
                                        @foreach ($categoriesTop as $key => $category)
                                          <li><a href="{{ $category->getUrl() }}">{{ $category->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                            @if (!empty(sc_config('Content')))
                                @php
                                    $nameSpace = sc_get_plugin_namespace('Cms','Content').'\Models\CmsCategory';
                                    $cmsCategories = (new $nameSpace)->getCategoryRoot()->getData();

                                @endphp
                                <li class="mainmenu__item">
                                    <a class="rd-nav-link" href="{{ $cmsCategories[0]->getUrl() }}">{{ trans('front.blog') }}</a>
                                </li>
                            @endif
{{--                            <li class="mainmenu__item">--}}
{{--                                <a href="{{route('news')}}" class="mainmenu__link">{{trans('front.blog')}}</a>--}}
{{--                            </li>--}}
                            @if (!empty($sc_layoutsUrl['menu']))
                                @foreach ($sc_layoutsUrl['menu'] as $url)
                                    <li class="mainmenu__item">
                                        <a class="rd-nav-link" {{ ($url->target =='_blank')?'target=_blank':''  }}
                                        href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                        <!-- Mainmenu End -->
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-5">
                    <!-- Search Form Start -->
                    <form action="{{ sc_route('search') }}" class="search-form search-form--1" method="GET">
                        <div class="search-form__group search-form__group--select">
                            <select name="category" id="searchCategory" class="search-form__select">
                                <option value="all">Tất cả thể loại</option>
                                <optgroup label="Books, Magazines">
                                    <option>Bedroom</option>
                                    <option>Kitchen</option>
                                    <option>Livingroom</option>
                                </optgroup>
                                <optgroup label="Electronics">
                                    <option>Fridge</option>
                                    <option>Laptops, Desktops</option>
                                    <option>Mobiles, Tablets</option>
                                </optgroup>
                                <optgroup label="Furniture">
                                    <option>Accessories</option>
                                    <option>Men</option>
                                    <option>Women</option>
                                </optgroup>
                                <option value="3">Home, Garden</option>
                                <option value="3">Kids, Baby</option>
                                <option value="3">Sport</option>
                            </select>
                        </div>
                        <input type="text" name="keyword" class="search-form__input" placeholder="{{ trans('front.search_form.keyword') }}">
                        <button type="submit" class="search-form__submit hover-scheme-4">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <!-- Search Form End -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex d-lg-none">
                    <!-- Main Mobile Menu Start -->
                    <div class="mobile-menu"></div>
                    <!-- Main Mobile Menu End -->
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-1--bottom">
        <div class="container">
            <div class="row custom-row align-items-end">
                <div class="col-lg-3">
                    <!-- Category Nav Start -->
{{--                    {{dd(URL::current())}}--}}
                    <div class="category-nav">
                        <h2 class="category-nav__title tertiary-bg" id="js-cat-nav-title"><i class="fa fa-bars"></i> <span>Categories</span></h2>

                        @if ($categoriesTop->count())
                            <ul class="category-nav__menu
                                @if(URL::current()!="http://localhost/sachmoi/public")
                                hide-in-default"
                                @endif
                                id="js-cat-nav">
                                @foreach ($categoriesTop as $category)
                                    @if(!empty($categories[$category->id]))
                                        <li class="category-nav__menu__item has-children">
                                            <a href="{{ $category->getUrl() }}">  {{ $category->title }}</a>
                                            <div class="category-nav__submenu">
                                                <div class="category-nav__submenu--inner">
                                                    <ul>
                                                        @foreach ($categories[$category->id] as $cateChild)
                                                                <li><a href="{{ $cateChild->getUrl() }}">{{ $cateChild->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                    <li class="category-nav__menu__item">
                                        <a href="{{ $category->getUrl() }}">{{ $category->title }}</a>
                                    </li>
                                    @endif
                                @endforeach
                                    <li class="category-nav__menu__item has-children">
                                        <a href="shop.html">Electronics</a>
                                        <div class="category-nav__submenu mega-menu three-column">
                                            <div class="category-nav__submenu--inner">
                                                <h3 class="category-nav__submenu__title">Television</h3>
                                                <ul>
                                                    <li><a href="shop.html">LED TV</a></li>
                                                    <li><a href="shop.html">LCD TV</a></li>
                                                    <li><a href="shop.html">Curved TV</a></li>
                                                    <li><a href="shop.html">Plasma TV</a></li>
                                                </ul>
                                            </div>
                                            <div class="category-nav__submenu--inner">
                                                <h3 class="category-nav__submenu__title">Refrigerator</h3>
                                                <ul>
                                                    <li><a href="shop.html">LG</a></li>
                                                    <li><a href="shop.html">Samsung</a></li>
                                                    <li><a href="shop.html">Toshiba</a></li>
                                                    <li><a href="shop.html">Panasonic</a></li>
                                                </ul>
                                            </div>
                                            <div class="category-nav__submenu--inner">
                                                <h3 class="category-nav__submenu__title">Air Conditioners</h3>
                                                <ul>
                                                    <li><a href="shop.html">Samsung</a></li>
                                                    <li><a href="shop.html">Panasonic</a></li>
                                                    <li><a href="shop.html">Sanaky</a></li>
                                                    <li><a href="shop.html">Toshiba</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                            </ul>
                        @endif
                    </div>
                    <!-- Category Nav End -->
                </div>
                <div class="col-lg-8 col-md-10">
                    <div class="corporate corporate--1">
                        <div class="corporate__single">
                            <div class="corporate__icon">
                                <i class="fa fa-refresh"></i>
                            </div>
                            <div class="corporate__content">
                                <h3 class="corporate__title">Free Return</h3>
                                <p class="corporate__text">30 days money back guarantee!</p>
                            </div>
                        </div>
                        <div class="corporate__single">
                            <div class="corporate__icon">
                                <i class="fa fa-paper-plane-o"></i>
                            </div>
                            <div class="corporate__content">
                                <h3 class="corporate__title">FREE SHIPPING</h3>
                                <p class="corporate__text">Free shipping on all order</p>
                            </div>
                        </div>
                        <div class="corporate__single">
                            <div class="corporate__icon">
                                <i class="fa fa-support"></i>
                            </div>
                            <div class="corporate__content">
                                <h3 class="corporate__title">SUPPORT 24/7</h3>
                                <p class="corporate__text">We support online 24hrs</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-2 align-self-start">
                    <!-- Header Cart Start -->
                    <div class="mini-cart mini-cart--1">
{{--                        <div class="mini-cart__dropdown-toggle" id="cartDropdown">--}}
                        <div class="mini-cart__dropdown-toggle" id="cartDropdown">
                            <a href="{{sc_route('cart')}}"><i class="fa fa-shopping-bag mini-cart__icon"></i></a>
                            <sub class="sc-cart" id="shopping-cart" >{{ Cart::instance('default')->count() }}</sub>
                        </div>
                    </div>
                    <!-- Header Cart End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Header Start -->
    <div class="fixed-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Sticky Logo Start -->
                    <a class="sticky-logo" href="{{asset('')}}">
                        <img src="{{asset('')}}" alt="logo">
                    </a>
                    <!-- Sticky Logo End -->
                </div>
                <div class="col-lg-9">
                    <!-- Sticky Mainmenu Start -->
                    <nav class="sticky-navigation">
                        <ul class="mainmenu sticky-menu">
                            <li class="mainmenu__item active ">
                                <a href="{{asset('')}}">{{trans('front.home')}}</a>

                            </li>
                            <li class="mainmenu__item menu-item-has-children sticky-has-child sticky-has-child">
                                <a href="{{route('product.all')}}" class="mainmenu__link">{{trans('front.shop')}}</a>
                                <ul class="sub-menu hidden-sub">
                                    @foreach ($categoriesTop as $key => $category)
                                      <li ><a href="{{ $category->getUrl() }}">{{ $category->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @if (!empty(sc_config('Content')))
                                @php
                                    $nameSpace = sc_get_plugin_namespace('Cms','Content').'\Models\CmsCategory';
                                    $cmsCategories = (new $nameSpace)->getCategoryRoot()->getData();

                                @endphp
                                <li class="mainmenu__item">
                                    <a class="rd-nav-link" href="{{ $cmsCategories[0]->getUrl() }}">{{ trans('front.blog') }}</a>
                                </li>
                            @endif

                            @if (!empty($sc_layoutsUrl['menu']))
                                @foreach ($sc_layoutsUrl['menu'] as $url)
                                    <li class="mainmenu__item">
                                        <a class="rd-nav-link" {{ ($url->target =='_blank')?'target=_blank':''  }}
                                        href="{{ sc_url_render($url->url) }}">{{ sc_language_render($url->name) }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="sticky-mobile-menu">
                            <span class="sticky-menu-btn"></span>
                        </div>
                    </nav>
                    <!-- Sticky Mainmenu End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Header End -->

</header>