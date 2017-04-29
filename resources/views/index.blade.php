<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Products</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- Styles -->
</head>
<body>
<div class="container">
    <h2>Products</h2>
    <table class="table">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                 {{ Form::open(['action' => ['SiteController@delete', $product->id], 'method' => 'DELETE'])}}
                    <button class="btn btn-primary">Buy</button>
                 {{ Form::close() }}
                <td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
