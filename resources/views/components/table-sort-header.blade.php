@props(['label', 'field', 'sortField', 'sortDirection'])

<th scope="col"
    class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider cursor-pointer hover:bg-slate-100 transition-colors group"
    wire:click="sortBy('{{ $field }}')">
    <div class="flex items-center space-x-1">
        <span>{{ $label }}</span>
        @if ($sortField === $field)
            <span class="text-blue-600">
                @if ($sortDirection === 'asc')
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                @else
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                @endif
            </span>
        @else
            <span class="text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                </svg>
            </span>
        @endif
    </div>
</th>