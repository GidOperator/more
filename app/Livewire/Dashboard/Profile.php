<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Language;
use Illuminate\Support\Arr;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $profile = []; // Инициализируем массивом
    public $activeRole;
    public $photo;

    protected function rules()
    {
        return [
            'profile.name' => 'nullable|string|max:255',
            'profile.description' => 'nullable|string',
            'profile.public_slug' => 'nullable|string',
            'profile.company_name' => 'nullable|string',
            'profile.inn' => 'nullable|string',
            'profile.bio' => 'nullable|string',
            'profile.selected_languages' => 'nullable|array',
        ];
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->activeRole = (int) session('active_cabinet');

        $model = $this->getModel();

        if ($model) {
            // Загружаем модель со связями
            $model->load('languages');

            $this->profile = $model->toArray();

            // Помещаем ID выбранных языков в специальный ключ массива profile
            $this->profile['selected_languages'] = $model->languages->pluck('id')->toArray();
        }
    }

    /**
     * Вспомогательный метод для получения текущей модели профиля
     */
    private function getModel()
    {
        return match ($this->activeRole) {
            1 => $this->user->participant,
            2 => $this->user->organizer,
            3 => $this->user->partner,
            default => null,
        };
    }

    /**
     * Метод для удаления языка из выбранных (вызывается из Blade)
     */
    public function removeLanguage($languageId)
    {
        $this->profile['selected_languages'] = array_values(
            array_diff($this->profile['selected_languages'], [$languageId])
        );
    }

    public function save()
    {
        $this->validate();

        $model = $this->getModel();
        if (!$model) return;

        // 1️⃣ Обработка фото
        if ($this->photo) {
            [$folder, $field] = match ($this->activeRole) {
                1 => ['participants', 'avatar'],
                2 => ['organizers', 'logo'],
                3 => ['partners', 'logo'],
            };

            // Удаляем старый файл, если он есть
            if (!empty($model->{$field})) {
                Storage::disk('public')->delete($model->{$field});
            }

            $path = $this->photo->store("media/{$folder}", 'public');
            $this->profile[$field] = $path;
        }

        // 2️⃣ Синхронизация языков (Полиморфная связь Many-to-Many)
        // Обновляем таблицу languageables
        $model->languages()->sync($this->profile['selected_languages'] ?? []);

        // 3️⃣ Сохранение основных полей профиля
        // Убираем 'selected_languages' и 'languages', так как этих колонок нет в таблицах профилей
        $dataToSave = Arr::except($this->profile, ['selected_languages', 'languages']);

        $model->fill($dataToSave);
        $model->save();

        // Очистка состояния
        $this->photo = null;

        session()->flash('success', 'Профиль успешно обновлен!');
    }

    public function render()
    {
        $selectedIds = $this->profile['selected_languages'] ?? [];

        return view('livewire.dashboard.profile', [
            // Языки, которые юзер еще НЕ выбрал
            'availableLanguages' => Language::whereNotIn('id', $selectedIds)
                ->orderBy('name')
                ->get(),

            // Языки, которые юзер УЖЕ выбрал
            'myLanguages' => Language::whereIn('id', $selectedIds)
                ->orderBy('name')
                ->get(),
        ]);
    }
}
