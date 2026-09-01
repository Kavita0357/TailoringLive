<style>
    .page {
        width: 4.5in;
        min-height: 297mm;
        padding: 12mm;
        background: #fff;
        margin: auto;
        overflow: hidden;
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
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        width: 100%;
    }

    .style-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        width: 100%;
    }

    .style-grid .box {
        flex: 1;
        min-width: 0;
        /* To prevent overflow issues */
    }

    .box {
        border: 1px solid #000;
        border-radius: 4px;
        padding: 10px;
        text-align: center;
        min-height: 85px;
        margin-bottom: 0px;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        page-break-inside: avoid;
        break-inside: avoid;
    }

    .box h5 {
        margin: 0 0 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .box p {
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
            min-height: 297mm;
            padding: 10mm;
            margin: 0 auto;
        }

        .measurement-grid,
        .style-grid {
            gap: 8px;
        }

        .box {
            min-height: 75px;
        }
    }
</style>
<div class="page">
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

    @if ($cloth->styles->isNotEmpty())
        <div class="style-grid">
            @foreach ($cloth->styles as $index => $s)
                <div class="box">
                    <h5>{{ $s->style_name }}</h5>
                    @if ($s->designs->isNotEmpty())
                        @foreach ($s->designs as $sub_index => $sub)
                            <p>{{ $sub->design_name }} <br />
                                {{ $cloth_customization['styles'][$index]['designs'][$sub_index]['design_value'] ?? '' }}
                            </p>
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
