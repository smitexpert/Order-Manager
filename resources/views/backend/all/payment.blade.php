<tr>
    <th>Method</th>
    <th>Amount</th>
    <th>Remind Code</th>
</tr>
@foreach ($payments as $item)
    <tr>
        <td>{{ $item->payment_method }}</td>
        <td>{{ $item->amount }}</td>
        <td>{{ $item->remind_code }}</td>
    </tr>
@endforeach