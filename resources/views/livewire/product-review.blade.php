<div>
    @if ($transaction->isNotEmpty())
        <div>
            <div class="text-center">
                <h1>Product Review</h1>
                <p>Please review your product</p>
            </div>

            @foreach ($transaction as $product)
                <div class="card d-flex m-5">
                    <div class="card-body d-flex flex-row">
                        <div class="col-2">
                            <img src="/uploads/product_images/{{ $product->product_images[0]->image_name }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-10">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            {{-- Product rating --}}
                            <div class="mb-2">
                                <span class="font-weight-bold">{{ $product->rate }}</span>
                                <span class="d-inline-flex align-items-center small font-size-15 text-lh-1">
                                    <div class="text-warning mr-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($product->rate, 1))
                                                <small class="fas fa-star"></small>
                                            @elseif($i - round($product->rate, 1) < 1)
                                                <small class="fas fa-star-half"></small>
                                            @else
                                                <small class="far fa-star text-muted"></small>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-secondary font-size-13">({{ $product->product_reviews->count() }}
                                        customer reviews)</span>
                                </span>
                            </div>
                            <p class="card-text font-weight-bold">Rp.
                                {{ number_format($product->price, 2, ',', '.') }}</p>
                            <a href="{{ route('user.product.show', $product->id) }}" class="btn btn-primary">Review
                                Product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
