@props([
    'endpoint' => route('search.global', [], false),
])

<x-search.global-search :endpoint="$endpoint" />
