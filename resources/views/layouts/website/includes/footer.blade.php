  <!-- footer -->
  <footer class="footer-light">
      <section class="section-b-space light-layout">
          <div class="container">
              <div class="row footer-theme partition-f">
                  <div class="col-lg-4 col-md-6">
                      <div class="footer-title footer-mobile-title">
                          <h4>about</h4>
                      </div>
                      <div class="footer-contant">
                          <div class="footer-logo"><img src="{{ config('global.settings')->logo_path }}" alt=""
                                  width="150"></div>
                          @if (app()->getLocale() == 'ar')
                              <p>
                                  {{ config('global.settings')->about_ar }}
                              </p>
                          @else
                              <p>
                                  {{ config('global.settings')->about_en }}
                              </p>
                          @endif


                          <div class="footer-social">
                              <ul>
                                  <li><a href="{{ config('global.settings')->facebook }}"><i class="fa fa-facebook"
                                              aria-hidden="true"></i></a></li>
                                  <li><a href="{{ config('global.settings')->instagram }}"><i class="fa fa-instagram"
                                              aria-hidden="true"></i></a></li>
                                  <li><a href="{{ config('global.settings')->pinterest }}"><i class="fa fa-pinterest"
                                              aria-hidden="true"></i></a></li>
                                  <li><a href="{{ config('global.settings')->youtube }}"><i class="fa fa-youtube-play"
                                              aria-hidden="true"></i></a></li>
                              </ul>
                          </div>
                      </div>
                  </div>

                  <div class="col offset-xl-1">
                      <div class="sub-title">
                          <div class="footer-title">
                              <h4>@lang('site.quick_links')</h4>
                          </div>
                          <div class="footer-contant">
                              <ul>
                                  @foreach (config('global.categories') as $category)
                                      <li> <a href="#">{{ $category->name }}</a>
                                      </li>
                                  @endforeach

                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="sub-title">
                          <div class="footer-title">
                              <h4>@lang('site.contact_info')</h4>
                          </div>
                          <div class="footer-contant">
                              <ul class="contact-list">

                                  @if (app()->getLocale() == 'ar')
                                      <li><i class="fa fa-map-marker"></i> {{ config('global.settings')->address_ar }}
                                      </li>
                                  @else
                                      <li><i class="fa fa-map-marker"></i> {{ config('global.settings')->address_en }}
                                      </li>
                                  @endif

                                  <li><i class="fa fa-phone"></i>{{ config('global.settings')->phone }}</li>
                                  <li><i class="fa fa-envelope-o"></i>{{ config('global.settings')->email }}
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <div class="sub-footer">
          <div class="container">
              <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-12">
                      <div class="footer-end">
                          <p><i class="fa fa-copyright" aria-hidden="true"></i> {{ date('Y') }}
                              @lang('site.copyrights')</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer>
  <!-- footer end -->
