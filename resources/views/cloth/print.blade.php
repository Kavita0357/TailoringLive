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
        <div class="measurement-grid">
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
