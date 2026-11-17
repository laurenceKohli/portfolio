<script setup>

</script>

<template>
	<footer class="site-footer">
		<div class="footer-main">
			<section class="footer-brand" aria-label="Laurence Kohli">
				<a class="brand-name" href="/">
					<span class="brand-mark" aria-hidden="true">#</span>
					<span>Laurence Kohli</span>
				</a>
				<p></p>
			</section>

			<nav class="footer-group" aria-label="Navigation de pied de page">
				<h2>Navigation</h2>
				<div class="footer-links">
					<a href="/">Accueil</a>
					<a href="/projects">Projets</a>
					<a href="/#perso-section">À propos</a>
					<a href="/skills">Compétences</a>
                    <a href="/contact">Contact</a>
					
				</div>
			</nav>

			<section class="footer-group">
				<h2>Contact</h2>
				<div class="footer-links">
					<a href="mailto:contact@lkohli.ch">E-mail</a>
					<a href="https://www.linkedin.com/in/laurence-kohli" target="_blank" rel="noopener noreferrer">LinkedIn</a>
					<!-- <a href="/cv.pdf" target="_blank" rel="noopener noreferrer">CV (PDF)</a> -->
				</div>
			</section>
		</div>

		<div class="footer-bottom">
			<p>© 2026 Laurence Kohli</p>
			<!-- <nav class="legal-links" aria-label="Informations légales">
				<a href="/mentions-legales">Mentions légales</a>
				<a href="/confidentialite">Confidentialité</a>
			</nav> -->
		</div>
	</footer>
</template>

<style scoped>
	@reference "#app.css";

	.site-footer {
		@apply mt-16 border-t border-onSurface2/20 pt-8 pb-6;
	}

	.footer-main {
		@apply grid grid-cols-1 gap-8 pb-8 md:grid-cols-3;
	}

	.footer-brand,
	.footer-group {
		@apply flex flex-col items-start gap-3;
	}

	.brand-name {
		@apply inline-flex items-center gap-2 font-heading text-xl text-text;
	}

	.brand-mark {
		@apply text-2xl text-primary;
	}

	.footer-brand p {
		@apply text-sm text-onSurface2;
	}

	.footer-group h2 {
		@apply text-sm font-semibold text-text;
	}

	.footer-links {
		@apply flex flex-wrap gap-x-4 gap-y-2;
	}

	.footer-links a,
	.legal-links a {
		@apply text-sm text-onSurface2 transition-colors hover:text-primary;
	}

	.footer-bottom {
		@apply flex flex-col gap-3 border-t border-onSurface2/20 pt-4 text-xs text-onSurface2 sm:flex-row sm:items-center sm:justify-between;
	}

	.legal-links {
		@apply flex flex-wrap gap-x-4 gap-y-2;
	}
</style>
