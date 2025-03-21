<x-filament-panels::page>
    <x-filament-widgets::widgets
        :columns="[
            'default' => 1,
            'sm' => 2,
            'md' => 3,
            'lg' => 4,
        ]"
        :widgets="$this->getHeaderWidgets()"
        :data="$this->getHeaderWidgetsData()"
        :columnsLayout="'grid'"
        class="mb-8"
    />

    <x-filament-widgets::widgets
        :columns="[
            'default' => 1,
            'sm' => 2,
            'md' => 3,
            'lg' => 4,
        ]"
        :widgets="$this->getFooterWidgets()"
        :data="$this->getFooterWidgetsData()"
        :columnsLayout="'grid'"
    />
</x-filament-panels::page> 