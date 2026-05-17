<section>

    {{-- FIRST NAME --}}
    <div class="form-group">
        <label>Fornavn</label>
        <input type="text" class="form-control"
               wire:model="user.first_name">
    </div>

    {{-- MIDDLENAME (hidden in Vue, så vi gør det samme) --}}
    @if(false)
        <div class="form-group">
            <label>Mellemnavn</label>
            <input type="text" class="form-control"
                   wire:model="user.middle_name">
        </div>
    @endif

    {{-- LAST NAME --}}
    <div class="form-group">
        <label>Efternavn</label>
        <input type="text" class="form-control"
               wire:model="user.last_name">
    </div>

    {{-- EMAIL --}}
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" class="form-control"
               wire:model="user.email">
    </div>

    {{-- PHONE --}}
    <div class="form-group">
        <label>Telefon</label>
        <input type="tel" class="form-control"
               wire:model="user.contact.phone">
    </div>

    <hr>

    {{-- INVITE CHECKBOX --}}
    <div class="form-group">
        <label>
            <input type="checkbox"
                   wire:model="user.invite">
            Send invitation til bruger
        </label>

        <div>Inviter bruger via E-mail og lad dem vælge password til sin bruger</div>
    </div>

    {{-- PASSWORD (kun når invite = false) --}}
    @if($this->showPassword)
        <hr>
        <div class="form-group">
            <label>Vælg password</label>
            <input type="text" class="form-control password"
                   wire:model="user.password">
        </div>
    @endif

</section>
