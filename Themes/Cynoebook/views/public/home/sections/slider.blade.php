<!-- SLIDER BANNER-->
<div class="section slider-banner set-height-top"
    data-autoplay="{{ $slider->autoplay }}"
    data-autoplay-speed="{{ $slider->autoplay_speed }}"
    data-arrows="{{ $slider->arrows }}"
>
    @foreach ($slider->slides as $slide)
        <div class="slider-item">
            <div class="slider-1" style="background-image: url({{ $slide->files->path }});">
                <div class="slider-caption">
                    <div class="container">
                        @unless (is_null($slide->caption_2))
                            <h5 class="text-info-2">{{ $slide->caption_2 }}</h5>
                        @endunless

                         @unless (is_null($slide->caption_1))
                            <h1 class="text-info-1">{{ $slide->caption_1 }}</h1>
                        @endunless

                         @unless (is_null($slide->caption_3))
                            <p class="text-info-3">{{ $slide->caption_3 }}</p>
                        @endunless

                        @unless (is_null($slide->call_to_action_text))
                            <a href="{{ $slide->call_to_action_url }}" class="btn btn-green"><span>{{ $slide->call_to_action_text }}</span></a>
                        @endunless
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

