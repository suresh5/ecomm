@php
$highlights = [
    [
        'icon' => 'icon-sealCheck',
        'title' => '5+ Years',
        'desc' => 'Of trusted service & excellence'
    ],
    [
        'icon' => 'icon-shipping',
        'title' => '220+ Models',
        'desc' => 'Wide range of product choices'
    ],
    [
        'icon' => 'icon-headset',
        'title' => '100+ Dealers',
        'desc' => 'Strong dealer network nationwide'
    ],
    [
        'icon' => 'icon-return',
        'title' => 'Customer First',
        'desc' => 'Dedicated support & satisfaction'
    ],
];
@endphp

<section class="flat-spacing line-top-container">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-{{ count($highlights) }} g-4">
            @foreach($highlights as $highlight)
                <div class="col">
                    <div class="tf-icon-box style-3 text-center p-3 h-100">
                        <div class="icon-box mb-2">
                            <span class="icon {{ $highlight['icon'] }}"></span>
                        </div>
                        <div class="content">
                            <h5>{{ $highlight['title'] }}</h5>
                            <p class="text-secondary">{{ $highlight['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
