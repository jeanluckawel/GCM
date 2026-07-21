@props([
    'endpoint' => route('search.global', [], false),
    'minLength' => 2,
    'placeholder' => 'Rechercher un employé ou un dossier',
])

@php
    $instanceId = 'global-search-'.\Illuminate\Support\Str::uuid();
@endphp

<div
    id="{{ $instanceId }}"
    data-global-search
    data-endpoint="{{ $endpoint }}"
    data-min-length="{{ $minLength }}"
    class="relative w-full"
>
    <form action="#" method="GET" data-global-search-form class="relative">
        <div class="relative">
            <x-ui.search-input
                name="q"
                :value="request('q')"
                :placeholder="$placeholder"
                autocomplete="off"
                aria-autocomplete="list"
                aria-expanded="false"
                aria-controls="{{ $instanceId }}-results"
                class="w-full pr-12"
                data-global-search-input
            />

            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">
                <span
                    data-global-search-loading
                    class="hidden h-4 w-4 animate-spin rounded-full border-2 border-slate-300 border-t-slate-900"
                    aria-hidden="true"
                ></span>
            </div>
        </div>
    </form>

    <div
        data-global-search-panel
        aria-live="polite"
        class="absolute left-0 right-0 top-full z-50 mt-2 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/70"
    >
        <div class="border-b border-slate-100 px-4 py-3">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">
                Recherche globale
            </p>
        </div>

        <div
            id="{{ $instanceId }}-results"
            data-global-search-results
            class="max-h-[32rem] overflow-y-auto"
        >
            <div class="px-4 py-3 text-sm text-slate-500">
                Commencez à taper pour rechercher un employé ou un dossier.
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            (() => {
                const instances = document.querySelectorAll('[data-global-search]');

                if (!instances.length) {
                    return;
                }

                const getResultItems = (container) => Array.from(container.querySelectorAll('[data-search-result]'));

                instances.forEach((root) => {
                    const endpoint = root.dataset.endpoint;
                    const minLength = Number(root.dataset.minLength || 2);
                    const form = root.querySelector('[data-global-search-form]');
                    const input = root.querySelector('[data-global-search-input]');
                    const panel = root.querySelector('[data-global-search-panel]');
                    const results = root.querySelector('[data-global-search-results]');
                    const loading = root.querySelector('[data-global-search-loading]');
                    const searchInput = input?.querySelector('input[type="search"]');

                    if (!endpoint || !input || !panel || !results || !loading || !searchInput) {
                        return;
                    }

                    let timer = null;
                    let controller = null;
                    let latestQuery = '';

                    const openPanel = () => {
                        panel.classList.remove('hidden');
                        searchInput.setAttribute('aria-expanded', 'true');
                    };

                    const closePanel = () => {
                        panel.classList.add('hidden');
                        searchInput.setAttribute('aria-expanded', 'false');
                    };

                    const setLoading = (state) => {
                        loading.classList.toggle('hidden', ! state);
                    };

                    const focusResult = (direction = 1) => {
                        const items = getResultItems(results);

                        if (!items.length) {
                            return;
                        }

                        const active = document.activeElement;
                        const currentIndex = items.indexOf(active);
                        const nextIndex = currentIndex === -1
                            ? (direction > 0 ? 0 : items.length - 1)
                            : Math.min(items.length - 1, Math.max(0, currentIndex + direction));

                        items[nextIndex]?.focus();
                    };

                    const renderHtml = (html) => {
                        results.innerHTML = html;
                        openPanel();
                    };

                    const fetchResults = async (query) => {
                        if (controller) {
                            controller.abort();
                        }

                        controller = new AbortController();
                        latestQuery = query;
                        setLoading(true);

                        try {
                            const response = await fetch(`${endpoint}?q=${encodeURIComponent(query)}`, {
                                headers: {
                                    'Accept': 'text/html,application/xhtml+xml',
                                },
                                signal: controller.signal,
                            });

                            if (!response.ok) {
                                throw new Error('Request failed');
                            }

                            const html = await response.text();

                            if (query !== latestQuery) {
                                return;
                            }

                            renderHtml(html);
                        } catch (error) {
                            if (error.name !== 'AbortError') {
                                renderHtml(`
                                    <div class="px-4 py-3 text-sm text-rose-600">
                                        Une erreur est survenue pendant la recherche.
                                    </div>
                                `);
                            }
                        } finally {
                            setLoading(false);
                        }
                    };

                    const handleInput = () => {
                        const value = searchInput.value.trim();

                        if (timer) {
                            clearTimeout(timer);
                        }

                        if (value.length < minLength) {
                            results.innerHTML = `
                                <div class="px-4 py-3 text-sm text-slate-500">
                                    Commencez à taper pour rechercher un employé ou un dossier.
                                </div>
                            `;
                            closePanel();
                            return;
                        }

                        renderHtml(`
                            <div class="px-4 py-4 text-sm text-slate-500">
                                Recherche en cours...
                            </div>
                        `);

                        timer = window.setTimeout(() => {
                            fetchResults(value);
                        }, 220);
                    };

                    searchInput.addEventListener('input', handleInput);

                    searchInput.addEventListener('focus', () => {
                        if (searchInput.value.trim().length >= minLength) {
                            openPanel();
                        }
                    });

                    searchInput.addEventListener('keydown', (event) => {
                        if (event.key === 'Escape') {
                            closePanel();
                            return;
                        }

                        if (event.key === 'ArrowDown') {
                            event.preventDefault();
                            focusResult(1);
                            return;
                        }

                        if (event.key === 'ArrowUp') {
                            event.preventDefault();
                            focusResult(-1);
                            return;
                        }

                        if (event.key === 'Enter') {
                            const firstResult = results.querySelector('[data-search-result]');

                            if (firstResult) {
                                event.preventDefault();
                                firstResult.click();
                            }
                        }
                    });

                    results.addEventListener('keydown', (event) => {
                        if (event.key === 'Escape') {
                            closePanel();
                            searchInput.focus();
                            return;
                        }

                        if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                            event.preventDefault();
                            focusResult(event.key === 'ArrowDown' ? 1 : -1);
                            return;
                        }

                        if (event.key === 'Enter' || event.key === ' ') {
                            const target = event.target.closest('[data-search-result]');

                            if (target) {
                                event.preventDefault();
                                target.click();
                            }
                        }
                    });

                    form.addEventListener('submit', (event) => {
                        event.preventDefault();

                        const firstResult = results.querySelector('[data-search-result]');

                        if (firstResult) {
                            firstResult.click();
                        }
                    });

                    document.addEventListener('click', (event) => {
                        if (!root.contains(event.target)) {
                            closePanel();
                        }
                    });
                });
            })();
        </script>
    @endpush
@endonce
