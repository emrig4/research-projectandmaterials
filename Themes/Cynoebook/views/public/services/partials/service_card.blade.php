<div class="pricing-table mb-20">
    <div class="pricing-option" style="width: 100%; border: 5px solid whitesmoke; padding: 15%; height: 400px">
        <i class="{{ $service->icon_class }}"></i>
        <h1>{{ $service->title }}</h1>
        <hr />
        <p>{{ $service->short_description }}</p>
        <hr />
        <div class="price">
            <div class="front">
                <span class="price">{{ $service->currencyCode() }}{{ $service->price }} </span>
                <a href="{{ route('services.show', ['slug' => $service->slug]) }}" class="button" >
                    <span style="padding: 10px; border-radius: 10px; position: relative; top: 30px; max-width: 100px; border: thin solid whitesmoke">Learn More</span>
                </a>
            </div>
            <div class="back">
                <a href="{{ route('services.show', ['slug' => $service->slug]) }}" class="button">Learn More</a>
            </div>
        </div>
    </div>
</div>
