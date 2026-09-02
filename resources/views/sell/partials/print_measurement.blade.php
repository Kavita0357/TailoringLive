<div class="print-measurement">

    @php
        $measurements = $sell->cloth_customization->measurements ?? [];
        $styles = $sell->cloth_customization->styles ?? [];
    @endphp

    {{-- ===================== CRAFTSMAN COPY ===================== --}}
    <div class="copy-block">
        <div class="copy-title">Craftsman copy</div>
        <div class="header-row">
            <div class="header-box">
                <strong>{{ $sell->cloth_name }}</strong>
                <div class="header-box-inner">{{ intval($sell->quantity_ordered) }} P.</div>
            </div>
            <div class="header-box">
                <strong>Order No.:</strong>
                <div class="header-val">{{ $transaction->invoice_no }}</div>
            </div>
            <div class="header-box header-box-dates">
                <div>Tang: {{ @format_date($transaction->transaction_date) }}</div>
                <div>Daily: {{ @format_date($transaction->delivery_date) }}</div>
            </div>
        </div>
    </div>

    {{-- ===================== SHOP COPY ===================== --}}
    <div class="copy-block">
        <div class="copy-title">Shop copy</div>
        <div class="header-row">
            <div class="header-box">
                <strong>{{ $sell->cloth_name }}</strong>
                <div class="header-box-inner">{{ intval($sell->quantity_ordered) }} P.</div>
            </div>
            <div class="header-box">
                <strong>Order No.:</strong>
                <div class="header-val">{{ $transaction->invoice_no }}</div>
            </div>
            <div class="header-box header-box-dates">
                <div>Tang: {{ @format_date($transaction->transaction_date) }}</div>
                <div>Daily: {{ @format_date($transaction->delivery_date) }}</div>
            </div>
        </div>
    </div>

    {{-- ===================== MEASUREMENT GRID ===================== --}}
    <div class="grid">
        @forelse ($cloth->measurements as $index => $m)
            <div class="group">
                <div class="cell">
                    <h5>{{ $m->measurement_name }}</h5>
                    <p>{{ $cloth_customization['measurements'][$index]['value'] ?? '-' }}</p>
                </div>
                @if ($m->subMeasurements->isNotEmpty())
                    @foreach ($m->subMeasurements as $sub_index => $sub)
                        <div class="cell">
                            <h5>{{ $sub->sub_measurement_name }}</h5>
                            <p>{{ $cloth_customization['measurements'][$index]['sub_measurements'][$sub_index]['value'] ?? '-' }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </div>
        @empty
            <div class="group">
                <div class="cell cell-empty">
                    <p style="font-size: 12px;">No measurements available</p>
                </div>
            </div>
        @endforelse
    </div>

    @if (!empty($sell->cloth_customization->note))
        <div class="note-box">
            <strong>Some important notes.</strong> {{ $sell->cloth_customization->note }}
        </div>
    @endif

    {{-- ===================== STYLE NOTES (italic lines) ===================== --}}
    <div class="notes">
        @forelse ($styles as $s)
            @if (!empty($s['name']))
                @php
                    $designs = $s['designs'] ?? [];
                    $values = [];
                    foreach ($designs as $design) {
                        if (!empty($design['design_value'])) {
                            $values[] = $design['design_value'];
                        } elseif (!empty($design['design_name'])) {
                            $values[] = $design['design_name'];
                        }
                    }
                    $displayLabel = $s['name'];
                    if (!empty($values)) {
                        $displayLabel .= ' (' . implode(', ', $values) . ')';
                    }
                @endphp
                <div class="note-line">{{ $displayLabel }}</div>
            @endif
        @empty
            <div class="note-line">No style selected</div>
        @endforelse
    </div>
</div>

<style>
    .print-measurement {
        width: 4.5in;
        margin: 0 auto;
        font-family: Arial, sans-serif;
        color: #000;
        padding: 10px 12px;
        box-sizing: border-box;
    }

    /* ---------- Copy header blocks ---------- */
    .print-measurement .copy-block {
        margin-bottom: 10px;
    }

    .print-measurement .copy-title {
        text-align: center;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .print-measurement .header-row {
        display: flex;
        border: 1.3px solid #000;
    }

    .print-measurement .header-box {
        flex: 1;
        border-right: 1.3px solid #000;
        padding: 6px 8px;
        text-align: center;
        font-size: 12px;
    }

    .print-measurement .header-box:last-child {
        border-right: none;
    }

    .print-measurement .header-box strong {
        display: block;
        font-size: 12.5px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .print-measurement .header-box-inner {
        border: 1px solid #000;
        padding: 2px 6px;
        display: inline-block;
        font-size: 12px;
    }

    .print-measurement .header-val {
        font-size: 17px;
        font-weight: 800;
    }

    .print-measurement .header-box-dates {
        font-size: 11.5px;
        font-weight: 700;
        line-height: 1.6;
    }

    /* ---------- Measurement grid ---------- */
    /* Multi-column flow: each measurement + its sub-measurements
       stay together and stack in one column (break-inside: avoid),
       matching columns of uneven height like the reference layout. */
    .print-measurement .grid {
        margin-top: 12px;
        column-count: 6;
        column-gap: 4px;
    }

    .print-measurement .group {
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        page-break-inside: avoid;
    }

    .print-measurement .grid .cell {
        border: 1px solid #000;
        margin: -1px 0 0 -1px;
        /* collapse adjoining borders */
        padding: 6px 4px;
        min-height: 55px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .print-measurement .grid .cell.cell-empty {
        min-height: 30px;
    }

    .print-measurement .grid .cell h5 {
        margin: 0 0 3px;
        font-size: 10px;
        font-weight: 700;
        line-height: 1.2;
    }

    .print-measurement .grid .cell p {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        line-height: 1;
    }

    /* ---------- Notes box ---------- */
    .print-measurement .note-box {
        background-color: #f1f1f1;
        padding: 7px 10px;
        font-size: 11.5px;
        margin: 16px 0;
        line-height: 1.4;
    }

    /* ---------- Style notes as italic lines ---------- */
    .print-measurement .notes {
        margin-top: 16px;
    }

    .print-measurement .note-line {
        font-style: italic;
        font-size: 12px;
        line-height: 1.6;
    }

    @media print {
        .print-measurement {
            width: 4.5in;
            margin: 0 auto;
        }

        @page {
            size: 4.5in auto;
            margin: 5mm;
        }
    }
</style>
