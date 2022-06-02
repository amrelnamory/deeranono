<div>

    <span class="cart_qty_cls">

        {{ $cart_count }}

    </span>

    <ul class="show-div shopping-cart">

        @if ($cart_count > 0)

            @foreach ($cart as $item)
                @php
                    $pro = \App\Models\Product::findOrFail($item->id);
                    $image = json_decode($pro->images, true);
                @endphp
                <li>
                    <div class="media">
                        <a href="{{ route('website.singleProduct', $item->id) }}"><img class="me-3"
                                src="{{ $pro->image_path . '/' . $image[0] }}" alt="{{ $item->name }}"></a>
                        <div class="media-body">
                            <a href="{{ route('website.singleProduct', $item->id) }}">
                                <h4>{{ $item->name }}</h4>
                            </a>
                            <h4><span>{{ $item->qty }} | {{ number_format($item->price, 2) }} </span></h4>
                        </div>
                    </div>
                </li>
            @endforeach
            <li>
                <div class="total">
                    <h5><span>{{ \Cart::subTotal() }}
                            @lang('site.currency')</span> @lang('site.subtotal')
                    </h5>
                </div>
            </li>
            <li>
                <div class="buttons">
                    <a href="{{ route('website.viewCart') }}" class="checkout">@lang('site.cart')</a>

                </div>
            </li>
        @else
            <li class="text-center">
                <h6>@lang('site.cart_empty')</h6>
            </li>
        @endif

    </ul>

</div>
