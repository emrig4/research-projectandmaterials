<!-- CHOOSE Services-->
<div class="section section-padding choose-course-2">
    <div class="container">
        <div class="group-title-index">
            <h4 class="top-title">WHAT WE DO</h4>

            <h2 class="center-title">OUR TOP SERVICES</h2>

            <div class="bottom-title"><i class="bottom-icon icon-a-1-01-01"></i></div>
        </div>
        <div class="choose-course-wrapper row">
            @foreach($featuredServices as $service)
            <div class="col-md-4 col-xs-6" onclick="window.location='{{ route('services.show', ['slug' => $service->slug]) }}' ">
                <div class="item-course">
                    <div class="icon-course"><i class="icons-img  {{ $service->icon_class }}"></i></div>
                    <div class="info-course">
                        <div class="name-course">{{ $service->title }}</div>
                        <div class="info" style="padding: 0 5px">
                            {{ mb_strimwidth($service->short_description, 0, 100, "...") }}
                        </div>
                    </div>
                    <div class="hover-text">
                        <div class="wrapper-hover-text">
                            <div class="wrapper-hover-content"><a href="#" class="title">{{ $service->title }}</a>
                                <div class="content">
                                    {{ mb_strimwidth($service->description, 0, 250, "...") }}
                                </div>
                                <a  href="{{ route('services.show', ['slug' => $service->slug]) }}" class="btn btn-green"><span> Learn More</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>