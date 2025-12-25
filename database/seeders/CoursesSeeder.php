<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a doctor user
        $doctor = User::where('type', User::TYPE_DOCTOR)->first();
        
        if (!$doctor) {
            $doctor = User::create([
                'name' => 'Dr. Sahar Aslam',
                'email' => 'doctor@pgifm.com',
                'password' => bcrypt('password'),
                'type' => User::TYPE_DOCTOR,
            ]);
        }

        $courses = [
            // 1. MCPS Family Medicine
            [
                'user_id' => $doctor->id,
                'title' => 'MCPS Family Medicine',
                'subtitle' => 'Postgraduate Qualification (Experience-Based Pathway)',
                'description' => 'MCPS in Family Medicine (on experience-based pathway) is a postgraduate qualification offered by the College of Physicians and Surgeons Pakistan (CPSP) to certify doctors as specialists in family medicine.',
                'program_overview' => 'MCPS in Family Medicine (on experience-based pathway) is a postgraduate qualification offered by the College of Physicians and Surgeons Pakistan (CPSP) to certify doctors as specialists in family medicine. The program includes both written (MCQs) and practical components (TOACS) and requires eligibility criteria such as an MBBS degree, a house job, and postgraduate training. It aims to enhance the skills of doctors to handle the full spectrum of community health issues.',
                'awarding_body' => 'College of Physicians and Surgeons Pakistan (CPSP)',
                'goal' => 'To produce competent family physicians who can manage both chronic and acute illnesses in the community',
                'examination_components' => [
                    'Written Exam: Includes two papers with multiple-choice questions (MCQs)',
                    'Practical Exam: A series of TOACS (Task-Oriented Assessment of Clinical Skills) stations that assess clinical skills through interactive scenarios'
                ],
                'eligibility_criteria' => [
                    'MBBS Degree',
                    'A one-year PMDC approved house job',
                    'Valid PMDC/PMC registration',
                    '3-5 years of clinical/teaching experience'
                ],
                'mandatory_workshops' => [
                    'Basic Surgical Skills',
                    'BLS (Basic Life Support)',
                    'Communication Skills',
                    'Introduction to Computer and Internet'
                ],
                'course_modules' => [
                    'CVS',
                    'Endocrinology',
                    'Musculoskeletal',
                    'Gyne & Obs',
                    'Child Health',
                    'Infection Diseases',
                    'Mental Health',
                    'Pulmonology',
                    'ENT',
                    'G. Surgery',
                    'Dermatology',
                    'Neurology',
                    'Eye',
                    'Gastroenterology'
                ],
                'icon_class' => 'fa-graduation-cap',
                'is_active' => true,
            ],

            // 2. MRCGP [INT] South Asia
            [
                'user_id' => $doctor->id,
                'title' => 'MRCGP [INT] South Asia',
                'subtitle' => 'International Membership Examination',
                'description' => 'The MRCGP [INT] South Asia is the International Membership examination of the Royal College of General Practitioners (RCGP), London, for the South Asia region.',
                'qualification_purpose' => 'The MRCGP [INT] South Asia is the International Membership examination of the Royal College of General Practitioners (RCGP), London, for the South Asia region (Bangladesh, India, Pakistan, and Sri Lanka). It is designed to drive learning and establish a high standard of Family Medicine/General Practice within the region, reflecting local epidemiology and medical practices.',
                'goal' => 'The qualification aims to elevate the expertise of General Practitioners in South Asia, where structured postgraduate training in Family Medicine has historically been limited',
                'examination_structure' => "The examination consists of two parts, which must be passed within six years of passing Part 1:\n\n1. Applied Knowledge Test (AKT) - Part 1\nA computer-based, 200-question multiple-choice paper in single best answer format. It is a summative assessment of the knowledge base underpinning independent general practice in South Asia. The exam is held twice a year, typically in May and November, at Pearson VUE test centers in locations such as Karachi, Abu Dhabi, and Jeddah.\n\n2. Objective Structured Clinical Examination (OSCE) - Part 2\nA clinical assessment with 14 active stations, each 10 minutes long, testing clinical, communication, and practical skills. Candidates must pass Part 1 to be eligible for Part 2. The OSCE is held two to 4 times a year, in different locations such as Karachi, Colombo and Chennai.",
                'eligibility_criteria' => [
                    'Completion of an accredited two-year training program, or',
                    'A minimum of five years\' clinical experience with at least three years in Family Medicine/General Practice'
                ],
                'eligibility_attempts' => 'Note: Internship/house job experience is not counted towards this clinical experience.',
                'course_modules' => [
                    'CVS',
                    'Endocrinology',
                    'Musculoskeletal',
                    'Gyne & Obs',
                    'Child Health',
                    'Infection Diseases',
                    'Mental Health',
                    'Pulmonology',
                    'ENT',
                    'G. Surgery',
                    'Dermatology',
                    'Neurology',
                    'Eye',
                    'Gastroenterology'
                ],
                'icon_class' => 'fa-certificate',
                'is_active' => true,
            ],

            // 3. MCPS Family Medicine TOACS
            [
                'user_id' => $doctor->id,
                'title' => 'MCPS Family Medicine TOACS',
                'subtitle' => 'Task-Oriented Assessment of Clinical Skills',
                'description' => 'The MCPS Family Medicine TOACS is the practical, clinical skills assessment part of the Membership of the College of Physicians and Surgeons Pakistan (CPSP) examination in Family Medicine.',
                'program_overview' => 'The MCPS Family Medicine TOACS is the practical, clinical skills assessment part of the Membership of the College of Physicians and Surgeons Pakistan (CPSP) examination in Family Medicine. It typically consists of 12 stations designed to assess candidates\' real-life clinical skills through interactive tasks with observers and patients.',
                'examination_components' => [
                    'Written Exam: Multiple-choice question (MCQ) paper',
                    'Practical Exam (TOACS): Task-Oriented Assessment of Clinical Skills'
                ],
                'examination_structure' => 'Full MCPS Exam Components:\n\nWritten Exam: Multiple-choice question (MCQ) paper\nPractical Exam (TOACS): Task-Oriented Assessment of Clinical Skills\n\nPassing Requirement: Candidates must score a minimum of 60% in all components to pass.',
                'skills_assessed' => [
                    'History taking skills',
                    'Physical examination skills',
                    'Communication skills (breaking bad news, dealing with angry patients)',
                    'Counselling skills',
                    'Interpretation of laboratory investigations and X-rays',
                    'Spot diagnosis (e.g., skin diseases)',
                    'Use of clinical equipment'
                ],
                'icon_class' => 'fa-stethoscope',
                'is_active' => true,
            ],

            // 4. MRCGP [INT] South Asia OSCE
            [
                'user_id' => $doctor->id,
                'title' => 'MRCGP [INT] South Asia OSCE',
                'subtitle' => 'Objective Structured Clinical Examination',
                'description' => 'The MRCGP [INT] South Asia Objective Structured Clinical Examination (OSCE) is the second part of the International Membership examination for the Royal College of General Practitioners (RCGP).',
                'program_overview' => 'The MRCGP [INT] South Asia Objective Structured Clinical Examination (OSCE) is the second part of the International Membership examination for the Royal College of General Practitioners (RCGP), a clinical assessment for family medicine specialists in the South Asia region.',
                'examination_details' => "Format: The OSCE consists of 14 active, 10-minute stations and a few rest stations\nSkills Tested: Each station tests a range of clinical, communication, and practical skills, including clinical reasoning and evidence-based practice\nTiming: The exam is typically held twice a year, with a regular venue in Karachi, Pakistan, and another in Colombo, Sri Lanka, and Chennai, India",
                'eligibility_attempts' => "Eligibility: Candidates must pass Part 1 (Applied Knowledge Test) before they can apply for the Part 2 OSCE. Specific clinical experience criteria may also apply depending on the candidate's initial application route\n\nAttempts: Candidates have up to three attempts to pass the Part 2 OSCE after passing Part 1. Both parts must be passed within six years of passing Part 1",
                'icon_class' => 'fa-clipboard-check',
                'is_active' => true,
            ],

            // 5. MCPS + MRCGP INT Success Revision Camp
            [
                'user_id' => $doctor->id,
                'title' => 'MCPS + MRCGP INT Success Revision Camp',
                'subtitle' => 'Focused 4-Class Revision Camp',
                'description' => 'A focused 4-class revision camp designed to prepare candidates for the MCPS Family Medicine and MRCGP INT South Asia exams.',
                'program_overview' => 'A focused 4-class revision camp designed to prepare candidates for the MCPS Family Medicine and MRCGP INT South Asia exams. This program provides high-yield coverage of emergency medicine, core family medicine topics, updated international guidelines on infectious diseases. All content is aligned with the latest NICE, ADA, BTS, RCOG and WHO recommendations.',
                'whats_included' => [
                    '4 live high-yield revision classes',
                    'Latest guideline review (2024–25)',
                    'Infectious disease updates (WHO 2025)',
                    'Mock MCQ exam with explanations',
                    'PDF handouts and summary notes'
                ],
                'fee' => 15000.00,
                'early_bird_fee' => 12000.00,
                'icon_class' => 'fa-campground',
                'is_active' => true,
            ],

            // 6. ECG Interpretation for GPs
            [
                'user_id' => $doctor->id,
                'title' => 'ECG Interpretation for GPs',
                'description' => 'Master ECG reading skills essential for general practice',
                'icon_class' => 'fa-heartbeat',
                'is_active' => true,
            ],

            // 7. Asthma & COPD Masterclass
            [
                'user_id' => $doctor->id,
                'title' => 'Asthma & COPD Masterclass',
                'description' => 'Comprehensive guide to respiratory conditions',
                'icon_class' => 'fa-lungs',
                'is_active' => true,
            ],

            // 8. Women's Health (OSCE Focus)
            [
                'user_id' => $doctor->id,
                'title' => 'Women\'s Health (OSCE Focus)',
                'description' => 'Specialized training for OSCE scenarios',
                'icon_class' => 'fa-female',
                'is_active' => true,
            ],

            // 9. Infectious Diseases (WHO 2025)
            [
                'user_id' => $doctor->id,
                'title' => 'Infectious Diseases (WHO 2025)',
                'description' => 'Updated guidelines and management protocols',
                'icon_class' => 'fa-virus',
                'is_active' => true,
            ],

            // 10. Communication Skills & BBN Workshop
            [
                'user_id' => $doctor->id,
                'title' => 'Communication Skills & BBN Workshop',
                'description' => 'Essential skills for effective patient communication',
                'icon_class' => 'fa-handshake',
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            Course::updateOrCreate(
                ['title' => $courseData['title'], 'user_id' => $doctor->id],
                $courseData
            );
        }

        $this->command->info('Courses seeded successfully!');
    }
}
