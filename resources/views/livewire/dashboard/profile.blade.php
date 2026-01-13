<div class="container my-4 p-4 bg-white rounded shadow-sm">
    <form wire:submit.prevent="save">

        {{-- Контейнер: аватар слева, поля справа --}}
        <div class="row g-3 align-items-start">

            {{-- Фото --}}
            <div class="col-auto text-center">
                <div class="mb-2" style="width: 100px; height: 100px;">
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}"
                            class="img-fluid rounded border w-100 h-100 object-fit-cover">
                    @else
                        @php
                            $currentImage = $profile['logo'] ?? ($profile['avatar'] ?? null);
                        @endphp
                        @if ($currentImage)
                            <img src="{{ asset('storage/' . $currentImage) }}"
                                class="img-fluid rounded border w-100 h-100 object-fit-cover">
                        @else
                            <img src="{{ asset('images/default-placeholder.png') }}"
                                class="img-fluid rounded border w-100 h-100 object-fit-cover">
                        @endif
                    @endif
                </div>

                <input type="file" wire:model="photo" class="form-control form-control-sm">
                <div wire:loading wire:target="photo" class="text-muted small mt-1">Загрузка...</div>
                @error('photo')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            {{-- Поля --}}
            <div class="col">
                {{-- Динамические поля профиля --}}
                @if ($activeRole === 3)
                    <h5>Данные партнера</h5>
                    <div class="mb-3">
                        <input type="text" wire:model="profile.company_name" placeholder="Название компании"
                            class="form-control">
                    </div>
                @elseif ($activeRole === 2)
                    <h5>Данные организатора</h5>

                    <div class="mb-3">
                        <label class="form-label">Название организации</label>
                        <input type="text" wire:model="profile.name" placeholder="Введите название"
                            class="form-control">
                        @error('profile.name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <textarea wire:model="profile.description" rows="3" placeholder="Расскажите о себе или организации"
                            class="form-control"></textarea>
                        @error('profile.description')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Публичный адрес (Slug)</label>
                        <input type="text" wire:model="profile.public_slug" placeholder="my-org-name"
                            class="form-control">
                        @error('profile.public_slug')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                @elseif ($activeRole === 1)
                    <h5>Данные участника</h5>
                    <div class="mb-3">
                        <input type="text" wire:model="profile.bio" placeholder="О себе" class="form-control">
                    </div>
                @endif
            </div>

        </div>

        <hr class="my-4">

        {{-- Кнопка --}}
        <div class="d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-primary me-3">Сохранить изменения</button>
            <div wire:loading wire:target="save" class="text-muted small">Сохранение...</div>
        </div>

    </form>
</div>
