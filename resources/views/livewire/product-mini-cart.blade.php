<div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
    <div class="mb-2">
        <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
            <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">Availability:
                <span class="text-green font-weight-bold">{{ $product->stock }} in stock</span>
            </div>
            <div class="mb-3">
                @if ($product->discount)
                    <div class="d-flex align-items-baseline flex-column">
                        <ins class="font-size-36 text-decoration-none">Rp.
                            {{ number_format($product->price_discount(), 2, ',', '.') }}</ins>
                        <del class="font-size-20 text-gray-6">Rp.
                            {{ number_format($product->price, 2, ',', '.') }}</del>
                    </div>
                @else
                    <div class="font-size-36">Rp {{ number_format($product->price, 2, ',', '.') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <h6 class="font-size-14">Quantity</h6>
                <!-- Quantity -->
                <div class="border rounded-pill py-1 w-md-60 height-35 px-3 border-color-1">
                    <div class="js-quantity row align-items-center">
                        <div class="col-auto pr-1">
                            <button wire:click='decrementQty'
                                class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                <small class="fas fa-minus btn-icon__inner"></small>
                            </button>
                        </div>
                        <div class="col">
                            <input wire:model='qty'
                                class="js-result form-control h-auto border-0 rounded p-0 shadow-none text-center"
                                type="text" value="1">
                        </div>
                        <div class="col-auto pr-1">
                            <button wire:click='incrementQty'
                                class="btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0">
                                <small class="fas fa-plus btn-icon__inner"></small>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End Quantity -->
            </div>
            <div class="mb-2 pb-0" role="button">
                <button wire:click='addToCart' class="btn btn-block btn-dark" type="button">
                    <i class="ec ec-add-to-cart mr-2 font-size-20"></i>
                    Add to Cart</button>
            </div>
            <div class="mb-3">
                <a href="{{ route('user.product.buynow', [$product, 'qty' => $qty]) }}" class="btn btn-block btn-dark">Buy
                    Now</a>
            </div>
        </div>
    </div>
</div>
