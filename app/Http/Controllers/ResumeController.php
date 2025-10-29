<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;

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

    // ===== NEW METHODS FOR ACTIVITY 3 =====

    /**
     * Display dashboard (resume view with edit button)
     * Route: /dashboard (protected)
     */
    public function dashboard()
    {
        // Get the logged-in user from database (assuming first user is admin)
        $user = User::first(); // or User::where('name', Session::get('username'))->first();
        
        // Get or create profile if it doesn't exist
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.dashboard', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    /**
     * Show edit form for resume
     * Route: /profile/edit (protected)
     */
    public function edit()
    {
        $user = User::first();
        
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.edit', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    /**
     * Update resume data in database
     * Route: POST /profile/update (protected)
     */
    public function update(Request $request)
    {
        // Get the logged-in user from database
        $user = User::first();
        
        // Validate input
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
        ]);

        // Update or create profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('dashboard')
            ->with('success', 'Resume updated successfully!');
    }

    /**
     * Display public resume view (no login required)
     * Route: GET /resume/{id}
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $profile = $user->profile ?? Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
        ]);
        
        $experiences = $user->experiences()->get();
        $education = $user->education()->get();
        $projects = $user->projects()->orderBy('start_date', 'desc')->get();
        $skills = $user->skills()->get();
        
        return view('resume.public', compact('user', 'profile', 'experiences', 'education', 'projects', 'skills'));
    }

    // ===== SKILL CRUD METHODS =====

    /**
     * Store a new skill
     * Route: POST /skills
     */
    public function storeSkill(Request $request)
    {
        $user = User::first(); 
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill = Skill::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'category' => $validated['category'],
            'proficiency_level' => $validated['proficiency_level'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully',
            'skill' => $skill
        ]);
    }

    /**
     * Update an existing skill
     * Route: PUT /skills/{id}
     */
    public function updateSkill($id, Request $request)
    {
        $skill = Skill::findOrFail($id);
        
        // Make sure skill belongs to current user
        $user = User::first();
        if ($skill->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'proficiency_level' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully',
            'skill' => $skill
        ]);
    }

    /**
     * Delete a skill
     * Route: DELETE /skills/{id}
     */
    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        
        // Make sure skill belongs to current user
        $user = User::first();
        if ($skill->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully'
        ]);
    }

    
    // ===== EXPERIENCE CRUD METHODS =====

    /**
     * Store a new work experience
     * Route: POST /experiences
     */
    public function storeExperience(Request $request)
    {
        $user = User::first(); // Get logged-in user
        
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience = Experience::create([
            'user_id' => $user->id,
            'job_title' => $validated['job_title'],
            'company_details' => $validated['company_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experience added successfully',
            'experience' => $experience
        ]);
    }

    /**
     * Update an existing work experience
     * Route: PUT /experiences/{id}
     */
    public function updateExperience($id, Request $request)
    {
        $experience = Experience::findOrFail($id);
        
        // Make sure experience belongs to current user
        $user = User::first();
        if ($experience->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_details' => 'required|string|max:500',
            'description' => 'nullable|string|max:2000',
        ]);

        $experience->update([
            'job_title' => $validated['job_title'],
            'company_details' => $validated['company_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Experience updated successfully',
            'experience' => $experience
        ]);
    }

        /**
     * Delete a work experience
     * Route: DELETE /experiences/{id}
     */
    public function deleteExperience($id)
    {
        $experience = Experience::findOrFail($id);
        
        // Make sure experience belongs to current user
        $user = User::first();
        if ($experience->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $experience->delete();

        return response()->json([
            'success' => true,
            'message' => 'Experience deleted successfully'
        ]);
    }

    // ===== EDUCATION CRUD METHODS =====

    /**
     * Update education entry
     * Route: PUT /education/{id}
     */
    public function updateEducation(Request $request, $id)
    {
        $education = Education::findOrFail($id);
        
        // Make sure education belongs to current user
        $user = User::first();
        if ($education->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'school_details' => 'required|string|max:500',
            'description' => 'nullable|string',
        ]);

        $education->update([
            'degree' => $validated['degree'],
            'school_details' => $validated['school_details'],
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Education updated successfully',
            'education' => $education
        ]);
    }
}