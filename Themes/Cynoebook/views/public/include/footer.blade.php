<!-- FOOTER-->
<footer>
    <div class="footer-main">
        <div class="container">
            <div class="footer-main-wrapper">
                <div class="row">
                    <div class="col-2">
                        <div class="col-md-3 col-sm-6 col-xs-6 sd380">
                            <div class="edugate-widget widget">
                                <div class="title-widget">CONTACT</div>
                                <div class="content-widget">
                                    <div class="info-list">
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-envelope-o"></i><a href="#">{{ setting('contact_email') }}</a></li>
                                            <li><i class="fa fa-phone"></i><a href="#">{{ setting('contact_phone1') }}</a></li>
                                            <li><i class="fa fa-map-marker"></i><a href="#">
                                                    <p>{{ setting('contact_address_line1') }}</p>
                                                    <p>{{ setting('contact_address_line2') }}</p>
                                                    <p>{{ setting('contact_address_line3') }}</p>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 sd380">
                            @include('public.include.widgets.top_tags_widget')
                        </div>
                    </div>
                    <div class="col-2">
                        
                        <div class="col-md-3 col-sm-6 col-xs-6 sd380">
                            <div class="mailing-widget widget">
                                <div class="title-widget">MAILING</div>
                                <div class="content-wiget">
                                    <p>Sign up for our mailing list to get latest updates and offers.</p>

                                    <form action="{{ route('subscribers.store') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input id="email" name="email" type="text" placeholder="Email address" class="form-control form-email-widget" />
                                            <span class="input-group-btn">
                                                <input type="submit" value="✓" class="btn btn-email" />
                                            </span>
                                        </div>
                                    </form>

                                    <p>We respect your privacy</p>

                                    <div class="socials"><a href="https://www.facebook.com/projectandmaterialscom/" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i class="fa fa-google-plus"></i></a><a href="https://twitter.com/projectandmater" class="twitter"><i class="fa fa-twitter"></i></a><a href="https://www.pinterest.com/edwinemri/" class="pinterest"><i class="fa fa-pinterest"></i></a><a href="/blog" class="blog"><i class="fa fa-rss"></i></a><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

            <div class="hyperlink">
                <div class="pull-left hyper-left">
                    @if ($footerMenu2->isNotEmpty())
                        <ul class="list-inline">
                            @foreach ($footerMenu2 as $menuItem)
                                <li><a href="{{ $menuItem->url() }}">{{ $menuItem->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="pull-right hyper-right">{{ $copyrightText }}</div>
            </div>
        </div>
    </div>
</footer>