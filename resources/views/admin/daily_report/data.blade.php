@foreach ($updates as $item)
    <div class="card card-custom mb-2">
        <div class="card-body">
            <div style="font-size:12px; font-weight:700;">{{ $item->name }} -
                <span style="font-weight: 500;">
                    {{ \Carbon\Carbon::parse($item->check_out)->format('d M Y') }} at
                    {{ \Carbon\Carbon::parse($item->check_out)->format('h:i') }}
                </span>

            </div>
            <div style="font-size:12px;">
                {!! $item->daily_update !!}
            </div>
        </div>
    </div>
@endforeach
