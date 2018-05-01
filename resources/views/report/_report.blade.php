<html>
    <!-- Headings -->
    <tr>
        <td>Date</td>
        <td>Total Sale Count</td>
        <td>Total Item Count</td>
        <td>Total Drinks Count</td>
        <td>Total Main Course Count</td>
        <td>Total Sale Amount</td>
        <td>Total Profit</td>
        <td>Total Payment Received</td>
    </tr>
    @foreach ($data['sales'] as $sale)
    <tr>
        <td class="col-md-2">
            {{ $sale['date']->format('j M Y') }}
        </td>
        <td class="col-md-1">
            {{ $sale['saleCount'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['saleItemCount'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['drinksItemCount'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['mainCourseCount'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['saleAmount'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['saleProfit'] }}
        </td>
        <td class="col-md-1">
            {{ $sale['salePaymentReceived'] }}
        </td>
    </tr>
    @endforeach
    <tr>
    <td class="col-md-2">Sum</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'saleCount')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'saleItemCount')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'drinksItemCount')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'mainCourseCount')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'saleAmount')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'saleProfit')) }}</td>
    <td class="col-md-1">{{ array_sum(array_column($data['sales'],'salePaymentReceived')) }}</td>
    </tr>
</html>