<div>
    <div class="row">
        <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
            <div class="pl-lg-3 ">
                <div class="bg-gray-1 rounded-lg">
                    <!-- Order Summary -->
                    <div class="p-4 mb-4 checkout-table">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                        </div>
                        <!-- End Title -->

                        <!-- Product Content -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr class="cart_item">
                                        <td>{{ $cart->product->product_name }}<strong class="product-quantity">×
                                                {{ $cart->qty }}</strong>
                                        </td>
                                        <td>
                                            @if ($cart->product->discount)
                                                <ins class="text-decoration-none">Rp.
                                                    {{ number_format($cart->product->price_discount() * $cart->qty, 2, ',', '.') }}</ins>
                                                <del class="tex-gray-6 " style="bottom: 75%">Rp.
                                                    {{ number_format($cart->product->price * $cart->qty, 2, ',', '.') }}</del>
                                            @else
                                                Rp
                                                {{ number_format($cart->product->price * $cart->qty, 2, ',', '.') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>Rp {{ number_format($subtotal, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>Rp {{ number_format($cost, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><strong>Rp {{ number_format($subtotal + $cost, 2, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- End Product Content -->
                        <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                            <!-- Basics Accordion -->
                            <div id="basicsAccordion1">
                                <!-- Card -->
                                <div class="border-bottom border-color-1 border-dotted-bottom">
                                    <div class="p-3" id="basicsHeadingOne">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="stylishRadio1"
                                                name="stylishRadio" checked>
                                            <label class="custom-control-label form-label" for="stylishRadio1"
                                                data-toggle="collapse" data-target="#basicsCollapseOnee"
                                                aria-expanded="true" aria-controls="basicsCollapseOnee">
                                                Direct bank transfer
                                            </label>
                                        </div>
                                    </div>
                                    <div id="basicsCollapseOnee"
                                        class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                        aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1">
                                        <div class="p-4">
                                            Make your payment directly into our bank account. Please use your Order
                                            ID as the payment reference. Your order will not be shipped until the
                                            funds have cleared in our account.
                                        </div>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <!-- End Basics Accordion -->
                        </div>
                        @if ($cost != null && !$serviceChanged)
                            <button wire:click='checkout' type="button"
                                class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place
                                order</button>
                        @endif
                        @if ($id_courier != null && $id_city != null && $id_province != null && $id_service != null)
                            <button type="button" wire:click='checkCost' wire:target="checkCost"
                                wire:loading.attr="disabled"
                                class="btn btn-secondary btn-block btn-pill font-size-20 mb-3 py-3">
                                Check Shipping Cost
                                <div class="spinner-border d-none" wire:target="checkCost"
                                    wire:loading.class.remove="d-none" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        @endif
                    </div>
                    <!-- End Order Summary -->
                </div>
            </div>
        </div>

        <div class="col-lg-7 order-lg-1">
            <div class="pb-7 mb-7">
                <!-- Title -->
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                </div>
                <!-- End Title -->

                <!-- Billing Form -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Full Name
                                <span class="text-danger">*</span>
                            </label>
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                        <!-- End Input -->
                    </div>


                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Email address
                                <span class="text-danger">*</span>
                            </label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                        <!-- End Input -->
                    </div>

                    <div class="w-100"></div>

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Province
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control right-dropdown-0-all w-100"
                                data-style="bg-white font-weight-normal border border-color-1 text-gray-20"
                                wire:model='id_province'>
                                <option value="" selected disabled>Select a Province</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">
                                        {{ $province->title }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- End Input -->
                    </div>

                    @if ($id_province)
                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    City
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control right-dropdown-0-all w-100"
                                    data-style="bg-white font-weight-normal border border-color-1 text-gray-20"
                                    wire:model='id_city'>
                                    <option value="" selected disabled>Select a City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">
                                            {{ $city->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- End Input -->
                        </div>
                    @endif

                    @if ($id_city)
                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Courier
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control right-dropdown-0-all w-100"
                                    data-style="bg-white font-weight-normal border border-color-1 text-gray-20"
                                    wire:model='id_courier'>
                                    <option value="" selected disabled>Select a Courier</option>
                                    @foreach ($couriers as $courier)
                                        <option value="{{ $courier->id }}">{{ strtoupper($courier->courier) }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- End Input -->
                        </div>
                    @endif

                    @if ($id_courier)
                        <div class="col-md-12">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                                <label class="form-label">
                                    Courier Service
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-control right-dropdown-0-all w-100"
                                    data-style="bg-white font-weight-normal border border-color-1 text-gray-20"
                                    wire:model='id_service'>
                                    <option value="" selected disabled>Select a Courier Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $loop->index }}">
                                            {{ strtoupper($service['service']) . ' (Estimated ' . str_replace('HARI', '', $service['cost'][0]['etd']) . ' days ) ' . ' - ' . number_format($service['cost'][0]['value'], 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <!-- End Input -->
                        </div>
                    @endif

                    <div class="col-md-12">
                        <!-- Input -->
                        <div class="js-form-message mb-6">
                            <label class="form-label">
                                Street address
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                wire:model.lazy='address' placeholder="470 Lucy Forks">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Input -->
                    </div>
                    <div class="w-100"></div>
                </div>
                <!-- End Billing Form -->
            </div>
        </div>
    </div>
</div>
