@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h4 class="text-center my-3">Products</h4>
        </div>
        <div class="row justify-content-center">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity on Hand</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->quantity_on_hand}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center ms-5">
        {{$products->links()}}
    </div>
@endsection
