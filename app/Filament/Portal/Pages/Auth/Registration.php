<?php

namespace App\Filament\Portal\Pages\Auth;

use App\Models\Batch;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                $this->getCollegeFormComponent(),
                Select::make('gender')->label('Select Gender')
                    ->options(['male' => 'Male','female' => 'Female'])->required(),
                $this->getBatchFormComponent(),
                $this->getDivisionFormComponent(),
                $this->getDistrictFormComponent(),
                Select::make('upazila')
                    ->label('Select Upazila')
                    ->reactive()
                    ->options(function (callable $get, callable $set) {
                        return getUpazila($get('district_id'));
                    }),
                Select::make('postOffice')
                    ->label('Select post Office')
                    ->reactive()
                    ->options(function (callable $get, callable $set) {
                        return getPostOffices($get('upazila'));
                    }),
                Select::make('postCode')
                    ->label('Select post Code')
                    ->reactive()
                    ->options(function (callable $get, callable $set) {
                        return getPostCodes($get('upazila'));
                    }),
            ])
            ->columns([
                'default' => 1,
                'sm' => 2,
                'md' => 2,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2,
            ])
            ->statePath('data');
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Full name')
            ->required()->columnSpan(2);
    }
    protected function getRegisterFormComponent(): Component
    {
        return TextInput::make('register')
            ->label('Email or Phone Number')
            ->required()
            ->autocomplete()->columnSpan(2)
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
        return Select::make('batch')
            ->label('Select Batch')
            ->options(Batch::all()->pluck('name','id'))
            ->placeholder('Optional');
    }
    protected function getCollegeFormComponent(): Component
    {
        return TextInput::make('college')
            ->label('College')
            ->placeholder('Optional')->columnSpan(2);
    }
    protected function getDivisionFormComponent(): Component
    {
        return
            Select::make('division_id')
                ->label('Select Division')
                ->searchable()
                ->options(getDivisionOptions())
                ->reactive()->columnSpanFull();
    }
    protected function getDistrictFormComponent(): Component
    {
        return
            Select::make('district_id')
                ->label('Select District')
                ->reactive()
                ->options(function (callable $get, callable $set) {
                    return getDistrictOptions($get('division_id'));
                });

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
            'gender'          => $data['gender'] ?? null,
            'batch'           => $data['batch'] ?? null,
            'college'         => $data['college'] ?? null,
            'division_id'     => $data['division_id'] ?? null,
            'district_id'     => $data['district_id'] ?? null,
            'upazila'         => $data['upazila'] ?? null,
            'postOffice'      => $data['postOffice'] ?? null,
            'postCode'        => $data['postCode'] ?? null,
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
