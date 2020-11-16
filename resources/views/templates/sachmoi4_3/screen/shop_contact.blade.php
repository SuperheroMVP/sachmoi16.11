@php
/*
$layout_page = shop_contact
*/
@endphp

@extends($sc_templatePath.'.layout')

@section('block_main')

    <!-- Main Wrapper Start -->
    <main id="content" class="main-content-wrapper">
        <!-- Google Map Start -->
        <div class="google-map-wrapper pt--40 pt-sm--30">
            <iframe src="{{sc_store('map')}}" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <!-- Google Map End -->

        <!-- Contact Area Start -->
        <div class="contact-area bg--white pt--80 pb--80 pt-sm--60 pb-sm--60">
            <div class="container-fluid px-5">
                <div class="row">
                    <div class="col-lg-6 mb-md--40">
                        <h2 class="heading-secondary mb--30">{{ trans('front.contact_form.title') }}</h2>
                        <form class="form form--contact" method="post" action="{{ sc_route('contact.post') }}">
                            {{ csrf_field() }}
                            <div class="form-row mb--20">
                                <div class="col-md-6 mb-sm--20">
                                    <input type="text" name="name" id="name" class="form__input"  nam placeholder="{{ trans('front.contact_form.name') }}" value="{{old('name')}}" >                                            @if ($errors->has('name'))
                                        <span class="help-block">
                                            {{ $errors->first('name') }}
                                        </span>
                                    @endif

                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" id="contact_lname" class="form__input" placeholder="{{ trans('front.contact_form.email') }}" value="{{old('email')}}">
                                    <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                </div>
                            </div>
                            <div class="form-row mb--20">
                                <div class="col-md-6 mb-sm--20">
                                    <input type="telephone" name="phone" id="contact_email" class="form__input" placeholder="{{ trans('front.contact_form.phone') }}" value="{{old('phone')}}">
                                    <span class="help-block">
                                            {{ $errors->first('phone') }}
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="title" id="contact_subject" class="form__input" placeholder="{{ trans('front.contact_form.subject') }}" value="{{old('subject')}}">
                                    <span class="help-block">
                                            {{ $errors->first('subject') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-row mb--20">
                                <div class="col-12">
                                    <textarea name="content" id="contact_message" placeholder="{{ trans('front.contact_form.content') }}" class="form__input form__input--2 form__input--textarea">{{ old('content') }}</textarea>
                                    <span class="help-block">
                                            {{ $errors->first('content') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <button type="submit" class="form__submit">{{ trans('front.contact_form.submit') }}</button>
                                </div>
                            </div>
                            <div class="form__output"></div>
                        </form>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <h2 class="heading-secondary mb--30">{{ trans('front.contact_form.info') }}</h2>
                        <div class="address-block mb--30">
                            <p class="mb--30">{{ sc_store('title') }}</p>
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ sc_store('address') }}</li>
                                <li><i class="fa fa-phone"></i> {{ sc_store('email') }}</li>
                                <li><i class="fa fa-envelope-o"></i> {{ sc_store('phone') }}</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Area End -->
    </main>
    <!-- Main Wrapper End -->

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
      {{-- script --}}
@endpush
