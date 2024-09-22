<x-app-dashboard name="Create Events" icon="calendar-event">
    <div class="row justify-content-start">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <div class="row bg-white p-4 shadow-sm">
                        @include('components.events.event-calendar', ['editable' => 'true', 'selectable' => 'true'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-dashboard>
