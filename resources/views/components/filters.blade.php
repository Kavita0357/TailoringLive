<div
    class="tw-transition-all tw-mb-4 lg:tw-col-span-1 tw-duration-200 tw-bg-white tw-shadow-sm tw-rounded-xl tw-ring-1 hover:tw-shadow-md tw-ring-gray-200">

    <div class="box-header with-border" style="cursor:pointer;">
        <h3 class="box-title tw-pt-2 tw-pb-2 tw-pl-2">
            <a data-toggle="collapse" href="#collapseFilter">
                @if (!empty($icon))
                    {!! $icon !!}
                @else
                    <i class="fa fa-filter"></i>
                @endif
                {{ $title ?? '' }}
            </a>
        </h3>
    </div>

    <div id="collapseFilter" class="panel-collapse collapse">
        <div class="box-body tw-pt-4 tw-pb-4 ">
            {{ $slot }}
        </div>
    </div>
</div>

<style>
@media (min-width: 768px) {
    #collapseFilter {
        display: block !important;
        height: auto !important;
        visibility: visible !important;
    }
} 
</style>