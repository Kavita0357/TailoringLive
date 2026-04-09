<div class="page">

    <!-- Header -->
    <div class="header text-center">
        <h3>Khidmah Tailors and Fabrics</h3>
        <p>Hosaf Shopping Complex</p>
        <p>Contact: 01712454545</p>
    </div>

    <!-- Customer Info -->
    <div class="info">
        <p><strong>Customer:</strong> {{ $transaction->contact->name ?? 'Walk-in-Customer' }}</p>
        <p><strong>Mobile:</strong> {{ $transaction->contact->mobile ?? '-' }}</p>
    </div>

    <!-- Cloth Title -->
    <h4 class="cloth-title">{{ $sell->cloth_name }} Measurement</h4>

    @php
        $measurements = $sell->cloth_customization->measurements ?? [];
    @endphp

    <!-- Measurements -->
    <div class="measurement-grid">
        @foreach ($measurements as $m)
            @if (isset($m['value']))
                <div class="box">
                    <h5>{{ $m['measurement_name'] }}</h5>
                    <p>{{ $m['value'] }}</p>
                </div>
            @endif
        @endforeach
    </div>
    @if (!empty($sell->cloth_customization->note))
        <div class="row">
            <div class="col-md-12">
                <p><strong>{{ $sell->cloth_customization->note }}</strong></p>
            </div>
        </div>
    @endif
    <h4 class="cloth-title">{{ $sell->cloth_name }} Style</h4>
    @php
        $styles = $sell->cloth_customization->styles ?? [];
    @endphp
    <div class="measurement-grid">
        @foreach ($styles as $s)
            @if (isset($s['name']))
                @php
                    $designs = $s['designs'] ?? [];
                    $values = collect($designs)->pluck('design_name')->filter()->toArray();
                @endphp
                <div class="box">
                    <h5>{{ $s['name'] }}</h5>
                    <p>{{ !empty($values) ? implode(', ', $values) : '' }}</p>
                </div>
            @endif
        @endforeach
    </div>
</div>

<style>
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .header {
        text-align: center;
        border-bottom: 1px solid #ccc;
        margin-bottom: 10px;
    }

    .cloth-title {
        margin: 15px 0;
    }

    .measurement-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .box {
        width: 20%;
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    @media print {
        .page {
            page-break-after: always;
        }
    }
</style>
