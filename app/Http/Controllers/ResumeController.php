<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ResumeController extends Controller
{
    /**
     * Display the main resume page
     */
    public function index()
    {
        $data = [
            'name' => 'Marc Santiago',
            'jobTitle' => 'Third Year BS Computer Science Student',
            'email' => 'santiagomarcstephen@gmail.com',
            'phone' => '+63 9123456789',
            'location' => 'Calamba, Laguna',
            'github' => 'https://github.com/santiagomarc',
            'username' => Session::get('username'),
            'loginTime' => Session::get('login_time'),
            'skills' => $this->getSkills(),
            'experience' => $this->getExperience(),
            'education' => $this->getEducation(),
            'projects' => $this->getProjects(),
        ];

        return view('resume.index', $data);
    }

    /**
     * Display contact page
     */
    public function contact()
    {
        return view('resume.contact', [
            'username' => Session::get('username')
        ]);
    }

    /**
     * Handle contact form submission
     */
    public function sendMessage(Request $request)
    {
        // Validate contact form input
        $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000|min:10',
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 2 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Message is required.',
            'message.min' => 'Message must be at least 10 characters.',
        ]);

        // Save message to storage
        $messageData = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'timestamp' => now(),
            'user_session' => Session::get('username')
        ];

        $this->saveMessage($messageData);

        return response()->json([
            'success' => true,
            'message' => 'Thank you, ' . $request->name . '! Your message has been sent successfully.'
        ]);
    }

    /**
     * Get skills data organized by category
     */
    private function getSkills()
    {
        return [
            'Frontend Development' => [
                ['name' => 'HTML5 & CSS3', 'level' => 80],
                ['name' => 'JavaScript', 'level' => 75],
                ['name' => 'Dart & Flutter', 'level' => 70],
                ['name' => 'Bootstrap', 'level' => 80]
            ],
            'Backend Development' => [
                ['name' => 'PHP', 'level' => 80],
                ['name' => 'Laravel Framework', 'level' => 70],
                ['name' => 'MySQL/PostgreSQL', 'level' => 90],
                ['name' => 'RESTful APIs', 'level' => 75]
            ],
            'Tools & Technologies' => [
                ['name' => 'Git & GitHub', 'level' => 90],
                ['name' => 'VS Code', 'level' => 95],
                ['name' => 'Composer', 'level' => 80],
                ['name' => 'XAMPP/PGAdmin', 'level' => 75],
                ['name' => 'Responsive Design', 'level' => 85]
            ],
            'Programming Languages' => [
                ['name' => 'Python', 'level' => 95],
                ['name' => 'Java', 'level' => 75],
                ['name' => 'C#', 'level' => 70],
                ['name' => 'C++', 'level' => 75]
            ]
        ];
    }

    /**
     * Get work experience data
     */
    private function getExperience()
    {
        return [
            [
                'title' => 'Full Stack Developer',
                'company' => 'TechCorp Solutions',
                'period' => 'January 2023 - Present',
                'duties' => [
                    'Developed responsive web applications using Laravel and React.js',
                    'Collaborated with cross-functional teams to deliver high-quality software solutions',
                    'Implemented RESTful APIs and integrated third-party services',
                    'Optimized database queries resulting in 40% improvement in application performance'
                ]
            ],
            [
                'title' => 'Web Development Intern',
                'company' => 'WebStart Agency',
                'period' => 'June 2022 - December 2022',
                'duties' => [
                    'Assisted in building client websites using PHP, HTML, CSS, and JavaScript',
                    'Learned version control best practices using Git and GitHub',
                    'Participated in code reviews and agile development processes',
                    'Contributed to documentation and testing of web applications'
                ]
            ]
        ];
    }

    /**
     * Get education data
     */
    private function getEducation()
    {
        return [
            [
                'degree' => 'Bachelor of Science in Computer Science',
                'school' => 'Batangas State University',
                'period' => '2023 - 2027 (Expected)',
                'details' => 'Relevant Coursework: Data Structures, Web Development, Database Systems, Software Engineering'
            ],
            [
                'degree' => 'Senior High School - STEM Track',
                'school' => 'Philippine Christian University - Dasmarinas',
                'period' => '2021 - 2023',
                'details' => 'Graduated with High Honors'
            ]
        ];
    }

    /**
     * Get projects data
     */
    private function getProjects()
    {
        return [
            [
                'id' => 1,
                'title' => 'Laravel Portfolio with Authentication',
                'description' => 'A professional portfolio website built with Laravel framework featuring user authentication, responsive design, and dynamic content management.',
                'technologies' => ['Laravel', 'PHP', 'PostgreSQL', 'Blade', 'CSS3']
            ],
            [
                'id' => 2,
                'title' => 'Enhanced K-Means Clustering Algorithm',
                'description' => 'Research project implementing a distance-based soft weighting mechanism for noise-handling in K-Means algorithm using Gaussian RBF weighted influence.',
                'technologies' => ['Python', 'NumPy', 'Scikit-learn', 'Matplotlib']
            ],
            [
                'id' => 3,
                'title' => 'Nutrition-Based Food Ordering System',
                'description' => 'Console application with GUI built using Java and MySQL, featuring nutritional information tracking and user-friendly ordering interface.',
                'technologies' => ['Java', 'MySQL', 'JDBC']
            ]
        ];
    }

    /**
     * Save contact message to storage
     */
    private function saveMessage($data)
    {
        $logEntry = json_encode($data) . "\n";
        $logFile = storage_path('app/contact_messages.log');
        file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}