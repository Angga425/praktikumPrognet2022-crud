<div>
    <div class="d-none d-xl-block">
        <div class="container">
            <div class="row align-items-stretch">
                <!-- Header Icons -->
                <div class="col-md-auto align-self-center">
                    <div class="d-flex">
                        <ul class="d-flex list-unstyled mb-0">
                            <li class="col pr-0">
                                <a href="{{ route('user.cart') }}" class="text-gray-90 position-relative d-flex "
                                    data-toggle="tooltip" data-placement="top" title="Cart">
                                    <i class="font-size-22 ec ec-shopping-bag"></i>
                                    @auth()
                                        <span
                                            class="width-22 height-22 bg-dark position-absolute flex-content-center text-white rounded-circle left-2 top-2 font-weight-bold font-size-12">
                                            {{ $cart_count }}</span>
                                        <span class="font-weight-bold font-size-16 text-gray-90 ml-3">Rp
                                            {{ number_format($price_total, 2, ',', '.') }}</span>
                                    @endauth
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Header Icons -->
            </div>
        </div>
    </div>
</div>
