<x-app-dashboard name="System Settings" icon="cogs">
    <div class="row">
        {{-- Global Settings Row --}}
        <div class="col">
            @foreach ($user['sett']['settingsGrouped'] as $group)
            <div class="card shadow mb-4">
                <a href="#siteSetting" class="card-header py-3 " aria-expanded="true" data-bs-toggle="collapse" role="button">
                    <h6 class="m-0 fw-bold text-gray-600">{{ Str::ucfirst($group->description) }}</h6>
                </a>
                <div class="collapse show" id="siteSetting">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($group['config'] as $item)
                                @if ($item->type_name == "timezone")
                                    <x-config-timezone
                                        :name="$item->name"
                                        :description="$item->description"
                                        :value="$item->value"/>
                                @elseif($item->type_name == "string")
                                    <x-config-string
                                        :name="$item->name"
                                        :description="$item->description"
                                        :value="$item->value"/>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-dashboard>