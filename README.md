# Laravel Login Core

The Laravel Login Core package (`devinci-it/login-core`) offers essential features for any Laravel application, including a standard login and registration system.

## Installation

To install the package, utilize Composer:

```bash
composer require devinci-it/login-core
```

## Usage

After installing the package, employ the provided Artisan command to set up the login and registration system:

```bash
php artisan login:setup
```

This command will publish necessary files and load routes for the login and registration system.

## Features

The package provides the following features:

- A standard login and registration system.
- Essential service providers for your Laravel application.
- Essential controllers: `DashboardController` and `UserAccessControl`.
- Essential models: `User`.
- Essential repositories: `BaseRepository` and `UserRepository`.
- Essential requests: `LoginRequest` and `RegistrationRequest`.
- Essential views for the login and registration system.

## Contributing

Contributions are welcomed. Please open an issue or create a PR if you'd like to contribute.

Note: When editing the README, adhere to the [standard-readme](https://github.com/RichardLitt/standard-readme) specification.

## License

This project is licensed under the [MIT](http://opensource.org/licenses/MIT) license.
