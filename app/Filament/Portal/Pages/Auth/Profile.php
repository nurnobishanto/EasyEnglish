<?php

namespace App\Filament\Portal\Pages\Auth;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Panel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class Profile extends Page
{

    protected static string $view = 'filament.portal.pages.profile';
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 1;

    public $user_id;
    public $name;
    public $email;
    public $phone_number;

    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $division_id;

    public function mount()
    {
        $this->form->fill([
            'user_id' => auth()->user()->user_id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'division_id' => auth()->user()->division_id,
            'phone_number' => auth()->user()->phone_number,
        ]);
    }
    public function submit()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
            'phone_number' => [
                'required',
                'string',
                'unique:users,phone_number,' . auth()->id(),
            ],
            'new_password' => 'nullable|string|min:8|confirmed',
        ];

        // Add validation rule for current_password only if new_password is not null
        if ($this->new_password !== null) {
            $rules['current_password'] = 'required|string|min:8';
        }

        $this->validate($rules);
        $state = array_filter([
            'user_id' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'division_id' => $this->division_id,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
        ]);

        $user = auth()->user();

        $user->update($state);

        if ($this->new_password) {
            $this->updateSessionPassword($user);
        }

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
    protected function updateSessionPassword($user)
    {
        request()->session()->put([
            'password_hash_' . auth()->getDefaultDriver() => $user->getAuthPassword(),
        ]);
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    TextInput::make('user_id')
                        ->required()
                        ->disabled()
                        ->label('User ID'),
                    TextInput::make('name')
                        ->label('Full Name')
                        ->placeholder('Enter Full Name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->placeholder('Enter Valid Email Address')
                        ->unique('users,email')
                        ->email(),
                    TextInput::make('phone_number')
                        ->label('Phone Number Address')
                        ->placeholder('Enter Valid Phone number')
                        ->required()
                        ->unique('users,phone_number')
                        ->tel(),
                    Select::make('division_id')
                        ->label('Select Division')
                        ->searchable()
                        ->options(getDivisionOptions())
                        ->reactive(),

                    Select::make('district_id')
                        ->label('Select District')
                        ->reactive()
                        ->options(function (callable $get, callable $set) {
                            return getDistrictOptions($get('division_id'));
                        }),

                ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}
