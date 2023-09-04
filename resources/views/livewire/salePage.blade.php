<div>
    @if (session('failed'))
        <div class="alert alert-warning" role="alert">
           {{ session('failed')}}
        </div>
    @endif
    <div class="d-flex">
        <div class="col-md-6" style="border-right: solid 1px darkgrey">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Add</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity_on_hand }}</td>
                            <td>
                                <button wire:click="removeItem({{ $product->id }})"
                                    class="me-2 btn btn-sm btn-danger">-</button>
                                <button wire:click="addItem({{ $product->id }})"
                                    class="btn btn-sm btn-success">+</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4  ms-5 border-left" style="height: 100vh;">
            <h5 class="text-center">Current Sale</h5>

            <div class="mt-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">QTY</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($CurrentProducts as $CurrentProduct)
                            <tr>
                                <th>{{ $CurrentProduct->product->name }}</th>
                                <td>{{ $CurrentProduct->quantity }}</td>
                                <td>${{ $CurrentProduct->product->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <td></td>
                            <td>${{ $total }}
                        </tr>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button wire:click="clear()" class="btn btn-sm btn-warning me-5">Clear</button>
                    <a href="{{ route('make-sale') }}" class="btn btn-sm btn-primary">Procced</a>
                </div>
            </div>
        </div>
    </div>
</div>
