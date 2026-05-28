# PeerConnect

PeerConnect is a Laravel student-teacher matching website inspired by Tinder. Students and teachers can be represented with searchable profiles, interests, connection statuses, messages, and contact requests.
Key Technologies: Laravel, PHP, MySQL, Blade Templates, JavaScript

## Features

- Home, about, and contact pages
- MVC structure with routes, controllers, models, and Blade views
- CRUD for profiles, interests, connections, messages, and contact messages
- Eloquent relationships:
  - User has one Profile
  - Profile belongs to many Interests
  - Connection belongs to sender and receiver Users
  - Connection has many Messages
- Server-side form validation
- Search and pagination on list pages
- Tinder-like dashboard with one profile card, like/pass actions, and matches
- Profile photo upload support with Laravel storage
- Seed data for a ready-to-present demo

## Run With XAMPP

The project is intended to live in:

```text
C:\xampp\htdocs\peerconnect
```

From that folder, run:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

If you use Apache directly, point the browser to the Laravel `public` folder:

```text
http://localhost/peerconnect/public
```

## Real Use

Students and teachers should create their own accounts from:

```text
http://127.0.0.1:8000/register
```

After registration, each user completes their own profile and uses the dashboard to swipe, receive likes, like back, and match.

The seed data only creates starter interest categories. It does not create fake users, fake profiles, fake likes, or fake messages.
