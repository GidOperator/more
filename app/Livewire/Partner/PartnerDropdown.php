<?php

namespace App\Livewire\Partner;

use Livewire\Component;
use App\Models\CategoryPartner; // Предполагаю, что модель называется так

class PartnerDropdown extends Component
{
    public function selectCategory($id)
    {
        // Получаем URL, с которого пришел запрос
        $referer = request()->header('referer');

        // Проверяем, находится ли пользователь на странице партнеров
        if ($referer && str_contains($referer, '/partners')) {

            // Отправляем событие в компонент сетки партнеров
            $this->dispatch('category-partner-selected', categoryId: $id)->to(PartnerGrid::class);
        } else {

            // Если мы на другой странице — редирект на список партнеров с фильтром
            // Берем город из роута, если его нет — ставим по дефолту 'tomsk'
            $city = request()->route('city_slug') ?? 'tomsk';

            return redirect()->to("/{$city}/partners?category={$id}");
        }
    }

    public function render()
    {
        return view('livewire.partner.partner-dropdown', [
            // Подгружаем категории партнеров для выпадающего списка
            'categories' => CategoryPartner::orderBy('name', 'asc')->get()
        ]);
    }
}
