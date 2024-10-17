## My New Deployed URL -: https://jasminewhitehouse.com/

# Secure Login Application (GAHDSE232F-026)

## Project Overview

This project is a Secure Login Application that implements Authentication, Authorization, and Accounting (AAA) using PHP and MySQL. The application follows the MVC architecture and is built without any PHP frameworks. Composer is used for dependency management, and security features include encryption, MFA TOTP, salted password hashing, and secure session handling.

## Features

- Secure user authentication and authorization
- Role-based access control (RBAC) for admin and users
- Password hashing with  salt and pepper
- Secure session management
- Protection against SQL injection using parameterized queries
- Admin dashboard with the ability to promote users to admin
- User registration and login functionality
- Timestamps for user logins and activity tracking

## Directory Structure

```
.
├── app
│   ├── controllers
│   │   ├── AuthController.php
│   │   ├── AdminController.php
│   │   └── UserController.php
│   ├── models
│   │   ├── User.php
│   │   └── Admin.php
│   ├── views
│   │   ├── register.php
│   │   ├── login.php
│   │   ├── admin_dashboard.php
│   │   ├── user_dashboard.php
│   │   └── admin_profile.php
│   └── partials
│       ├── header.php
│       └── footer.php
├── config
│   └── database.php
├── public
│   ├── css
│   │   └── styles.css
│   ├── js
│   ├── images
│   ├── index.php
│   ├── process_login.php
│   ├── process_register.php
│   └── logout.php
├── vendor
├── composer.json
├── composer.lock
├── .env
└── README.md
```

## Getting Started

### Prerequisites

- PHP 8.0 or higher
- WAMPServer (or any local server with PHP and MySQL support)
- Composer for dependency management
- A MySQL database setup (Database name: `aaa_system`)

### Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/NipunaMadula/Secure-Login-Application-GAHDSE232F-026.git
   ```

2. **Install dependencies using Composer:**

   ```bash
   composer install
   ```

3. **Set up environment variables:**

   Create a `.env` file in the root directory with the following details:

   ```env
   DB_HOST=localhost
   DB_NAME=aaa_system
   DB_USER=root
   DB_PASS=
   ```

4. **Run database migrations:**

   Import the `aaa_system.sql` file into your MySQL database to create the necessary tables.

5. **Start the application:**

   Access the project via your local server (e.g., `http://localhost/Secure-Login-Application-GAHDSE232F-026/public/index.php`).

### Usage

- **Register as a user**: Visit the registration page to create an account. The first user to register will automatically be assigned as an admin.
- **Login as admin or user**: Depending on the credentials, users will be redirected to their respective dashboards.
- **Admin functionalities**: Admin users can promote other users to admin and view all registered users.

## Security Features

- **Password Hashing**: Passwords are hashed using SHA256 with a random salt and pepper to increase security.
- **Encryption**: Sensitive data is encrypted before storage.
- **MFA TOTP**: Multi-factor authentication using time-based one-time passwords (TOTP) adds an extra layer of security.
- **Secure Sessions**: Sessions are managed securely, and session IDs are regenerated frequently.
- **Parameterized Queries**: SQL injection is prevented through the use of parameterized queries.

## Future Enhancements

- Add email verification for user registration
- Implement password recovery functionality
- Improve user dashboard with activity logs


## GitHub URL

[Secure Login Application Repository](https://github.com/NipunaMadula/Secure-Login-Application-GAHDSE232F-026)

## Deployed URL

 https://dev.mysql.com/doc/

## Contribution Guidelines

- Fork the repository
- Create a new branch (`git checkout -b feature/your-feature-name`)
- Commit your changes (`git commit -m 'Add new feature'`)
- Push to the branch (`git push origin feature/your-feature-name`)
- Create a new Pull Request

## License

This project is open-source and available under the [MIT License](LICENSE).

