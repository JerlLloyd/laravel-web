@extends('shop')

@section('content')

<div class="flex mb-4 grid grid-cols-3 gap-4">
    @foreach($products as $product)
    <div class="w-30 rounded overflow-hidden shadow-lg ml-3 ">
        <img class="w-30" src="{{asset($product->image)}}" alt="Products">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $product->title }}</div>
            <p class="text-gray-700 text-base">
                {{ $product->description }}
            </p>
            <div class="font-bold text-xl mb-2">Price : ₱{{ $product->price }}</div>
            <div class="px-6 pt-4 pb-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ml-5 rounded-full">
                  <a href="{{ route('addproducts.to.cart', $product->id) }}">Add to Cart</a>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
