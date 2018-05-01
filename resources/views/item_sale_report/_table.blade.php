<table class="table table-bordered table-striped">
    <thead>
    <!-- Headings -->
    <th>Date</th>
    <th>Item Name</th>
    <th>Item Code</th>
    <th>Quantity</th>
    <th>Cost</th>
    <th>Price</th>
    <th>Total Cost</th>
    <th>Total</th>
    </thead>
    <tbody>
    @foreach ($data['sales'] as $sale)
        <tr>
            <td class="col-md-2">
                {{ $sale['date']->format('j M Y') }}
            </td>
            <td class="col-md-1">
                {{ $sale['name'] }}
            </td>
            <td class="col-md-1">
                {{ $sale['code'] }}
            </td>
            <td class="col-md-1">
                {{ $sale['quantity'] }}
            </td>
            <td class="col-md-1">
                Rp {{ $sale['cost'] }}
            </td>
            <td class="col-md-1">
                Rp {{ $sale['price'] }}
            </td>
            <td class="col-md-1">
                Rp {{ $sale['totalCost'] }}
            </td>
            <td class="col-md-1">
                Rp {{ $sale['total'] }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>