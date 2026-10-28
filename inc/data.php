<?php
/**
 * Portfolio content. Edit text here to update the portfolio.
 * Images live in assets/img/. Project repo links can be set in
 * Appearance > Customize > Portfolio Settings > Project links.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function masjidul_data() {
	return array(
		'interests' => array( 'Biomedical signal processing', 'EEG analysis', 'Brain-computer interfaces', 'Generative AI', 'Neurorehabilitation', 'Machine learning' ),

		'education' => array(
			array(
				'years'  => '2023 – present',
				'title'  => 'B.Sc. in Computer Science and Engineering',
				'school' => 'Pundra University of Science & Technology, Bogura, Bangladesh',
				'grade'  => 'CGPA 3.69 / 4.00 (through 7th semester)',
			),
			array(
				'years'  => '2016 – 2017',
				'title'  => 'Higher Secondary Certificate (HSC)',
				'school' => 'Santahar Government College, Bogura, Bangladesh',
				'grade'  => 'GPA 3.42 / 5.00',
			),
			array(
				'years'  => '2014 – 2015',
				'title'  => 'Secondary School Certificate (SSC)',
				'school' => 'Sayem Uddin Memorial Academy, Naogaon, Bangladesh',
				'grade'  => 'GPA 5.00 / 5.00',
			),
		),

		'research' => array(
			array(
				'title'  => 'Healthy-like EEG reconstruction for motor-imagery BCI',
				'text'   => 'A movement-aware CycleGAN approach that reconstructs healthy-like EEG from reference-conditioned input, aimed at post-stroke neurorehabilitation.',
				'area'   => 'EEG · CycleGAN · Motor-imagery BCI',
				'status' => 'Accepted',
				'venue'  => 'RICRF 2026 and IEEE CSDE 2026',
				'img'    => 'cover-cyclegan.jpg',
				'alt'    => 'A noisy EEG trace transformed into a clean EEG trace',
			),
			array(
				'title'  => 'Diffusion-based EEG reconstruction for Parkinson’s detection',
				'text'   => 'Reference-conditioned diffusion-based reconstruction, compared against Transformer and self-supervised baselines with subject-level cross-validation.',
				'area'   => 'EEG · Diffusion models · Parkinson’s disease detection',
				'status' => 'Submitted',
				'venue'  => 'ICEEICT 2027 and Computers in Biology and Medicine',
				'img'    => 'cover-diffusion.jpg',
				'alt'    => 'EEG traces becoming cleaner from left to right, like a diffusion process',
			),
		),

		'publications' => array(
			array(
				'title'   => 'Reference-Conditioned Healthy-Like EEG Reconstruction Using Movement-Aware CycleGAN for Motor Imagery BCI',
				'authors' => 'Md. Masjidul Islam, Md. Ahsanur Rahaman, Mrittika Mahbub',
				'venue'   => 'Conference: RICRF 2026 · 5 pages',
				'status'  => 'Accepted',
			),
			array(
				'title'   => 'Reference-Conditioned Healthy-Like EEG Reconstruction Using Movement-Aware CycleGAN for Motor Imagery BCI (extended version)',
				'authors' => 'Md. Masjidul Islam, Md. Ahsanur Rahaman, Mrittika Mahbub',
				'venue'   => 'Conference: IEEE CSDE 2026 · 6 pages',
				'status'  => 'Accepted',
			),
			array(
				'title'   => 'Reference-Conditioned Diffusion-Based EEG Reconstruction for Parkinson’s Disease Detection: A Comparative Evaluation with Transformer and Self-Supervised Baselines',
				'authors' => 'Md. Masjidul Islam, Md. Ahsanur Rahaman, Mrittika Mahbub, Suraiya Jahan',
				'venue'   => 'Conference: ICEEICT 2027 · 6 pages',
				'status'  => 'Submitted',
			),
			array(
				'title'   => 'Reference-Conditioned Diffusion-Based EEG Reconstruction for Parkinson’s Disease Detection: A Comparative Study of Transformer and Self-Supervised Learning Methods Using Six-Fold Subject-Level Cross-Validation (extended version)',
				'authors' => 'Md. Masjidul Islam, Md. Ahsanur Rahaman, Mrittika Mahbub, Suraiya Jahan',
				'venue'   => 'Journal: Computers in Biology and Medicine · 10 pages',
				'status'  => 'Submitted',
			),
		),

		'projects' => array(
			array(
				'slug' => 'signal-lab',
				'cat'  => 'research',
				'title' => 'Signal Lab',
				'text' => 'An interactive signal-processing tool for waveform generation, noise analysis, filtering, FFT and spectrogram visualization using Python.',
				'meta' => '2026 · Python · Signal processing',
				'img'  => 'cover-signal-lab.jpg',
				'note' => '',
			),
			array(
				'slug' => 'exam-proctor',
				'cat'  => 'software',
				'title' => 'Exam Proctor',
				'text' => 'A browser-based online examination proctoring system with webcam monitoring, face detection, violation tracking and automated exam submission.',
				'meta' => '2025 · Computer vision · Web',
				'img'  => 'cover-exam-proctor.jpg',
				'note' => 'CSE FEST Hackathon, Special Category Winner',
			),
			array(
				'slug' => 'marsway',
				'cat'  => 'research',
				'title' => 'MARSWAY — Martian Map',
				'text' => 'A science-aware Marswalk mission planner built on NASA data, with optimized route selection. Built by Team UnknownX.',
				'meta' => '2026 · NASA data · Mission planning',
				'img'  => 'cover-marsway.jpg',
				'note' => '',
			),
			array(
				'slug' => 'crypto-chat',
				'cat'  => 'software',
				'title' => 'Crypto Chat',
				'text' => 'A secure real-time messaging system built with modern encryption and authentication techniques.',
				'meta' => '2026 · Real-time messaging · Security',
				'img'  => 'cover-crypto-chat.jpg',
				'note' => '',
			),
			array(
				'slug' => 'task-manager',
				'cat'  => 'software',
				'title' => 'Full-Stack Task Management System',
				'text' => 'A Flask application with task creation, task management and database integration.',
				'meta' => '2026 · Flask · Database',
				'img'  => 'cover-task-manager.jpg',
				'note' => '',
			),
		),

		'skills' => array(
			array( 'Programming', 'Python, C, Java, JavaScript, SQL' ),
			array( 'Data science & machine learning', 'NumPy, Pandas, scikit-learn, Matplotlib, data analysis, CNN, LSTM' ),
			array( 'Deep learning & research', 'TensorFlow, PyTorch, EEG signal processing, neural-signal reconstruction, MATLAB, subject-level cross-validation' ),
			array( 'Web development & databases', 'HTML, CSS, React.js, Node.js, Flask, WordPress (intern), MongoDB, MySQL' ),
			array( 'Tools & productivity', 'Git, GitHub, MATLAB, Microsoft Word, Excel, PowerPoint' ),
			array( 'Research & professional strengths', 'Research and analytical thinking, problem solving, teamwork and collaboration, time management, adaptability, critical thinking' ),
		),

		'languages' => array(
			array( 'Bangla', 'Native · C2 in all skills' ),
			array( 'English', 'B2 in listening, reading, speaking and writing' ),
			array( 'Hindi', 'Listening C1 · Speaking B2 · Reading and writing A1' ),
		),

		'learning' => 'Currently learning: advanced deep learning and Next.js.',

		'achievements' => array(
			array( '2025', 'Hackathon Winner — Special Category', 'CSE FEST, Department of CSE, Pundra University of Science & Technology (Exam Proctor)' ),
			array( '2024', 'Chess Champion', 'CSE FEST, Department of CSE, Pundra University of Science & Technology' ),
			array( '2024', 'Programming Contest Runner-Up', 'Department of CSE, Pundra University of Science & Technology' ),
		),

		'activities' => array(
			array( 'Sept 2025 – Sept 2026', 'Executive Member', 'BASIS Students’ Forum, PUB Chapter' ),
			array( '2026', 'General Member', 'PUB Computer & Programming Club' ),
			array( '2025', 'Technical Team, CSE FEST', 'Department of CSE, Pundra University of Science & Technology' ),
			array( '2026', 'Divisional Selection Round, Bakeman’s 4th International Language League', 'BASIS Students’ Forum PUB Chapter, Bogura' ),
			array( '2025', 'Divisional Selection Round, National Newspaper Olympiad', 'BASIS Students’ Forum PUB Chapter, Bogura' ),
		),

		// Distinct original illustrations (not photographs, not real data). Each file is used once.
		'gallery' => array(
			array( 'img' => 'illus-bci-pipeline.jpg', 'title' => 'Motor-imagery BCI pipeline', 'caption' => 'Illustration of a typical signal path from scalp EEG to user feedback.' ),
			array( 'img' => 'illus-eeg-bands.jpg', 'title' => 'EEG rhythm bands', 'caption' => 'Illustration of delta, theta, alpha and beta sample waveforms.' ),
			array( 'img' => 'illus-erd.jpg', 'title' => 'Mu-rhythm suppression', 'caption' => 'Schematic of event-related desynchronization during motor imagery.' ),
			array( 'img' => 'illus-electrodes.jpg', 'title' => 'Scalp electrode layout', 'caption' => 'Illustration of 10–20 style electrode positions, viewed from above.' ),
			array( 'img' => 'illus-domain-translation.jpg', 'title' => 'Unpaired domain translation', 'caption' => 'Concept sketch of the idea behind CycleGAN-style reconstruction.' ),
			array( 'img' => 'illus-diffusion-steps.jpg', 'title' => 'Diffusion, step by step', 'caption' => 'Concept sketch of adding noise and learning to remove it.' ),
		),
	);
}
