@php
$features = [
    [
        'icon' => 'icon-return',
        'title' => '14-Day Returns',
        'desc' => 'Risk-free shopping with easy returns.'
    ],
    [
        'icon' => 'icon-shipping',
        'title' => 'Free Shipping',
        'desc' => 'Fast delivery at your doorstep.'
    ],
    [
        'icon' => 'icon-headset',
        'title' => '24/7 Support',
        'desc' => 'Always here just for you.'
    ],
    [
        'icon' => 'icon-sealCheck',
        'title' => 'Member Discounts',
        'desc' => 'Exclusive deals for loyal customers.'
    ],
];
@endphp

<section class="flat-spacing-9 bg_F5F0EC">
    <div class="container">
        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="tf-icon-box style-3 text-center p-4 h-100">
                        <div class="icon-box mb-3">
                            <span class="icon {{ $feature['icon'] }}" style="font-size: 40px;"></span>
                        </div>
                        <div class="content">
                            <h5>{{ $feature['title'] }}</h5>
                            <p class="text-secondary mb-0">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
