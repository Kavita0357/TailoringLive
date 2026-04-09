<style type="text/css">
    .measurement-card {
        border: 2px solid #e3e3e3;
        border-radius: 10px;
        margin-bottom: 10px;
        padding: 5px 0;
    }

    .measurement-card h5 {
        color: #191919;
        font-weight: bold;
    }

    .cloth-note {
        padding: 30px 0;
    }
</style>
<div class="modal-dialog" role="document" style="width: 900px;">
    <input type="hidden" id="transaction_id" value={{ $transaction->id }} />
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                @lang('tailoring.measurement_print')
            </h4>
        </div>
        @php
            $index = 0;
            //echo json_encode($transaction);
        @endphp
        <div class="modal-body">
            <div class="print-area">
                <div id="cloth-pages">

                    @foreach ($sell_details as $index => $sell)

                        <div class="cloth-page" style="{{ $index == 0 ? '' : 'display:none;' }}"
                            data-cloth-id="{{ $sell->cloth_id }}">

                            {{-- Tailor Copy --}}
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>@lang('tailoring.tailor_copy')</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>{{ $sell->cloth_name }}</h5>
                                        <p>{{ intval($sell->quantity_ordered) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>Order No.</h5>
                                        <p>{{ intval($transaction->invoice_no) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>Order Date :
                                            <span
                                                style="font-weight:400">{{ @format_date($transaction->transaction_date) }}</span>
                                        </h5>
                                        <h5>Delivey Date :
                                            <span
                                                style="font-weight:400">{{ @format_date($transaction->delivery_date) }}</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-4">

                                </div>
                            </div>

                            {{-- @if ($sell->cloth_customization)
                                @php
                                    $measurements = $sell->cloth_customization->measurements ?? [];
                                @endphp

                                @if (!empty($measurements))
                                    <div class="row g-3">
                                        @foreach ($measurements as $m)
                                            @if (isset($m['value']))
                                                <div class="col-md-2">
                                                    <div class="measurement-card text-center border p-3">
                                                        <h5>{{ $m['measurement_name'] }}</h5>
                                                        <p>{{ $m['value'] ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endif --}}

                            <?php
                            //echo json_encode($sell->cloth_customization);
                            ?>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>@lang('tailoring.shop_copy')</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>{{ $sell->cloth_name }}</h5>
                                        <p>{{ intval($sell->quantity_ordered) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>Order No.</h5>
                                        <p>{{ intval($transaction->invoice_no) }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="measurement-card text-center">
                                        <h5>Order Date :
                                            <span
                                                style="font-weight:400">{{ @format_date($transaction->transaction_date) }}</span>
                                        </h5>
                                        <h5>Delivey Date :
                                            <span
                                                style="font-weight:400">{{ @format_date($transaction->delivery_date) }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            @if ($sell->cloth_customization)
                                @php
                                    $measurements = $sell->cloth_customization->measurements ?? [];
                                    $styles = $sell->cloth_customization->styles ?? [];
                                @endphp

                                @if (!empty($measurements))
                                    <div class="row g-3">
                                        @foreach ($measurements as $m)
                                            @if (isset($m['value']))
                                                <div class="col-md-2">
                                                    <div class="measurement-card text-center border p-3">
                                                        <h5>{{ $m['measurement_name'] }}</h5>
                                                        <p>{{ $m['value'] ?? '-' }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif

                                @if (!empty($sell->cloth_customization->note))
                                    <div class="row cloth-note">
                                        <div class="col-md-12">
                                            <p>
                                                <strong>{{ $sell->cloth_customization->note }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($styles))
                                    <div class="row g-3">
                                        @foreach ($styles as $s)
                                            <div class="col-md-2">
                                                <div class="measurement-card text-center border p-3">
                                                    <h5>{{ $s['name'] }}</h5>
                                                    @php
                                                        $designs = $s['designs'] ?? [];
                                                        $values = collect($designs)
                                                            ->pluck('design_value')
                                                            ->filter()
                                                            ->toArray();
                                                    @endphp
                                                    <p>
                                                        {{ !empty($values) ? implode(', ', $values) : '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif

                        </div>

                    @endforeach

                </div>
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-default prev-btn">Prev</button>
                @foreach ($sell_details as $index => $sell)
                    <button class="btn btn-default page-btn" data-index="{{ $index }}">
                        {{ $index + 1 }}
                    </button>
                @endforeach
                <button class="btn btn-default next-btn">Next</button>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="print_measurement_btn"
                class="tw-dw-btn tw-dw-btn-primary tw-text-white">@lang('tailoring.print')</button>
            <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white"
                data-dismiss="modal">@lang('messages.cancel')</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script>
    $(document).ready(function() {

        let currentPage = 0;
        const pages = $('#cloth-pages .cloth-page'); // ✅ scoped correctly

        function showPage(index) {
            pages.hide().eq(index).show();
            currentPage = index;

            $('.page-btn').removeClass('active');
            $('.page-btn').eq(index).addClass('active');
        }

        showPage(0);

        $('.next-btn').click(function() {
            if (currentPage < pages.length - 1) {
                showPage(currentPage + 1);
            }
        });

        $('.prev-btn').click(function() {
            if (currentPage > 0) {
                showPage(currentPage - 1);
            }
        });

        $('.page-btn').click(function() {
            let index = $(this).data('index');
            showPage(index);
        });

        $(document).on('click', '#print_measurement_btn', function() {

            let transactionId = $('#transaction_id').val();

            // 👉 Get currently visible cloth
            let clothId = $('.cloth-page:visible').data('cloth-id');

            console.log('Cloth ID:', clothId);

            if (!clothId) {
                alert('No cloth selected');
                return;
            }

            let url = `/sells/${transactionId}/print_measurement/${clothId}`;

            $.ajax({
                url: url,
                method: 'GET',
                success: function(result) {

                    $('#print_section').html(result);

                    setTimeout(function() {
                        printSection('print_section');
                    }, 300);
                },
                error: function() {
                    // alert('Something went wrong');
                }
            });

        });

        function printSection(divId) {

            let content = $('#' + divId).html();

            let printWindow = window.open('', '', 'width=900,height=700');

            printWindow.document.write(`
        <html>
        <head>
            <title>Print</title>

            <style>
                @page { size: A4; margin: 10mm; }

                body {
                    font-family: Arial, sans-serif;
                }

                .box {
                    border: 1px solid #000;
                    padding: 10px;
                    width: 30%;
                    display: inline-block;
                    margin: 5px;
                    text-align: center;
                }
            </style>
        </head>

        <body>
            ${content}
        </body>
        </html>
    `);

            printWindow.document.close();

            setTimeout(function() {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

    });
</script>
