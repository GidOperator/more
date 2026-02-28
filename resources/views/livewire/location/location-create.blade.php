<div class="container mt-4" x-data="locationForm()" x-cloak>
    <div class="d-flex align-items-center gap-2 mb-3">
        <a href="/locations" class="text-decoration-none text-dark">←</a>
        <h1 class="mb-0">Новая локация</h1>
    </div>

    <form wire:submit.prevent="save">
        {{-- Название --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Название локации</label>
            <input type="text" class="form-control" wire:model.defer="title">
            @error('title')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Тип --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Тип</label>
            <select wire:model.defer="type" class="form-select">
                <option value="" style="background-color: black;">-- Выберите тип --</option>
                @foreach ($allTypes as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('type')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Описание --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Описание</label>
            <div wire:ignore x-data="{ content: @entangle('description') }" x-on:trix-change="content = $event.target.value">
                <input id="trix-content" type="hidden" :value="content">
                <trix-editor input="trix-content" class="form-control" style="min-height:200px;"></trix-editor>
            </div>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        {{-- Телефон --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Телефон</label>
            <input type="text" class="form-control" wire:model.defer="phone">
            @error('phone')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            {{-- Город --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Город</label>
                @livewire('city.city-select', key('city-select'))
                @error('city_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Адрес --}}
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Адрес</label>
                @livewire('city.address-suggest', [], key('address-suggest'))

                <input type="hidden" wire:model.defer="latitude">
                <input type="hidden" wire:model.defer="longitude">

                @error('address')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                @error('latitude')
                    <div class="text-danger small mt-1">Выберите адрес из списка</div>
                @enderror
            </div>
        </div>

        {{-- Фото --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Фотографии</label>
            <div class="border rounded p-4 text-center bg-white"
                style="cursor:pointer; border-style: dashed !important;" x-on:click="$refs.mediaInput.click()"
                x-on:dragover.prevent x-on:drop.prevent="handleFiles($event.dataTransfer.files)">
                <p class="mb-0 text-muted">Перетащите файлы или кликните для выбора</p>
                <input type="file" x-ref="mediaInput" multiple hidden wire:model="photos"
                    x-on:change="handleFiles($event.target.files)">
            </div>

            <div class="row g-2 mt-2">
                <template x-for="(file, index) in files" :key="index">
                    <div class="col-3 col-md-2 position-relative">
                        <img :src="file.url" class="img-fluid rounded border"
                            style="height:100px; width:100%; object-fit:cover;">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                            x-on:click="remove(index)" style="border-radius: 50%; padding: 0 6px;">✕</button>
                    </div>
                </template>
            </div>
            @error('photos.*')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Категории --}}
        <div class="mb-3 border rounded p-3 bg-light">
            <label class="form-label fw-bold mb-2">Категории партнеров</label>
            <div class="row">
                @foreach ($allCategories as $category)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                                id="cat{{ $category->id }}" wire:model.defer="categories">
                            <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('categories')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Подтверждение --}}
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" wire:model.defer="is_confirmed" id="confirm">
            <label class="form-check-label" for="confirm">Я подтверждаю достоверность данных</label>
            @error('is_confirmed')
                <div class="text-danger small d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2 mb-5">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">Создать локацию</button>
            <a href="/locations" class="btn btn-outline-secondary btn-lg px-4">Отмена</a>
        </div>
    </form>

    <script>
        function locationForm() {
            return {
                files: [],
                handleFiles(fileList) {
                    const newFiles = Array.from(fileList);
                    newFiles.forEach(f => {
                        if (!f.type.startsWith('image/')) return;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.files.push({
                                name: f.name,
                                url: e.target.result,
                                file: f
                            });
                        };
                        reader.readAsDataURL(f);
                    });
                },
                remove(index) {
                    this.files.splice(index, 1);
                    const dt = new DataTransfer();
                    this.files.forEach(f => dt.items.add(f.file));
                    this.$refs.mediaInput.files = dt.files;
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        trix-toolbar .trix-button-group--file-tools {
            display: none !important;
        }
    </style>
</div>
