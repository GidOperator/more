<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Услуги</h1>

        <div class="dropdown custom-hover-dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="createOfferButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-plus-lg me-1"></i> Создать предложение
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="createOfferButton">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#"
                        wire:click.prevent="createService">
                        <i class="bi bi-briefcase me-2"></i> Предложить услугу
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#"
                        wire:click.prevent="createLocation">
                        <i class="bi bi-geo-alt me-2"></i> Предложить локацию
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Стили для появления при наведении --}}
    <style>
        .custom-hover-dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            /* Убирает зазор, чтобы меню не закрывалось */
        }
    </style>
</div>
