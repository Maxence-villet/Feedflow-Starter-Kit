<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Sondages confirmés par jour</h3>
                    
                    <div style="position: relative; height: 400px; width: 100%;">
                        <canvas id="myChart" 
                            data-labels="{{ json_encode($chartLabels) }}" 
                            data-values="{{ json_encode($chartData) }}">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script src="{{ asset('js/dashboard-charts.js') }}?v={{ time() }}"></script>
</x-app-layout>