<style>
    .page {
        width: 4.5in;
        margin: 0 auto;
        font-family: Arial, sans-serif;
        color: #000;
        padding: 10px 12px;
        box-sizing: border-box;
        page-break-after: avoid;
    }

    .header {
        text-align: center;
        border-bottom: 1px solid #ccc;
        padding-bottom: 8px;
        margin-bottom: 12px;
    }

    .header h3 {
        margin: 0;
        font-size: 22px;
    }

    .header p {
        margin: 2px 0;
        font-size: 13px;
    }

    .info {
        margin-bottom: 15px;
    }

    .info p {
        margin: 3px 0;
        font-size: 13px;
    }

    .cloth-title {
        margin: 14px 0 10px;
        font-size: 17px;
        font-weight: bold;
    }

    .measurement-grid:not(.customer-measuremnt-body .measurement-grid) {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        width: 100%;
    }

    .style-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin: 4px 0 12px;
    }

    .style-tag {
        font-size: 11px;
        padding: 2px 6px;
        margin-right: 4px;
        margin-bottom: 4px;
        white-space: nowrap;
    }

    .customer-measuremnt .box {
        padding: 0;
        text-align: center;
        min-height: 50px;
        margin-bottom: 0px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        page-break-inside: avoid;
        break-inside: avoid;
        border: none !important;
        box-shadow: none !important;
    }

    .customer-measuremnt .box h5 {
        margin: 0 0 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .customer-measuremnt .box p {
        margin: 0;
        font-size: 13px;
        line-height: 1.4;
        word-break: break-word;
    }

    .note {
        margin-top: 12px;
        font-size: 13px;
    }

    @media print {

        html,
        body {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 4.5in;
            /* min-height: 297mm; */
            padding: 10mm;
            margin: 0 auto;
        }

        .measurement-grid,
        .style-grid {
            gap: 8px;
        }

        .customer-measuremnt .box {
            min-height: 50px;
        }

        @page {
            size: 4.5in auto;
            margin: 5mm;
        }
    }
</style>
<div class="page customer-measuremnt">
    <div class="header text-center">
        <h3>Khidmah Tailors and Fabrics</h3>
        <p>Hosaf Shopping Complex</p>
        <p>Contact: 01712454545</p>
    </div>
    <div class="info">
        <p><strong>Customer:</strong> {{ $contact->name ?? 'Walk-in-Customer' }}</p>
        <p><strong>Mobile:</strong> {{ $contact->mobile ?? '-' }}</p>
    </div>

    <h4 class="cloth-title">{{ $cloth->cloth_name }} Measurement</h4>

    @if ($cloth->measurements->isNotEmpty())
        <div class="measurement-grid">
            @foreach ($cloth->measurements as $index => $m)
                <div class="box">
                    <h5>{{ $m->measurement_name }}</h5>
                    <p>{{ $cloth_customization['measurements'][$index]['value'] ?? '-' }}</p>
                </div>
                @if ($m->subMeasurements->isNotEmpty())
                    @foreach ($m->subMeasurements as $sub_index => $sub)
                        <div class="box">
                            <h5>{{ $sub->sub_measurement_name }}</h5>
                            <p>{{ $cloth_customization['measurements'][$index]['sub_measurements'][$sub_index]['value'] ?? '-' }}
                            </p>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    @endif

    @if (!empty($cloth_customization->note))
        <div class="row">
            <div class="col-md-12">
                <p><strong>{{ $cloth_customization->note }}</strong></p>
            </div>
        </div>
    @endif

    <h4 class="cloth-title">{{ $cloth->cloth_name }} Style</h4>

    @if ($cloth_customization->styles)
        @php
            $styles = $cloth_customization->styles ?? [];
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
    @endif
</div>
