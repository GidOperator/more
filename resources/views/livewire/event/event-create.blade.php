<div class="container mt-4" x-data="eventForm()" x-cloak>

    <div class="d-flex align-items-center gap-2 mb-3">
        <a href="/cabinet/organizer" class="text-decoration-none text-dark">←</a>
        <h1 class="mb-0">Новое событие</h1>
    </div>

    <form wire:submit.prevent="save">

        <div class="mb-3">
            <label class="form-label">Название события</label>
            <input type="text" class="form-control" wire:model.defer="title">
            @error('title')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label class="form-label">Дата и время начала</label>
                <input type="datetime-local" class="form-control" wire:model.defer="start_at">
                @error('start_at')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Дата и время окончания</label>
                <input type="datetime-local" class="form-control" wire:model.defer="end_at">
                @error('end_at')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <div wire:ignore x-data="{ content: @entangle('description') }" x-on:trix-change="content = $event.target.value">
                <input id="x" type="hidden" :value="content">
                <trix-editor input="x" class="form-control" style="min-height: 200px;"></trix-editor>
            </div>
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3" x-data="{
            hasDiscount: @entangle('has_discount'),
            discountType: @entangle('discount_type')
        }">
            <div class="col-md-6 mb-3">
                <label class="form-label">Стоимость</label>
                <div class="input-group">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox" wire:model="price_from" id="price_from">
                        <label class="form-check-label ms-2 mb-0" for="price_from">от</label>
                    </div>
                    <input type="number" class="form-control" placeholder="0" wire:model="price">
                    <span class="input-group-text">₽</span>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label d-block">Скидка</label>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" role="switch" x-model="hasDiscount">
                    <label class="form-check-label">Установить скидку</label>
                </div>

                <div class="mt-2" x-show="hasDiscount" x-transition>
                    <div class="input-group">
                        <select class="form-select" style="max-width: 100px;" x-model="discountType">
                            <option value="percent">%</option>
                            <option value="amount">Сумма</option>
                        </select>
                        <input type="number" class="form-control"
                            :placeholder="discountType === 'percent' ? '%' : '₽'" wire:model="discount_value">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3" x-data="{ count: @entangle('max_participants') }">
            <label class="form-label">Максимальное количество участников</label>
            <div class="d-flex align-items-center gap-3">
                <button type="button" class="btn btn-outline-secondary" @click="if(count > 0) count--">-</button>
                <input type="number" class="form-control text-center" style="max-width: 100px;" x-model="count"
                    readonly>
                <button type="button" class="btn btn-outline-secondary" @click="count++">+</button>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Город</label>
            @livewire('city.city-select', key('city-select'))
        </div>

        <div class="mb-3">
            <label class="form-label">Адрес</label>
            @livewire('city.address-suggest', ['wire:model' => 'address'], key('address-suggest'))
        </div>

        <div class="mb-3" wire:ignore x-data="categoryDropdown(@entangle('subcategory_id'), {{ json_encode($categories) }})" @click.away="close()">
            <label class="form-label">Категория / подкатегория</label>

            <!-- Trigger -->
            <div class="d-flex justify-content-between align-items-center p-2 border rounded bg-white"
                style="cursor:pointer" @click="toggle()">
                <span x-text="selectedName" :class="subId ? 'text-primary fw-bold' : 'text-muted'"></span>
                <span x-text="open ? '▼' : '▶'"></span>
            </div>

            <!-- Dropdown -->
            <div x-show="open" x-transition class="mt-2 border rounded shadow-sm bg-white overflow-hidden">
                <template x-for="category in categories" :key="category.id">
                    <div>
                        <!-- Category -->
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom"
                            style="cursor:pointer" @click="toggleCategory(category.id)">
                            <span class="fw-bold" x-text="category.name"></span>
                            <span x-text="openCategory === category.id ? '▼' : '▶'"></span>
                        </div>

                        <!-- Subcategories -->
                        <div x-show="openCategory === category.id" x-transition>
                            <template x-for="sub in category.subcategories" :key="sub.id">
                                <div class="form-check ps-4 py-2 border-bottom hover-bg-light">
                                    <input class="form-check-input" type="radio" :checked="subId === sub.id"
                                        @click.stop="select(sub.id)">
                                    <label class="form-check-label cursor-pointer" @click.stop="select(sub.id)"
                                        x-text="sub.name">
                                    </label>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            @error('subcategory_id')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Фото и видео</label>
            <div class="border border-secondary rounded p-4 text-center" style="cursor: pointer"
                x-on:click="$refs.mediaInput.click()" x-on:dragover.prevent
                x-on:drop.prevent="handleFiles($event.dataTransfer.files)">
                <p class="mb-0 text-muted">Перетащите файлы сюда или кликните, чтобы выбрать</p>
                <input type="file" x-ref="mediaInput" multiple style="display:none" wire:model="media"
                    x-on:change="handleFiles($event.target.files)">
            </div>

            <div class="mt-2 row g-2">
                <template x-for="(file, index) in files" :key="index">
                    <div class="col-3 text-center position-relative">
                        <template x-if="file.type.startsWith('image')">
                            <img :src="file.url" class="img-fluid rounded"
                                style="max-height:100px; object-fit: cover;">
                        </template>
                        <template x-if="!file.type.startsWith('image')">
                            <div class="border rounded p-2 bg-light">
                                <i class="bi bi-file-earmark-video"></i>
                                <div class="small text-truncate" x-text="file.name"></div>
                            </div>
                        </template>
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            x-on:click="remove(index)" style="font-size:0.7rem; border-radius: 50%;">✕</button>
                    </div>
                </template>
            </div>
        </div>

        <div class="mb-3" x-data="videoForm()" x-cloak>
            <label class="form-label">Ссылки на видео (YouTube/Vimeo)</label>
            <div class="d-flex mb-2">
                <input type="text" class="form-control me-2" placeholder="Вставьте ссылку" x-model="newVideo"
                    @keydown.enter.prevent="addVideo()">
                <button type="button" class="btn btn-primary" @click="addVideo()">Добавить</button>
            </div>
            <template x-for="(video, index) in videos" :key="index">
                <div
                    class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center bg-white shadow-sm">
                    <span class="text-truncate me-2" x-text="video"></span>
                    <button type="button" class="btn btn-sm btn-outline-danger"
                        @click="removeVideo(index)">✕</button>
                </div>
            </template>
            <input type="hidden" name="videos" :value="videos.join(',')" wire:model.defer="videos">
        </div>

        <div class="mb-3" x-data="{ receiveOffers: @entangle('receive_offers') }">
            <h3>Приглашенные партнеры</h3>
            <p class="text-muted small">После публикации события вы сможете пригласить партнёров через личный кабинет.
            </p>

            <div class="form-check form-switch mt-2">
                <input class="form-check-input" type="checkbox" role="switch" id="receiveOffers"
                    x-model="receiveOffers">
                <label class="form-check-label" for="receiveOffers">Получать предложения от партнеров</label>
            </div>

            <div class="mt-3 border rounded p-3 bg-light" x-show="receiveOffers" x-transition>
                <label class="form-label">Какие категории партнёров вам интересны?</label>
                @foreach ($partnerCategories as $category)
                    <div class="form-check" wire:key="partner-category-{{ $category->id }}">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}"
                            id="partnerCategory{{ $category->id }}" wire:model.defer="partner_categories">
                        <label class="form-check-label" for="partnerCategory{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex gap-2 mt-4 pb-5">
            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">Опубликовать событие</button>
            <a href="/cabinet/organizer" class="btn btn-outline-secondary btn-lg px-4">Отмена</a>
        </div>

    </form>

    <script>
        function eventForm() {
            return {
                files: [],
                handleFiles(fileList) {
                    const newFiles = Array.from(fileList);
                    newFiles.forEach(f => {
                        const reader = new FileReader();
                        reader.onload = e => {
                            this.files.push({
                                name: f.name,
                                type: f.type,
                                url: e.target.result,
                                file: f
                            });
                        };
                        reader.readAsDataURL(f);
                    });
                    const dt = new DataTransfer();
                    newFiles.forEach(f => dt.items.add(f));
                    this.$refs.mediaInput.files = dt.files;
                },
                remove(index) {
                    this.files.splice(index, 1);
                    const dt = new DataTransfer();
                    this.files.forEach(f => dt.items.add(f.file));
                    this.$refs.mediaInput.files = dt.files;
                }
            }
        }

        function videoForm() {
            return {
                videos: @entangle('videos'),
                newVideo: '',
                addVideo() {
                    if (this.newVideo.trim()) {
                        this.videos.push(this.newVideo.trim());
                        this.newVideo = '';
                    }
                },
                removeVideo(index) {
                    this.videos.splice(index, 1);
                }
            }
        }


        function categoryDropdown(subIdEntangle, categories) {
            return {
                open: false,
                openCategory: null,
                subId: subIdEntangle,
                categories,

                get selectedName() {
                    if (!this.subId) return 'Выберите из списка';

                    for (const cat of this.categories) {
                        const sub = cat.subcategories.find(s => s.id === this.subId);
                        if (sub) return sub.name;
                    }

                    return 'Выберите из списка';
                },

                toggle() {
                    this.open = !this.open;
                },

                close() {
                    this.open = false;
                    this.openCategory = null;
                },

                toggleCategory(id) {
                    this.openCategory = this.openCategory === id ? null : id;
                },

                select(id) {
                    this.subId = id; // 🔥 синхронизация с Livewire
                    this.close();
                }
            }
        }
    </script>

    <style>
        .hover-bg-light:hover {
            background-color: #f8f9fa;
        }

        trix-toolbar .trix-button-group--file-tools {
            display: none !important;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</div>
