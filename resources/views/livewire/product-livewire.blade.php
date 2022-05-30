<div>
@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

<div class="filter-container justify-center items-center">
        <div class="row">
      
            <div class="col-md-3">
                <label for="">Category</label>
                <select wire:model="byCategory" class="form-control" >
                    <option value=""></option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                    {{ $category->category_name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div id="collection_card" class="relative flex flex-wrap justify-center items-center min-h-[100vh]">
        @forelse($products as $product)
        <div class="box">
            <h2 class="name font-semibold">{{$product->product->product_name}}</h2>
            @if ($product->discount)
            <h2 class="price font-semibold">Rp.{{ number_format($product->product->price_discount(), 2, ',', '.') }}</h2>
            <del class="price2">Rp.{{ number_format($product->price, 2, ',', '.') }}</del>
            @else
            <h2 class="price font-semibold">Rp.{{ number_format($product->product->price, 2, ',', '.') }}</h2>
            @endif
            <a href="/user/product/{{$product->id}}" class="buy">Buy Now</a> 
            @php
            $image = $producsimage->where('product_id', $product->id)->first();
        @endphp
            <img src="/uploads/product_images/{{ $image->image_name }}" alt="Sepatu" class="shoes">
        </div>
        @empty 
        <div class="col-12 mt-10">
            <div class="alert alert-info">
                <h4 class="alert-heading">Product Not Found</h4>
                <p>
                    <a href="{{ route('user.home') }}" class="alert-link">Back to Home</a>
                </p>
            </div>
        </div>
        @endforelse
    </div>
 <!-- Shop Pagination -->
 {{ $products->links() }}
 <!-- End Shop Pagination -->
</div>
