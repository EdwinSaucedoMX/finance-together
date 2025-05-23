<flux:sidebar sticky
    class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="/" logo="/storage/icon.png" name="Finance Together" class="px-2 dark:hidden" />
    <flux:brand href="/" logo="/storage/icon.png" name="Finance Together" class="px-2 hidden dark:flex" />


    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="/" :current="request()->is('/')"
            class="{{ request()->is('/') ? 'bg-zinc-200 dark:bg-zinc-800 font-semibold' : '' }}">Home
        </flux:navlist.item>
        <flux:navlist.item icon="users" badge="{{$this->userGroupsCount}}" href="/groups"
            :current="request()->is('groups*')"
            class="{{ request()->is('groups*') ? 'bg-zinc-200 dark:bg-zinc-800 font-semibold' : '' }}">Groups
        </flux:navlist.item>
        <flux:navlist.item icon="banknotes" href="/movements" :current="request()->is('movements')"
            class="{{ request()->is('movements') ? 'bg-zinc-200 dark:bg-zinc-800 font-semibold' : '' }}">Movements
        </flux:navlist.item>
        {{-- <flux:navlist.item icon="wallet" href="/accounts" :current="request()->is('accounts')"
            class="{{ request()->is('accounts') ? 'bg-zinc-200 dark:bg-zinc-800 font-semibold' : '' }}">Accounts
        </flux:navlist.item> --}}
        @if($canViewAdmin)
            <flux:navlist.item icon="shield-check" href="/admin" :current="request()->is('admin')"
                class="{{ request()->is('admin') ? 'bg-zinc-200 dark:bg-zinc-800 font-semibold' : '' }}">Admin
            </flux:navlist.item>
        @endif
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        {{-- <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item> --}}
        <flux:dropdown x-data align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini"
                    class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini"
                    class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
            </flux:button>
            <flux:menu>
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
            </flux:menu>
        </flux:dropdown>

    </flux:navlist>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name={{$name}} />

        <flux:menu>
            <flux:menu.item icon="user" wire:click="profile">
                Profile
            </flux:menu.item>
            <flux:menu.separator />
            <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="logout">
                Logout
            </flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>