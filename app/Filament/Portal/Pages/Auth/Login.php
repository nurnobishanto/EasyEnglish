<?php
namespace App\Filament\Portal\Pages\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //$this->getEmailFormComponent(),
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Email, User ID, or Phone Number')
            ->required()
            ->autocomplete()
            ->autofocus();
    }
    protected function getCredentialsFromFormData(array $data): array
    {
        $loginType = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($data['login']) && strlen($data['login']) === 9 ? 'user_id' : 'phone_number');
        return [
            $loginType => $data['login'],
            'password'  => $data['password'],
        ];
    }
}
