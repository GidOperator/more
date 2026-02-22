<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Создать новое предложение услуги</h5>
                </div>
                <div class="card-body p-4">
                    <form wire:submit.prevent="save">

                        {{-- Название --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Укажите название услуги</label>
                            <input type="text" wire:model="title"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Например: Свадебная фотосессия">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Категория --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Выберите категорию</label>
                            <select wire:model="category_id"
                                class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">Выберите категорию...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Место проведения --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Место проведения</label>
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="checkbox" wire:model="location_type"
                                    value="other_city" id="otherCity">
                                <label class="form-check-label" for="otherCity">Можно в другом городе</label>
                            </div>

                            <select wire:model="address_id"
                                class="form-select @error('address_id') is-invalid @enderror">
                                <option value="">Выберите адрес из своих локаций...</option>

                                {{-- @forelse автоматически проверяет, пустой ли список --}}
                                @forelse ($myAddresses ?? [] as $address)
                                    <option value="{{ $address->id }}">{{ $address->full_address }}</option>
                                @empty
                                    <option value="" disabled>У вас пока нет добавленных адресов</option>
                                @endforelse
                            </select>
                        </div>

                        {{-- Описание --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Описание услуги</label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Опишите все детали..."></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Количество человек --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Количество человек</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Мин.</span>
                                        <input type="number" wire:model="min_people" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text">Макс.</span>
                                        <input type="number" wire:model="max_people" class="form-control">
                                    </div>
                                </div>
                            </div>
                            @error('max_people')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Стоимость --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Стоимость услуги</label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="input-group" style="max-width: 200px;">
                                    <span class="input-group-text">₽</span>
                                    <input type="number" wire:model="price" class="form-control">
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model.live="is_price_from"
                                        id="isPriceFrom">
                                    <label class="form-check-label" for="isPriceFrom">
                                        Цена «от»
                                    </label>
                                </div>
                            </div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Фотографии --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Загрузить фото</label>
                            <input type="file" wire:model="photos" class="form-control" multiple accept="image/*">

                            {{-- Превью загруженных фото --}}
                            @if ($photos)
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @foreach ($photos as $photo)
                                        <img src="{{ $photo->temporaryUrl() }}"
                                            style="width: 80px; height: 80px; object-fit: cover;"
                                            class="rounded border">
                                    @endforeach
                                </div>
                            @endif
                            @error('photos.*')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="/dashboard" class="btn btn-light px-4">Отмена</a>
                            <button type="submit" class="btn btn-primary px-5">Опубликовать</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
