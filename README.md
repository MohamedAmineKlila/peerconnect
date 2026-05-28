# PeerConnect

> A Laravel-based social networking platform that connects students by skills, interests, and availability — enabling profile discovery, peer matching, and real-time messaging.

---

## Table of Contents

- [About the Project](#about-the-project)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Usage](#usage)
---

## About the Project

PeerConnect was built to solve a common problem in academic environments: students struggling to find peers with complementary skills for projects, study groups, or collaborations. The platform allows users to create rich profiles, discover others based on skills and interests, send connection requests, and communicate through a built-in messaging system.

---

## Features

- **User Profiles** — Create detailed profiles with skills, bio, and profile photo
- **Peer Discovery** — Browse and search users by skills or interests
- **Connection System** — Send, accept, and manage connection requests
- **Messaging** — Direct messaging between connected users
- **Photo Uploads** — Profile picture upload and management
- **Pagination** — Efficient browsing of large user lists
- **Database Seeding** — Pre-loaded sample data for easy demo setup
- **Test Suite** — Automated tests for core functionality

---

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| PHP 8+ | Backend language |
| Laravel | MVC web framework |
| MySQL | Relational database |
| Blade | Server-side templating engine |
| JavaScript | Frontend interactivity |
| CSS | Styling and layout |
| Composer | PHP dependency management |

---

## Project Structure

```
peerconnect/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Request handling logic
│   │   └── Middleware/         # Auth and request filters
│   └── Models/                 # Eloquent ORM models
├── database/
│   ├── migrations/             # Database schema definitions
│   └── seeders/                # Sample data seeders
├── resources/
│   └── views/                  # Blade template files
├── routes/
│   └── web.php                 # Application routes
├── tests/                      # Automated test cases
├── docs/                       # Project documentation
└── README.md
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- MySQL
- Node.js & npm (for frontend assets)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/MohamedAmineKlila/peerconnect.git
   cd peerconnect
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install && npm run dev
   ```

4. Set up environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Configure your database in `.env`:
   ```
   DB_DATABASE=peerconnect
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

6. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. Visit `http://localhost:8000` in your browser.

---

## Usage

1. **Register** a new account or log in with seeded credentials
2. **Complete your profile** — add skills, bio, and a profile photo
3. **Discover peers** — browse users or search by skill/interest
4. **Connect** — send connection requests to other users
5. **Message** — chat with your connections directly

---

## Running Tests

```bash
php artisan test
```

---

## License

This project is licensed under the Apache License 2.0 — see the [LICENSE](LICENSE) file for details.
