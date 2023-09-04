@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <div class="row">
            <h4 class="text-center my-3">Invoice</h4>
            <p>by {{$user}}</p>
            <p class="text-center">{{$time}}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">QTY</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ $item->product->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <td></td>
                            <td>${{ $total }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-sm btn-success mt-5">Print</button>
    </div>
@endsection
