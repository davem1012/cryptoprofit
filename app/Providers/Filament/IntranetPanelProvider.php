<?php

namespace App\Providers\Filament;

use App\Models\User;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

use Filament\Widgets;
use App\Filament\Intranet\Widgets as IntranetWidgets;
use App\Livewire as LivewireWidgets;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


use Jeffgreco13\FilamentBreezy\BreezyCore;
use Yebor974\Filament\RenewPassword\RenewPasswordPlugin;




use Illuminate\Support\Facades\Hash;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use DutchCodingCompany\FilamentSocialite\Provider;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use Illuminate\Contracts\Auth\Authenticatable;

class IntranetPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('intranet')
            ->path('intranet')
            ->login()
            ->registration()
            ->passwordReset()
            ->emailVerification()
            //->profile()
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Intranet/Resources'), for: 'App\\Filament\\Intranet\\Resources')
            ->discoverPages(in: app_path('Filament/Intranet/Pages'), for: 'App\\Filament\\Intranet\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            //->discoverWidgets(in: app_path('Filament/Intranet/Widgets'), for: 'App\\Filament\\Intranet\\Widgets')
            ->widgets([
                //Widgets\FilamentInfoWidget::class,
                IntranetWidgets\PredictionChart::class,
                IntranetWidgets\HistoricFearGreedIndexChart::class,
                //LivewireWidgets\ChartFearGreed::class
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                BreezyCore::make()
                    /* ->enableSanctumTokens(
                        permissions: ["create", "view", "update", "delete"] // optional, customize the permissions (default = ["create", "view", "update", "delete"])
                    ) */
                    ->myProfile(
                        shouldRegisterUserMenu: true, // Sets the 'account' link in the panel User Menu (default = true)
                        shouldRegisterNavigation: true, // Adds a main navigation item for the My Profile page (default = false)
                        navigationGroup: 'Settings', // Sets the navigation group for the My Profile page (default = null)
                        hasAvatars: true, // Enables the avatar upload form component (default = false)
                        slug: 'my-profile' // Sets the slug for the profile page (default = 'my-profile')
                    )
            )
            ->plugin(
                RenewPasswordPlugin::make()
                    ->timestampColumn('last_renew_password_at')
                    ->passwordExpiresIn(days: 15),
            )

            ->plugin(
                FilamentSocialitePlugin::make()
                    // (required) Add providers corresponding with providers in `config/services.php`.
                    ->providers([
                        // Create a provider 'gitlab' corresponding to the Socialite driver with the same name.
                        Provider::make('google')
                            ->label('Google')
                            ->icon('fab-google')
                            ->color(Color::Green)
                            ->outlined(false)
                            ->stateless(false)
                        #->scopes(['...'])
                        #->with(['...']),
                    ])
                    // (optional) Enable/disable registration of new (socialite-) users.
                    ->registration(true)
                    // (optional) Enable/disable registration of new (socialite-) users using a callback.
                    // In this example, a login flow can only continue if there exists a user (Authenticatable) already.
                    //->registration(fn (string $provider, SocialiteUserContract $oauthUser, ?Authenticatable $user) => (bool) $user)
                    // (optional) Change the associated model class.
                    ->userModelClass(\App\Models\User::class)
                    // (optional) Change the associated socialite class (see below).
                    //->socialiteUserModelClass(\App\Models\SocialiteUser::class)
                    ->createUserUsing(function (string $provider, SocialiteUserContract $oauthUser, FilamentSocialitePlugin $plugin) {
                        return User::create([
                            'name' => $oauthUser->getName(),
                            'email' => $oauthUser->getEmail(),
                            'password' => null,
                            'email_verified_at' => now(),
                            'password' => Hash::make(now()),
                        ]);
                    })

            )
            ->plugin(
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            );
    }
}
