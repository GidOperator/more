<div class="cabinet-container">
    <div class="roles-selector">
        @foreach ($userRoles as $role)
        <label class="role-item simple-dropdown__link">
            <input type="radio" name="active_role_selector" wire:change="switchCabinet({{ $role->id }})"
                {{ $activeCabinet == $role->id ? 'checked' : '' }}>

            <span class="role-name">
                {{ $role->name }} </span>
        </label>
        @endforeach
    </div>

    <div class="footer-actions">
        <button wire:click="switchCabinet('go_to_settings')" class="switch-cabinet">
            <span class="icon-settings simple-dropdown__link-icon"></span> Управление ролями
        </button>
    </div>
</div>