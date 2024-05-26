@if ($isHeader)
    <th scope="col" class="fw-medium">{{ $slot }}</th>
@else
    <td>{{ $slot }}</td>
@endif
