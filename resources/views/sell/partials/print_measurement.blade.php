<div class="print-measurement">

    <div class="brand-header">
        <div class="copy-label">Shop Copy</div>
    </div>

    <div class="info-row">
        <div class="info-inline">
            <span class="info-label">Customer:</span>
            <span>{{ $transaction->contact->name ?? 'Walk-in-Customer' }}</span>
        </div>
        <div class="info-inline">
            <span class="info-label">Order Date :</span>
            <span>{{ @format_date($transaction->transaction_date) }}</span>
        </div>
    </div>

    <div class="info-row">
        <div class="info-inline">
            <span class="info-label">Mobile:</span>
            <span>{{ $transaction->contact->mobile ?? '-' }}</span>
        </div>
        <div class="info-inline">
            <span class="info-label">Delivery Date :</span>
            <span>{{ @format_date($transaction->delivery_date) }}</span>
        </div>
    </div>

    <div class="section-title">{{ $sell->cloth_name }} Measurement</div>

    @php
        $measurements = $sell->cloth_customization->measurements ?? [];
    @endphp

    <div class="grid">
        @forelse ($measurements as $m)
            @if (!empty($m['measurement_name']) || isset($m['value']))
                <div class="cell">
                    <h5>{{ $m['measurement_name'] ?? '-' }}</h5>
                    <p>{{ $m['value'] ?? '-' }}</p>
                </div>
            @endif
        @empty
            <div class="cell" style="grid-column: span 6;">
                <p style="font-size: 12px;">No measurements available</p>
            </div>
        @endforelse
    </div>

    @if (!empty($sell->cloth_customization->note))
        <div class="note-box">
            <strong>Some important notes.</strong> {{ $sell->cloth_customization->note }}
        </div>
    @endif

    <div class="section-title">{{ $sell->cloth_name }} Style</div>

    @php
        $styles = $sell->cloth_customization->styles ?? [];
    @endphp
    <div class="style-tags">
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
                <span class="style-tag">{{ $displayLabel }}</span>
            @endif
        @empty
            <span class="style-tag">No style selected</span>
        @endforelse
    </div>

    <div class="bottom-copy">
        <div class="copy-label">Tailormaster Copy</div>
        <div class="bottom-row">
            <div class="bottom-box">
                <strong>{{ $sell->cloth_name }}</strong>
                <div class="bottom-val">{{ intval($sell->quantity_ordered) }}P</div>
            </div>
            <div class="bottom-box">
                <strong>Order No.</strong>
                <div class="bottom-val">{{ $transaction->invoice_no }}</div>
            </div>
            <div class="bottom-box">
                <strong>Order Date :</strong>
                <div>{{ @format_date($transaction->transaction_date) }}</div>
                <strong style="margin-top: 5px; display:block;">Delivery Date :</strong>
                <div>{{ @format_date($transaction->delivery_date) }}</div>
            </div>
        </div>
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

    .print-measurement .brand-header {
        text-align: center;
        padding-bottom: 8px;
        border-bottom: 1.5px solid #333;
        margin-bottom: 10px;
    }

    .print-measurement .copy-label {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Inline info rows: Customer ... Order Date side by side */
    .print-measurement .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 4px;
    }

    .print-measurement .info-inline {
        font-size: 11.5px;
        display: flex;
        align-items: baseline;
        gap: 4px;
    }

    .print-measurement .info-inline .info-label {
        font-weight: 900;
        color: #333;
    }

    .print-measurement .info-inline strong {
        font-size: 12px;
        font-weight: 700;
    }

    .print-measurement .section-title {
        margin: 10px 0 6px;
        font-size: 13px;
        font-weight: 700;
    }

    /* 6-column grid */
    .print-measurement .grid {
        margin-top: 10px;
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 9px;
    }

    .print-measurement .grid .cell {
        border: none;
        padding: 6px 4px;
        min-height: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
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

    .print-measurement .note-box {
        background-color: #f1f1f1;
        padding: 7px 10px;
        font-size: 11.5px;
        margin: 23px 0 23px;
        line-height: 1.4;
    }

    .print-measurement .style-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin: 4px 0 12px;
    }

    .print-measurement .style-tag {
        font-size: 11px;
        padding: 2px 6px;
        margin-right: 4px;
        margin-bottom: 4px;
        white-space: nowrap;
    }

    /* Dashed separator before tailor copy */
    .print-measurement .bottom-copy {
        margin-top: 20px;
        padding-top: 20px;
        margin-bottom: 10px;
        padding-bottom: 20px;
        border-top: 1.5px dashed #666;
        border-bottom: 1.5px solid #333;
    }

    .print-measurement .bottom-copy .copy-label {
        text-align: center;
        margin-bottom: 8px;
    }

    .print-measurement .bottom-row {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 6px;
    }

    .print-measurement .bottom-box {
        border: 0.3px solid #888;
        text-align: center;
        font-size: 11px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 75px;
        padding: 8px 4px;
        box-sizing: border-box;
    }

    .print-measurement .bottom-box strong {
        display: block;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 1px;
    }

    .print-measurement .bottom-box .bottom-val {
        font-size: 16px;
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
