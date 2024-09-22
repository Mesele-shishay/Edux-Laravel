<div>
    <x-modal title="Change Password" id="changePassword">
        <x-form id="changePassword" wire:submit='change'>
            <div class="container-fluid">
                <div class="row">
                    <x-flash/>
                    <div class="col-md-6 col-lg-8 ">
                        <x-form-input id="oldPassword" class="has-validation"
                            name="oldPassword"
                            label="Old Passworwd"
                            type="password"
                            placeholder="Enter old password"
                            value=""
                            wire:model='oldPassword'/>
                        <x-form-input id="newPassword"
                            name="newPassword"
                            label="New Passworwd"
                            type="password"
                            placeholder="Enter new password"
                            value=""
                            wire:model='newPassword'/>
                        <x-form-input id="newPassword_confirmation"
                            name="newPassword2"
                            label="Confirm Passworwd"
                            type="password"
                            placeholder="Confirm old password"
                            value=""
                            wire:model='newPassword2' />

                        <x-form-input class="btn btn-outline-primary btn-sm"
                            name="changePasswordBtn"
                            type="submit"
                            value="Change Password"/>

                    </div>
                </div>
            </div>
        </x-form>
    </x-modal>
</div>