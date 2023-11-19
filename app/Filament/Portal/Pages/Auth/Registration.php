<?php

namespace App\Filament\Portal\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as BaseAuth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class Registration extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getRegisterFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getConfirmPasswordFormComponent(),
                $this->getBatchFormComponent(),
                $this->getCollegeFormComponent(),
                $this->getDistrictFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Full name')
            ->required();
    }

    protected function getRegisterFormComponent(): Component
    {
        return TextInput::make('register')
            ->label('Email or Phone Number')
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->rule(\Illuminate\Validation\Rules\Password::default())
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'));
    }

    protected function getConfirmPasswordFormComponent(): Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('Confirm Password')
            ->password()
            ->required()
            ->dehydrated(false);
    }

    protected function getBatchFormComponent(): Component
    {
        return TextInput::make('batch')
            ->label('Batch')
            ->placeholder('Optional');
    }

    protected function getCollegeFormComponent(): Component
    {
        return TextInput::make('college')
            ->label('College')
            ->placeholder('Optional');
    }

    protected function getDistrictFormComponent(): Component
    {
        return TextInput::make('district')
            ->label('District')
            ->placeholder('Optional');
    }
    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }
        $data = $this->form->getState();
        $loginType = $this->detectLoginType($data['register']);
        $newData = [
            'name'            => $data['name'],
            $loginType        => $data['register'],
            'password'        => $data['password'],
            'batch'           => $data['batch'] ?? null,
            'college'         => $data['college'] ?? null,
            'district'        => $data['district'] ?? null,
        ];
        $user = $this->getUserModel()::create($newData);

        app()->bind(
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
            \Filament\Listeners\Auth\SendEmailVerificationNotification::class,
        );
        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }
    protected function detectLoginType(string $register): string
    {
        return filter_var($register, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
    }
}
