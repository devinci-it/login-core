
# Laravel Login Core

Laravel Login Core is a Laravel package designed to streamline the integration of standard login and registration systems into Laravel applications. Whether you're a novice or an experienced developer, this package aims to simplify the setup process, allowing you to focus on building your application's core features.

## Installation

To install the package, use Composer:

```bash
composer require devinci-it/login-core
```

Once installed, run the following Artisan command to set up the login and registration system:

```bash
php artisan login:setup
```

This command will publish necessary files and load routes for the login and registration system.

## Features

- Standard login and registration system.
- Essential service providers for seamless integration.
- Essential controllers: DashboardController and UserAccessControl.
- Essential models: User.
- Essential repositories: BaseRepository and UserRepository.
- Essential requests: LoginRequest and RegistrationRequest.
- Pre-built views for the login and registration system.

## Usage

After installation, integrate the login and registration system into your Laravel application as needed.

## Contributing

Contributions are welcome! If you have suggestions for improvements or would like to contribute code, please open an issue or create a pull request on our GitHub repository.

## License

This project is licensed under the MIT license.
