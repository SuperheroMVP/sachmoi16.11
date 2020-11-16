      <!-- Page Footer-->
<footer class="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row pt--40 pb--40">
        <div class="col-md-4 mb-sm--30">
          <div class="method-box">
            <div class="method-box__icon">
              <i class="fa fa-phone"></i>
            </div>
            <div class="method-box__content">
              <h4>{{sc_store('phone')}}</h4>
              <p>Đường dây hỗ trợ miễn phí!!</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-sm--30">
          <div class="method-box">
            <div class="method-box__icon">
              <i class="fa fa-envelope-o"></i>
            </div>
            <div class="method-box__content">
              <h4>{{sc_store('email')}}</h4>
              <p>Hỗ trợ đơn hàng!</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="method-box">
            <div class="method-box__icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <div class="method-box__content">
              <h4>{{sc_store('time_active')}}</h4>
              <p>Ngày / Giờ làm việc!</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row pt--40 pb--40">
        <div class="col-md-6 text-md-left text-center mb-sm--30">
          <!-- Copyright Text Start -->
          <p class="copyright-text">Copyright ©  {{ date('Y') }}<a href="https://kennatech.vn">KennaTech</a> All rights reserved.</p>
          <!-- Copyright Text End -->
        </div>
        <div class="col-md-6 text-md-right text-center">
            <ul class="contact-info contact-info--1">
                <li class="contact-info__list"><i class="fa fa-envelope-open"></i><a href="{{sc_store('email')}}">{{sc_store('email')}}</a></li>
                <li class="contact-info__list"><i class="fa fa-phone"></i><a href="{{sc_store('phone')}}">{{sc_store('phone')}}</a></li>
            </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="subscription-area tertiary-bg">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 mb-sm--30">
          <div class="subscription-text">
            <div class="subscription-text__icon">
              <i class="fa fa-envelope-open color--white"></i>
            </div>
            <div class="subscription-text__right">
              <h3 class="color--white">Newsletter</h3>
              <p class="color--white">Sign up for our newsletter to get up-to-date from us</p>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <form class="newsletter-form validate" action="{{ sc_route('subscribe') }}" method="post" >
            @csrf
            <input type="email" class="newsletter-form__input" name="email" id="email" placeholder="{{ trans('front.subscribe.subscribe_email') }}.." required>
            <input type="submit" value="{{ trans('front.subscribe.title') }}" class="newsletter-form__submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</footer>
<a class="scroll-to-top" href="" style=""><i class="fa fa-angle-up"></i></a>