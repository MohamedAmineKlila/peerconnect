<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@peerconnect.test'],
            ['name' => 'PeerConnect Admin', 'role' => 'admin', 'password' => 'admin123']
        );

        collect([
            ['name' => 'Laravel', 'category' => 'Web', 'description' => 'Building MVC applications with Laravel.'],
            ['name' => 'Data Analysis', 'category' => 'BI', 'description' => 'Dashboards, reporting, and data-driven decisions.'],
            ['name' => 'UX Design', 'category' => 'Design', 'description' => 'Creating friendly interfaces for real users.'],
            ['name' => 'Machine Learning', 'category' => 'AI', 'description' => 'Introductory AI and prediction projects.'],
            ['name' => 'Project Management', 'category' => 'Professional Skills', 'description' => 'Planning, teamwork, and presentations.'],
        ])->each(fn ($data) => Interest::firstOrCreate(['name' => $data['name']], $data));

        collect([
            ['Yasmine Student', 'yasmine@student.peerconnect.test', 'student', 'Looking for a Laravel mentor', 'I am building my final web project and want feedback on the matching experience.', 'Business Intelligence', '2-LBC-BI', false, [1, 2, 5]],
            ['Rami Student', 'rami@student.peerconnect.test', 'student', 'Interested in dashboards and UX', 'I want to connect with teachers who can help me build a practical BI platform.', 'Business Information Systems', '2-LBC-BIS', false, [2, 3, 5]],
            ['Lina Student', 'lina@student.peerconnect.test', 'student', 'Need help with machine learning ideas', 'I am searching for guidance to choose a simple and useful AI project topic.', 'Data Science', 'L2', false, [2, 4, 5]],
            ['Anis Student', 'anis@student.peerconnect.test', 'student', 'Preparing a project presentation', 'I need a mentor who can help me organize features and explain the technical choices clearly.', 'Computer Science', '2-LBC-BI', false, [1, 5]],
            ['Nour Student', 'nour@student.peerconnect.test', 'student', 'Exploring UX for student apps', 'I want to learn how to make academic platforms easier and more pleasant to use.', 'Digital Design', '2-LBC-BIS', false, [3, 5]],
            ['Malek Student', 'malek@student.peerconnect.test', 'student', 'Building a data dashboard', 'I am looking for feedback on charts, KPIs, and database organization for a BI project.', 'Business Intelligence', 'L2', false, [2, 5]],
            ['Ines Student', 'ines@student.peerconnect.test', 'student', 'Searching for AI project guidance', 'I need help choosing a realistic machine learning topic with simple data and clear results.', 'Data Science', '2-LBC-BI', false, [2, 4]],
            ['Omar Student', 'omar@student.peerconnect.test', 'student', 'Laravel beginner looking for support', 'I want a mentor to review my controllers, validation, migrations, and Blade views.', 'Computer Science', 'L2', false, [1, 5]],
            ['Salma Student', 'salma@student.peerconnect.test', 'student', 'Interested in product presentation', 'I need help turning my project features into a clear story for the final presentation.', 'Business Information Systems', '2-LBC-BIS', false, [3, 5]],
            ['Fares Student', 'fares@student.peerconnect.test', 'student', 'Looking for database design advice', 'I want to improve my entity relationships and make my Laravel app data model stronger.', 'Computer Science', '2-LBC-BI', false, [1, 2]],
            ['Nadia Teacher', 'nadia.teacher@peerconnect.test', 'teacher', 'Laravel teacher available for mentoring', 'I help students structure Laravel projects with clean MVC, validation, and database relationships.', 'Computer Science', 'Teacher', true, [1, 3, 5]],
            ['Sami Teacher', 'sami.teacher@peerconnect.test', 'teacher', 'BI mentor for student projects', 'I guide students on dashboards, reporting, and practical business intelligence ideas.', 'Business Intelligence', 'Teacher', true, [2, 5]],
            ['Hanen Teacher', 'hanen.teacher@peerconnect.test', 'teacher', 'AI and data science project coach', 'I help students choose realistic machine learning projects and prepare strong presentations.', 'Data Science', 'Teacher', true, [2, 4, 5]],
            ['Meriem Teacher', 'meriem.teacher@peerconnect.test', 'teacher', 'UX and product mentor', 'I support students who want their web applications to feel useful, simple, and polished.', 'Digital Design', 'Teacher', true, [3, 5]],
            ['Walid Teacher', 'walid.teacher@peerconnect.test', 'teacher', 'Database and Eloquent mentor', 'I help students model relationships, write migrations, and use Eloquent clearly.', 'Computer Science', 'Teacher', true, [1, 2]],
            ['Amina Teacher', 'amina.teacher@peerconnect.test', 'teacher', 'Presentation and project coach', 'I help students prepare confident demos, project reports, and feature explanations.', 'Professional Skills', 'Teacher', true, [5]],
            ['Youssef Teacher', 'youssef.teacher@peerconnect.test', 'teacher', 'Dashboard design advisor', 'I mentor students building BI dashboards with useful metrics and readable layouts.', 'Business Intelligence', 'Teacher', true, [2, 3]],
            ['Rim Teacher', 'rim.teacher@peerconnect.test', 'teacher', 'Machine learning mentor', 'I help students keep AI projects practical, understandable, and presentation-ready.', 'Data Science', 'Teacher', true, [4, 5]],
            ['Tarek Teacher', 'tarek.teacher@peerconnect.test', 'teacher', 'Full-stack Laravel guide', 'I support students from database design to Blade pages, validation, and final deployment.', 'Web Development', 'Teacher', true, [1, 3, 5]],
            ['Sonia Teacher', 'sonia.teacher@peerconnect.test', 'teacher', 'User experience reviewer', 'I review student projects and suggest improvements to flows, labels, and interface clarity.', 'Digital Design', 'Teacher', true, [3, 5]],
        ])->each(function ($row) {
            [$name, $email, $role, $headline, $bio, $department, $level, $mentoring, $interestIds] = $row;

            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'role' => $role, 'password' => 'password']
            );

            $profile = Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'headline' => $headline,
                    'bio' => $bio,
                    'department' => $department,
                    'level' => $level,
                    'available_for_mentoring' => $mentoring,
                ]
            );

            $profile->interests()->sync($interestIds);
        });
    }
}
