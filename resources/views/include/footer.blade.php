  <!-- End Footer Area -->
  <footer class="footer-area pt-5">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-3 col-md-6">
                  <div class="single-footer-widget">
                      <div class="widget-logo">
                          @if (getSetting('site_footer_logo'))
                              <img src="{{ asset('uploads/'.getSetting('site_footer_logo')) }}"
                                  alt="{{ getSetting('site_title') }}">
                          @endif

                      </div>
                      <p>{!! getSetting('site_description') !!}  </p>

                  </div>
              </div>

              <div class="col-lg-3 col-sm-6">
                  <div class="single-footer-widget ps-5">
                      <h3>Useful Link</h3>
                      <ul class="quick-links">
                          <li><a href="{{route('website.about')}}">About</a></li>
                          <li><a href="{{route('website.contact')}}">Contact</a></li>
                          <li><a href="{{route('blog')}}">Blog</a></li>
                          <li><a href="{{route('exam')}}">Exam</a></li>
                          <li><a href="{{route('ebook')}}">E Books</a></li>
                          <li><a href="{{route('notes')}}">Free Note</a></li>
                      </ul>
                      {{ menu('footer-link', 'menu.quick-links') }}

                  </div>
              </div>

              <div class="col-lg-3 col-sm-6">
                  <div class="single-footer-widget ps-5">
                      <h3>Our Services</h3>
                      {{ menu('footer-services', 'menu.quick-links') }}
                  </div>
              </div>

              <div class="col-lg-3 col-sm-6">
                  <div class="single-footer-widget ps-3">
                      <h3>Contact Information</h3>

                      <ul class="footer-information">
                          @if (getSetting('site_address'))
                              <li>
                                  <i class="ri-map-pin-line text-light"></i>
                                  {!! getSetting('site_address')  !!}
                              </li>
                          @endif
                          @if (getSetting('site_phone'))
                              <li>
                                  <i class="ri-phone-fill text-light"></i>
                                  <a href="tel:{{ getSetting('site_phone') }}">{{ getSetting('site_phone') }}</a>
                              </li>
                          @endif
                          @if (getSetting('site_email'))
                              <li>
                                  <i class="ri-mail-fill text-light"></i>
                                  <a href="mailto:{{ getSetting('site_email') }}">{{ getSetting('site_email') }}</a>
                              </li>
                          @endif

                      </ul>
                      <ul class="widget-social">
                          @if (getSetting('site_facebook'))
                              <li>
                                  <a href="{{ getSetting('site_facebook') }}" target="_blank">
                                      <i class="ri-facebook-fill"></i>
                                  </a>
                              </li>
                          @endif
                          @if (getSetting('site_twitter'))
                              <li>
                                  <a href="{{ getSetting('site_twitter') }}" target="_blank">
                                      <i class="ri-twitter-fill"></i>
                                  </a>
                              </li>
                          @endif
                          @if (getSetting('site_instagram'))
                              <li>
                                  <a href="{{ getSetting('site_instagram') }}" target="_blank">
                                      <i class="ri-instagram-line"></i>
                                  </a>
                              </li>
                          @endif
                          @if (getSetting('site_linkedin'))
                              <li>
                                  <a href="{{ getSetting('site_linkedin') }}" target="_blank">
                                      <i class="ri-linkedin-line"></i>
                                  </a>
                              </li>
                          @endif
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="copyright-area">
          <div class="container">
              <div class="copyright-area-content">
                  <p>
                      {!! getSetting('site_copyright') !!} Developed by <a href="https://soft-itbd.com">SOFT-ITBD Smart IT Solution</a>
                  </p>
              </div>
          </div>
      </div>
  </footer>
  <!-- End Footer Area -->
