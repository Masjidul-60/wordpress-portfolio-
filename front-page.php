<?php
/**
 * Front page: the full one-page portfolio.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();

$d       = masjidul_data();
$c       = masjidul_contact();
$name    = masjidul_mod( 'hero_name', 'Md. Masjidul Islam' );
$role    = masjidul_mod( 'hero_role', 'Computer Science & Engineering student · EEG and AI research' );
$intro   = masjidul_mod( 'hero_intro', 'I am interested in biomedical signal processing and machine learning, particularly EEG reconstruction and motor-imagery brain-computer interfaces. My long-term goal is to pursue advanced research in AI for neurorehabilitation.' );
$caption = masjidul_mod( 'hero_photo_caption', 'RURS 2nd International Conference, 2023' );
$photo   = masjidul_media( 'hero_photo', 'img/portrait.jpg' );
$about_i = masjidul_media( 'about_photo', 'img/cover-topomap.jpg' );
$about_custom = (bool) get_theme_mod( 'about_photo' );
$video   = masjidul_media( 'hero_video', 'video/hero-eeg.mp4' );
$poster  = masjidul_media( 'hero_poster', 'img/hero-poster.jpg' );
$goals   = masjidul_media( 'goals_bg', 'img/banner-neural.jpg' );
$cv      = masjidul_cv_url();
$status  = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>

<!-- HERO -->
<section id="home" class="hero">
	<video class="hero__video" autoplay muted loop playsinline preload="metadata" poster="<?php echo esc_url( $poster ); ?>" aria-hidden="true">
		<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
	</video>
	<div class="hero__shade"></div>
	<div class="wrap hero__grid">
		<div class="hero__copy">
			<p class="hero__role"><?php echo esc_html( $role ); ?></p>
			<h1 class="hero__name"><?php echo esc_html( $name ); ?></h1>
			<p class="hero__intro"><?php echo esc_html( $intro ); ?></p>
			<div class="hero__cta">
				<a class="btn" href="#research">Explore my research</a>
				<a class="btn btn--ghost" href="#projects">View projects</a>
				<?php if ( $cv ) : ?>
					<a class="btn btn--ghost" href="<?php echo esc_url( $cv ); ?>" download target="_blank" rel="noopener"><?php echo masjidul_icon( 'download' ); // phpcs:ignore ?>Download CV</a>
				<?php endif; ?>
			</div>
			<div class="social">
				<?php if ( $c['github'] ) : ?><a href="<?php echo esc_url( $c['github'] ); ?>" aria-label="GitHub" target="_blank" rel="noopener"><?php echo masjidul_icon( 'github' ); // phpcs:ignore ?></a><?php endif; ?>
				<?php if ( $c['linkedin'] ) : ?><a href="<?php echo esc_url( $c['linkedin'] ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener"><?php echo masjidul_icon( 'linkedin' ); // phpcs:ignore ?></a><?php endif; ?>
				<?php if ( $c['email'] ) : ?><a href="mailto:<?php echo esc_attr( antispambot( $c['email'] ) ); ?>" aria-label="Email"><?php echo masjidul_icon( 'mail' ); // phpcs:ignore ?></a><?php endif; ?>
			</div>
		</div>
		<figure class="hero__photo">
			<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?> in a navy suit in front of the RURS 2nd International Conference and Research Fair 2023 backdrop" width="1000" height="1200" fetchpriority="high">
			<figcaption><?php echo esc_html( $caption ); ?></figcaption>
		</figure>
	</div>
	<div class="hero__facts">
		<div class="wrap">
			<dl>
				<div><dt>B.Sc. CSE</dt><dd>Pundra University of Science &amp; Technology</dd></div>
				<div><dt>3.69 / 4.00</dt><dd>CGPA through the 7th semester</dd></div>
				<div><dt>2 accepted, 2 submitted</dt><dd>Papers on EEG, BCI and AI</dd></div>
			</dl>
		</div>
	</div>
</section>

<!-- ABOUT -->
<section id="about" class="sec">
	<div class="wrap about">
		<div>
			<div class="sec__head"><h2>About</h2></div>
			<p>I am a Computer Science and Engineering student at Pundra University of Science &amp; Technology in Bogura, Bangladesh. My academic interests span artificial intelligence, deep learning, data science, and computational approaches to neurological health.</p>
			<p>My research and project work focuses on EEG-based motor imagery, neural-signal processing and reconstruction, and AI-driven approaches to post-stroke rehabilitation. I am especially interested in applying data-driven methods to neural engineering, assistive technologies, biomedical data analysis, pattern recognition, and intelligent decision-making systems.</p>
			<p>I am seeking research-oriented graduate study to deepen my technical and research expertise and explore practical AI solutions for healthcare and human–machine interaction.</p>
		</div>
		<div class="about__side">
			<figure>
				<img src="<?php echo esc_url( $about_i ); ?>" alt="<?php echo $about_custom ? esc_attr( $name ) : 'Illustration of an EEG scalp map with electrode positions'; ?>" width="1600" height="1000" loading="lazy">
				<?php if ( ! $about_custom ) : ?><figcaption>Illustration: EEG scalp map, not real data.</figcaption><?php endif; ?>
			</figure>
			<h3>Research interests</h3>
			<ul class="chips">
				<?php foreach ( $d['interests'] as $i ) : ?><li><?php echo esc_html( $i ); ?></li><?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<!-- EDUCATION -->
<section id="education" class="sec sec--panel">
	<div class="wrap">
		<div class="sec__head"><h2>Education</h2></div>
		<ol class="timeline">
			<?php foreach ( $d['education'] as $e ) : ?>
				<li>
					<time><?php echo esc_html( $e['years'] ); ?></time>
					<div>
						<h3><?php echo esc_html( $e['title'] ); ?></h3>
						<p><?php echo esc_html( $e['school'] ); ?><br><strong><?php echo esc_html( $e['grade'] ); ?></strong></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<!-- RESEARCH -->
<section id="research" class="sec">
	<div class="wrap">
		<div class="sec__head">
			<h2>Research</h2>
			<p>My current work explores EEG reconstruction and evaluation for motor-imagery BCI and neurological applications.</p>
		</div>
		<div class="rcards">
			<?php foreach ( $d['research'] as $r ) : ?>
				<article class="rcard">
					<img src="<?php echo esc_url( masjidul_asset( 'img/' . $r['img'] ) ); ?>" alt="<?php echo esc_attr( $r['alt'] ); ?>" width="1600" height="1000" loading="lazy">
					<div class="rcard__body">
						<div><span class="badge badge--<?php echo esc_attr( strtolower( $r['status'] ) ); ?>"><?php echo esc_html( $r['status'] ); ?></span></div>
						<h3><?php echo esc_html( $r['title'] ); ?></h3>
						<p><?php echo esc_html( $r['text'] ); ?></p>
						<p class="rcard__meta"><?php echo esc_html( $r['area'] ); ?><br><?php echo esc_html( $r['venue'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="explorer" id="explorer">
			<div class="explorer__view"><canvas id="eeg-canvas" role="img" aria-label="Simulated EEG trace that changes with the rhythm sliders"></canvas></div>
			<div class="explorer__ctl">
				<h3>EEG rhythm explorer</h3>
				<p>Change the strength of each rhythm band and watch how a sample trace responds.</p>
				<div class="presets" role="group" aria-label="Brain state presets">
					<button type="button" data-preset="20,15,85,15" class="is-on">Resting</button>
					<button type="button" data-preset="12,18,30,60">Motor imagery</button>
					<button type="button" data-preset="10,40,22,75">Focused task</button>
				</div>
				<?php
				$bands = array( 'delta' => array( 'Delta', 20 ), 'theta' => array( 'Theta', 15 ), 'alpha' => array( 'Alpha / mu', 85 ), 'beta' => array( 'Beta', 15 ) );
				foreach ( $bands as $k => $b ) :
					?>
					<div class="band">
						<label for="band-<?php echo esc_attr( $k ); ?>"><?php echo esc_html( $b[0] ); ?></label>
						<output data-out="<?php echo esc_attr( $k ); ?>"><?php echo (int) $b[1]; ?>%</output>
						<input type="range" id="band-<?php echo esc_attr( $k ); ?>" min="0" max="100" value="<?php echo (int) $b[1]; ?>">
					</div>
				<?php endforeach; ?>
				<p class="explorer__note">Illustrative simulation only. This is not real EEG data and is not meant for medical interpretation.</p>
			</div>
		</div>
	</div>
</section>

<!-- PUBLICATIONS -->
<section id="publications" class="sec sec--panel">
	<div class="wrap">
		<div class="sec__head">
			<h2>Publications and conference work</h2>
			<p>Statuses are shown as provided by the author.</p>
		</div>
		<ul class="pubs">
			<?php foreach ( $d['publications'] as $p ) : ?>
				<li>
					<div><span class="badge badge--<?php echo esc_attr( strtolower( $p['status'] ) ); ?>"><?php echo esc_html( $p['status'] ); ?></span></div>
					<div>
						<h3><?php echo esc_html( $p['title'] ); ?></h3>
						<p class="authors"><?php echo esc_html( $p['authors'] ); ?></p>
						<p class="venue"><b><?php echo esc_html( $p['venue'] ); ?></b></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- PROJECTS -->
<section id="projects" class="sec">
	<div class="wrap">
		<div class="sec__head">
			<h2>Selected projects</h2>
			<p>Academic and technical work from 2025 and 2026.</p>
		</div>
		<div class="filters" role="group" aria-label="Filter projects">
			<button type="button" data-filter="all" class="is-on">All projects</button>
			<button type="button" data-filter="research">Research</button>
			<button type="button" data-filter="software">Software</button>
		</div>
		<div class="pgrid">
			<?php
			foreach ( $d['projects'] as $p ) :
				$repo = masjidul_mod( 'repo_' . $p['slug'], '' );
				?>
				<article class="proj" data-cat="<?php echo esc_attr( $p['cat'] ); ?>">
					<img src="<?php echo esc_url( masjidul_asset( 'img/' . $p['img'] ) ); ?>" alt="" width="1600" height="1000" loading="lazy">
					<div class="proj__body">
						<?php if ( $p['note'] ) : ?><span class="note"><?php echo esc_html( $p['note'] ); ?></span><?php endif; ?>
						<h3><?php echo esc_html( $p['title'] ); ?></h3>
						<p><?php echo esc_html( $p['text'] ); ?></p>
						<span class="tags"><?php echo esc_html( $p['meta'] ); ?></span>
						<?php if ( $repo ) : ?>
							<a class="repo" href="<?php echo esc_url( $repo ); ?>" target="_blank" rel="noopener"><?php echo masjidul_icon( 'github' ); // phpcs:ignore ?>View repository</a>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- SKILLS -->
<section id="skills" class="sec sec--panel">
	<div class="wrap">
		<div class="sec__head"><h2>Technical skills</h2></div>
		<div class="skills">
			<?php foreach ( $d['skills'] as $s ) : ?>
				<div class="skill"><h3><?php echo esc_html( $s[0] ); ?></h3><p><?php echo esc_html( $s[1] ); ?></p></div>
			<?php endforeach; ?>
		</div>
		<ul class="langs">
			<?php foreach ( $d['languages'] as $l ) : ?>
				<li><strong><?php echo esc_html( $l[0] ); ?></strong><span><?php echo esc_html( $l[1] ); ?></span></li>
			<?php endforeach; ?>
		</ul>
		<p class="learning"><?php echo esc_html( $d['learning'] ); ?></p>
	</div>
</section>

<!-- GALLERY -->
<?php
$items = array();
$seen  = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$v = get_theme_mod( 'photo_' . $i );
	if ( ! $v ) {
		continue;
	}
	$u = is_numeric( $v ) ? wp_get_attachment_url( (int) $v ) : $v;
	if ( ! $u || in_array( $u, $seen, true ) ) {
		continue;
	}
	$seen[]  = $u;
	$cap     = masjidul_mod( 'photo_' . $i . '_caption', '' );
	$items[] = array( 'src' => $u, 'title' => $cap ? $cap : 'Photo', 'caption' => '', 'photo' => true );
}
foreach ( $d['gallery'] as $g ) {
	$u = masjidul_asset( 'img/' . $g['img'] );
	if ( in_array( $u, $seen, true ) ) {
		continue;
	}
	$seen[]  = $u;
	$items[] = array( 'src' => $u, 'title' => $g['title'], 'caption' => $g['caption'], 'photo' => false );
}
?>
<section id="gallery" class="sec">
	<div class="wrap">
		<div class="sec__head">
			<h2>Research gallery</h2>
			<p>Original illustrations of the ideas behind my EEG and BCI work. They are drawings, not real recordings or lab photographs.</p>
		</div>
		<div class="gallery">
			<?php foreach ( $items as $it ) : ?>
				<figure class="gal<?php echo $it['photo'] ? ' is-photo' : ''; ?>">
					<a href="<?php echo esc_url( $it['src'] ); ?>" data-caption="<?php echo esc_attr( $it['title'] ); ?>">
						<img src="<?php echo esc_url( $it['src'] ); ?>" alt="<?php echo esc_attr( $it['title'] . ( $it['photo'] ? '' : ' (illustration)' ) ); ?>" width="1600" height="1000" loading="lazy">
					</a>
					<figcaption><b><?php echo esc_html( $it['title'] ); ?></b><?php echo esc_html( $it['caption'] ); ?></figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<p class="gallery-note">Real conference or poster photos can be added in Customize &rsaquo; Portfolio Settings &rsaquo; Gallery: your real photos.</p>
	</div>
</section>

<!-- ACHIEVEMENTS + ACTIVITIES -->
<section id="achievements" class="sec">
	<div class="wrap">
		<div class="sec__head"><h2>Achievements and awards</h2></div>
		<ul class="ach">
			<?php foreach ( $d['achievements'] as $a ) : ?>
				<li><time><?php echo esc_html( $a[0] ); ?></time><h3><?php echo esc_html( $a[1] ); ?></h3><p><?php echo esc_html( $a[2] ); ?></p></li>
			<?php endforeach; ?>
		</ul>
		<div class="acts" id="activities">
			<h3 class="sub">Leadership and activities</h3>
			<ul>
				<?php foreach ( $d['activities'] as $a ) : ?>
					<li><div><strong><?php echo esc_html( $a[1] ); ?></strong><br><span><?php echo esc_html( $a[2] ); ?></span></div><time><?php echo esc_html( $a[0] ); ?></time></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>

<!-- GRADUATE GOALS -->
<section id="goals" class="sec goals">
	<img class="goals__bg" src="<?php echo esc_url( $goals ); ?>" alt="" loading="lazy">
	<div class="wrap">
		<h2>Building toward responsible AI for neurological health</h2>
		<p>I plan to pursue a research-oriented Master’s degree in artificial intelligence, biomedical signal processing, or neural engineering. Graduate study would help me deepen my foundations in machine learning and experimental design, and investigate reliable EEG analysis and brain-computer interfaces for neurorehabilitation. In the long term, I hope to contribute to research that connects rigorous computational methods with meaningful healthcare needs.</p>
		<a class="btn" href="#contact">Get in touch</a>
	</div>
</section>

<!-- BLOG -->
<?php
$sample  = get_page_by_path( 'hello-world', OBJECT, 'post' );
$latest = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => true, 'post__not_in' => $sample ? array( $sample->ID ) : array() ) );
if ( $latest->have_posts() ) :
	?>
<section id="blog" class="sec sec--panel">
	<div class="wrap">
		<div class="sec__head"><h2>From the blog</h2></div>
		<div class="posts">
			<?php
			while ( $latest->have_posts() ) {
				$latest->the_post();
				get_template_part( 'template-parts/post-card' );
			}
			wp_reset_postdata();
			?>
		</div>
		<p class="more"><a class="btn btn--ghost" href="<?php echo esc_url( masjidul_blog_url() ); ?>">All posts</a></p>
	</div>
</section>
<?php endif; ?>

<!-- CONTACT -->
<section id="contact" class="sec <?php echo $latest->have_posts() ? '' : 'sec--panel'; ?>">
	<div class="wrap contact">
		<div>
			<h2>Let’s discuss research opportunities</h2>
			<p class="muted">I welcome contact from research groups and academic supervisors working on EEG, BCI, biomedical signal processing, or intelligent healthcare.</p>
			<ul class="contact__list">
				<?php if ( $c['email'] ) : ?><li><?php echo masjidul_icon( 'mail' ); // phpcs:ignore ?><a href="mailto:<?php echo esc_attr( antispambot( $c['email'] ) ); ?>"><?php echo esc_html( antispambot( $c['email'] ) ); ?></a></li><?php endif; ?>
				<?php if ( $c['phone'] ) : ?><li><?php echo masjidul_icon( 'phone' ); // phpcs:ignore ?><span><?php echo esc_html( $c['phone'] ); ?></span></li><?php endif; ?>
				<?php if ( $c['whatsapp'] ) : ?><li><?php echo masjidul_icon( 'whatsapp' ); // phpcs:ignore ?><a href="<?php echo esc_url( $c['whatsapp'] ); ?>" target="_blank" rel="noopener">WhatsApp</a></li><?php endif; ?>
				<?php if ( $c['linkedin'] ) : ?><li><?php echo masjidul_icon( 'linkedin' ); // phpcs:ignore ?><a href="<?php echo esc_url( $c['linkedin'] ); ?>" target="_blank" rel="noopener">LinkedIn profile</a></li><?php endif; ?>
				<?php if ( $c['github'] ) : ?><li><?php echo masjidul_icon( 'github' ); // phpcs:ignore ?><a href="<?php echo esc_url( $c['github'] ); ?>" target="_blank" rel="noopener">GitHub profile</a></li><?php endif; ?>
				<?php if ( $c['location'] ) : ?><li><?php echo masjidul_icon( 'pin' ); // phpcs:ignore ?><span><?php echo esc_html( $c['location'] ); ?></span></li><?php endif; ?>
			</ul>
			<p class="refs">Academic references: Md. Habib Ehsanul Hoque (Assistant Professor &amp; Head, CSE) and Mrittika Mahbub (Lecturer, CSE), Pundra University of Science &amp; Technology. Contact details and recommendation letters are available in the CV or on request.</p>
		</div>

		<form class="cform" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php if ( 'sent' === $status ) : ?>
				<p class="notice notice--ok" role="status">Thank you. Your message was sent and I will reply soon.</p>
			<?php elseif ( 'error' === $status ) : ?>
				<p class="notice notice--err" role="alert">Your message could not be sent. Please check the fields and try again in a minute, or email me directly.</p>
			<?php endif; ?>
			<input type="hidden" name="action" value="masjidul_contact">
			<?php wp_nonce_field( 'masjidul_contact' ); ?>
			<div class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
			<div class="two">
				<label>Your name<input type="text" name="cname" required autocomplete="name"></label>
				<label>Your email<input type="email" name="cemail" required autocomplete="email"></label>
			</div>
			<label>Subject<input type="text" name="csubject" autocomplete="off"></label>
			<label>Message<textarea name="cmessage" required minlength="10"></textarea></label>
			<div><button class="btn" type="submit">Send message</button></div>
		</form>
	</div>
</section>

<?php get_footer(); ?>
