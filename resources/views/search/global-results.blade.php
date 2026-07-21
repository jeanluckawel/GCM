@php
    $hasResults = $employeeResults->isNotEmpty() || $folderResults->isNotEmpty();
@endphp

<div class="space-y-3 p-2">
    @if(mb_strlen($query) < 2)
        <x-ui.empty-state
            title="Recherche globale"
            description="Tapez au moins 2 caractères pour rechercher un employé ou un dossier."
            class="border-0 bg-transparent px-4 py-8"
        >
            <x-slot:icon>
                <i class="bi bi-search text-2xl"></i>
            </x-slot:icon>
        </x-ui.empty-state>
    @elseif(! $hasResults)
        <x-ui.empty-state
            title="Aucun résultat"
            :description="'Aucun résultat trouvé pour « '.$query.' ».'"
            class="border-0 bg-transparent px-4 py-8"
        >
            <x-slot:icon>
                <i class="bi bi-search text-2xl"></i>
            </x-slot:icon>
        </x-ui.empty-state>
    @else
        <div class="px-4 pt-1">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">
                Résultats
            </p>
        </div>

        @if($employeeResults->isNotEmpty())
            <x-search.result-group title="Employés" :count="$employeeResults->count()" icon="bi bi-person">
                <div class="divide-y divide-slate-100">
                    @foreach($employeeResults as $employee)
                        <x-search.result-item
                            :href="$employee['href']"
                            :title="$employee['title']"
                            :meta="$employee['meta']"
                            :badge="$employee['badge']"
                            :initials="$employee['initials']"
                            icon="bi bi-person"
                        />
                    @endforeach
                </div>
            </x-search.result-group>
        @endif

        @if($folderResults->isNotEmpty())
            <x-search.result-group title="Dossiers" :count="$folderResults->count()" icon="bi bi-folder">
                <div class="divide-y divide-slate-100">
                    @foreach($folderResults as $folder)
                        <x-search.result-item
                            :href="$folder['href']"
                            :title="$folder['title']"
                            :meta="$folder['meta']"
                            :badge="$folder['badge']"
                            :initials="$folder['initials']"
                            icon="bi bi-folder"
                        />
                    @endforeach
                </div>
            </x-search.result-group>
        @endif
    @endif
</div>
