<html>
    <!-- Headings -->
    <tr>
    <td>Date</td>
    <td>Item Name</td>
    <td>Item Code</td>
    <td>Quantity</td>
    <td>Cost</td>
    <td>Price</td>
    <td>Total Cost</td>
    <td>Total</td>
    </tr>
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
</html>