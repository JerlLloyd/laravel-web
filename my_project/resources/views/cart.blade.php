@extends('shop')

@section( 'content')
<table class="table-fixed border-collapse border-2 border-gray-500" id="cart" >
    <thead>
        <tr>
            <th class="border border-gray-400 w-1/2 px-4 py-2 text-gray-800">Product</th>
            <th class="border border-gray-400 w-1/2  px-4 py-2 text-gray-800">Name</th>
            <th class="border border-gray-400 w-1/2  px-4 py-2 text-gray-800">Price</th>
        </tr>
    </thead>
    <tbody>
        @if(session('cart'))
        @foreach(session('cart') as $id => $details)

            <tr rowId="{{ $id }}" class="mb-2">
                <td data-th="Product" class="border px-4 py-2">
                    <div class="row">
                        <div class="col-sm-3 ml-5 hidden-xs"><img src="{{ $details['image'] }}" class="card-img-top"/></div>
                    </td>
                    <td class="border px-4 py-2 text-center text-5xl">
                        <div class="col-sm-9">
                            <h4 class="ml-30">{{ $details['title'] }}</h4>
                        </div>
                    </td>
                    </div>
                </td>
                <td data-th="Price" class="text-center">₱{{ $details['price'] }} </td>
                <td class="actions">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full delete-product ml-10">Delete<i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".delete-product").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success:function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
