<div>
    @push('meta')
        <title>{{ $page->meta_title ?? $page->title }}</title>
        <meta name="description" content="{{ $page->meta_description }}">
    @endpush


    @if ($type === 'participant')
        @livewire('public-page.participant', ['participant' => $model], key('part-' . $model->id))
    @elseif($type === 'partner')
        @livewire('public-page.partner', ['partner' => $model], key('partn-' . $model->id))
    @elseif($type === 'organizer')
        @livewire('public-page.organizer', ['organizer' => $model], key('org-' . $model->id))
    @else
        <div class="text-center p-10">Тип страницы не найден.</div>
    @endif
</div>
