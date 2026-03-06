<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'company' => 'Tech Solutions Inc',
                'location' => 'Dhaka, Bangladesh',
                'category' => 'Software Development',
                'description' => 'We are looking for an experienced Full Stack Developer to join our growing team. The ideal candidate will have strong experience with React, Node.js, and modern web technologies. You will be responsible for developing and maintaining web applications, collaborating with cross-functional teams, and ensuring high-quality code delivery.',
            ],
            [
                'title' => 'UI/UX Designer',
                'company' => 'Creative Studio',
                'location' => 'Remote',
                'category' => 'Design',
                'description' => 'Join our creative team as a UI/UX Designer. We are looking for someone passionate about creating intuitive and beautiful user experiences. You will work on various projects, from mobile apps to web platforms, and collaborate closely with developers and product managers.',
            ],
            [
                'title' => 'DevOps Engineer',
                'company' => 'Cloud Systems Ltd',
                'location' => 'Chittagong, Bangladesh',
                'category' => 'DevOps',
                'description' => 'We are seeking a skilled DevOps Engineer to help us build and maintain our infrastructure. Experience with AWS, Docker, Kubernetes, and CI/CD pipelines is required. You will be responsible for automation, monitoring, and ensuring system reliability.',
            ],
            [
                'title' => 'Frontend Developer',
                'company' => 'Digital Agency',
                'location' => 'Dhaka, Bangladesh',
                'category' => 'Software Development',
                'description' => 'Looking for a talented Frontend Developer with expertise in React.js and modern CSS frameworks. You will be working on exciting client projects, creating responsive and performant web applications. Strong attention to detail and design sense is a must.',
            ],
            [
                'title' => 'Project Manager',
                'company' => 'Qtec Solution Limited',
                'location' => 'Dhaka, Bangladesh',
                'category' => 'Management',
                'description' => 'We are hiring an experienced Project Manager to lead our software development projects. You will be responsible for project planning, team coordination, client communication, and ensuring timely delivery of high-quality solutions. PMP certification is a plus.',
            ],
            [
                'title' => 'Data Scientist',
                'company' => 'Analytics Corp',
                'location' => 'Remote',
                'category' => 'Data Science',
                'description' => 'Join our data team as a Data Scientist. We are looking for someone with strong statistical analysis skills and experience with Python, R, and machine learning frameworks. You will work on analyzing large datasets, building predictive models, and deriving actionable insights.',
            ],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
