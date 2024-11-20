<?php

namespace App\Filament\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Illuminate\Validation\ValidationException;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Support\Str;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // $this->getEmailFormComponent(),
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('User Name')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = filter_var(trim($data['name']), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $login_type => trim($data['name']),
            'password'  => trim($data['password']),
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.name' => __('valid name'),
        ]);
    }
}
