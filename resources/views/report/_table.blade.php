<table class="table table-bordered table-striped">
    <thead>
    <!-- Headings -->
    <th>Date</th>
    <th>Total Sale Count</th>
    <th>Total Item Count</th>
    <th>Total Drinks Count</th>
    <th>Total Main Course Count</th>
    <th>Total Sale Amount</th>
    <th>Total Profit</th>
    <th>Total Payment Received</th>
    </thead>
    <tbody>
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
    </tbody>
</table>
<table class="table table-bordered">
    <tbody>
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
    </tbody>
</table>