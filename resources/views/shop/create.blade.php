@extends('layouts.app')
<style>
    label {
        min-width: 150px;
        display: inline-block;
        float: left;
    }

    .form-control, .form-select {
        width: 40% !important;
    }

    form {
        text-align: center;
        margin: auto;
        width: 70% !important;
    }

    nav.breadcrumb {
        font-size: 22px;
        margin-left: 223px;
    }
    .save-btn {
        margin-left: 13px;
    }

    label {
        font-family: Consolas;
    }

</style>
@section('content')
    <form action="/shop/goods" method="POST">
        {{ csrf_field() }}
        <label for="name">Name</label>
        <input id="name" class="form-control mb-3" type="text" name="name">

        <label for="img_link">Image Link</label>
        <input id="img_link" class="form-control mb-3" type="text" name="img_link">

        <label for="price">Price</label>
        <input id="price" class="form-control mb-3" type="number" min="1" name="price">
        <label for="producer">Producer</label>
        <select id="producer" class="form-select mb-3" name="producer">
            @foreach ($producers as $producer)
                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
            @endforeach
        </select>

        <label for="creation_date">Creation Date</label>
        <input id="creation_date" class="form-control mb-3" type="date" name="creation_date">

        <label for="expiration_date">Expiration Date</label>
        <input id="expiration_date" class="form-control mb-3" type="date" name="expiration_date">

        <input class="btn btn-success save-btn" type="submit" value="Save">
    </form>
@endsection

