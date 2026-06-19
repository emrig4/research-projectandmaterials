<!-- TESTIMONIALS SECTIONS-->
<div class="section section-padding background-opacity best-staff" style="background: url('{{v(Theme::url('public/images/testimonial_bg.jpg'))}}')">
    <div class="container">
        <div class="group-title-index">
            <h4 class="top-title">What people say about us</h4>

            <h2 class="center-title">TESTIMONIALS</h2>

            <div class="bottom-title"><i class="bottom-icon icon-icon-05"></i></div>
        </div>
        <div class="best-staff-wrapper">
            <div class="best-staff-content">
                <!-- item -->
                @foreach($testimonials as $testimonial)
                    <div class="staff-item">
                        <div class="staff-item-wrapper">
                            <div class="staff-info">
                                <a href="#" class="staff-avatar">
                                    <img  style="width: 50px; height: 50px" src="{{ $testimonial->avatar() }}" alt="" class="img-responsive"/>
                                </a>
                                <a href="#" class="staff-name">{{ $testimonial->name }}</a>

                                <div class="staff-job">
                                    <div style="margin-bottom: 5px">
                                        <b>{{ $testimonial->company }}</b>
                                        <p>{{ $testimonial->location }}</p>
                                    </div>
                                    <p>{{ $testimonial->comment }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="staff-socials">
                            <!-- <a href="#" class="facebook" style="padding:0 30px">Read</a> -->
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="group-btn-slider">
        <div class="btn-prev"><i class="fa fa-angle-left"></i></div>
        <div class="btn-next"><i class="fa fa-angle-right"></i></div>
    </div>
</div>