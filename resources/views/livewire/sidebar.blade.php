<flux:sidebar sticky
    class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="/" logo="/storage/icon.png" name="Finance Together" class="px-2 dark:hidden" />
    <flux:brand href="/" logo="/storage/icon.png" name="Finance Together" class="px-2 hidden dark:flex" />

    <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="/" current>Home</flux:navlist.item>
        <flux:navlist.item icon="users" badge="12" href="#">Groups</flux:navlist.item>
        <flux:navlist.item icon="banknotes" href="movements">Movements</flux:navlist.item>
        <flux:navlist.item icon="wallet" href="#">Accounts</flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
        <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
    </flux:navlist>

    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name={{$name}} />

        <flux:menu>
            <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="profile">
                Profile
            </flux:menu.item>
            <flux:menu.separator />
            <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="logout">
                Logout
            </flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>