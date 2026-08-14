<div class="box box-widget @if($pos_settings['hide_product_suggestion'] == 0) collapsed-box @endif">
	<div class="box-header with-border">
		<h3 class="box-title">@lang('sale.recent_transactions')</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				@if($pos_settings['hide_product_suggestion'] == 0)
					<i class="fa fa-plus"></i>
				@else
					<i class="fa fa-minus"></i>
				@endif
			</button>
		</div>

	<!-- /.box-tools -->
	</div>
	<!-- /.box-header -->

	<div class="box-body">
		<div id="tab_final">
		</div>
	</div>
	<!-- /.box-body -->
</div>