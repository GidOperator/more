<div class="cabinet-container">
    <div class="roles-selector">
        @foreach ($userRoles as $role)
            <label class="role-item">
                <input type="radio" name="active_role_selector" wire:change="switchCabinet({{ $role->id }})"
                    {{ $activeCabinet == $role->id ? 'checked' : '' }}>

                <span class="role-name">
                    {{ $role->name }} </span>
            </label>
        @endforeach
    </div>

    <div class="footer-actions">
        <button wire:click="switchCabinet('go_to_settings')" style="color: blue; cursor: pointer;">
            ⚙️ Управление ролями...
        </button>
    </div>
</div>
