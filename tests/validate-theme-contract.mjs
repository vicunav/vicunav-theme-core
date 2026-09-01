import { readFileSync } from 'node:fs';
import path from 'node:path';

const repoRoot = path.resolve(import.meta.dirname, '..');
const readJson = (relativePath) =>
	JSON.parse(readFileSync(path.join(repoRoot, relativePath), 'utf8'));
const assert = (condition, message) => {
	if (!condition) {
		throw new Error(message);
	}
};
const slugs = (items) => items.map((item) => item.slug);

const theme = readJson('theme.json');
const contract = readFileSync(path.join(repoRoot, 'docs/contrato-publico.md'), 'utf8');

assert(theme.$schema === 'https://schemas.wp.org/wp/6.6/theme.json', 'El schema base no está fijado a WordPress 6.6.');
assert(theme.version === 3, 'El contrato debe usar theme.json v3.');

// El theme raíz es la superficie agnóstica de vertical y de marca: publica slugs y
// valores placeholder, nunca identidad de un demo o cliente concreto. Un child theme
// (uno por demo/marca) es quien sustituye estos valores; ver docs/child-themes.md.

const paletteSlugs = slugs(theme.settings.color.palette);
const expectedPaletteSlugs = [
	'vicunav-primary', 'vicunav-secondary', 'vicunav-accent', 'vicunav-positive',
	'vicunav-warning', 'vicunav-danger', 'vicunav-info',
	'vicunav-neutral-100', 'vicunav-neutral-200', 'vicunav-neutral-300', 'vicunav-neutral-400',
	'vicunav-neutral-500', 'vicunav-neutral-600', 'vicunav-neutral-700', 'vicunav-neutral-800', 'vicunav-neutral-900',
];
for (const slug of expectedPaletteSlugs) {
	assert(paletteSlugs.includes(slug), `Falta el slug de paleta publicado ${slug}.`);
	assert(contract.includes(`\`${slug}\``) || contract.includes('`vicunav-neutral-100` a `vicunav-neutral-900`'), `El contrato público no documenta ${slug}.`);
}

const spacingSlugs = slugs(theme.settings.spacing.spacingSizes);
const expectedSpacingSlugs = [
	'vicunav-space-xxs', 'vicunav-space-xs', 'vicunav-space-sm', 'vicunav-space-md',
	'vicunav-space-lg', 'vicunav-space-xl', 'vicunav-space-xxl', 'vicunav-space-section-sm',
	'vicunav-space-section-md', 'vicunav-space-section-lg',
];
assert(spacingSlugs.length === expectedSpacingSlugs.length, 'La escala de espaciado debe tener diez pasos.');
for (const slug of expectedSpacingSlugs) {
	assert(spacingSlugs.includes(slug), `Falta el paso de espaciado ${slug}.`);
}

const fontSizeSlugs = slugs(theme.settings.typography.fontSizes);
const expectedFontSizeSlugs = [
	'vicunav-xxs', 'vicunav-sm', 'vicunav-md', 'vicunav-lg',
	'vicunav-xl', 'vicunav-xxl', 'vicunav-display-sm', 'vicunav-display-lg',
];
assert(fontSizeSlugs.length === expectedFontSizeSlugs.length, 'La escala tipográfica debe tener ocho pasos.');
for (const slug of expectedFontSizeSlugs) {
	assert(fontSizeSlugs.includes(slug), `Falta el paso tipográfico ${slug}.`);
}

// WordPress inserta un guion en la frontera dígito-letra al generar el nombre de la
// custom property CSS de un preset (ej. slug "vicunav-space-2xs" se compila como
// "--wp--preset--spacing--vicunav-space-2-xs", no "...-2xs"). Cualquier slug nuevo
// debe evitar esa adyacencia sin guion explícito, o el CSS que lo referencia con
// var(--wp--preset--...--vicunav-space-2xs) nunca resolverá. Ver docs/child-themes.md
// y translation-map.md del skill transform-claude-to-gutenberg para el detalle.
const allScaleSlugs = [
	...slugs(theme.settings.color.palette),
	...spacingSlugs,
	...fontSizeSlugs,
	...slugs(theme.settings.shadow?.presets ?? []),
];
for (const slug of allScaleSlugs) {
	assert(!/[a-z][0-9]|[0-9][a-z]/i.test(slug), `El slug ${slug} tiene una frontera letra-dígito sin guion: WordPress lo renombrará al compilar el CSS.`);
}

assert(
	!theme.settings.typography.fontFamilies.some(({ fontFace }) => fontFace),
	'El theme raíz no debe incorporar archivos de fuente: eso es responsabilidad de un child theme.'
);

const shadowSlugs = slugs(theme.settings.shadow?.presets ?? []);
const expectedShadowSlugs = [
	'vicunav-shadow-card', 'vicunav-shadow-card-hover', 'vicunav-shadow-panel',
	'vicunav-shadow-modal', 'vicunav-shadow-toast',
];
assert(shadowSlugs.length === expectedShadowSlugs.length, 'Deben existir cinco presets de sombra.');
for (const slug of expectedShadowSlugs) {
	assert(shadowSlugs.includes(slug), `Falta el preset de sombra ${slug}.`);
}

assert(typeof theme.settings.layout?.contentSize === 'string', 'Falta settings.layout.contentSize.');
assert(typeof theme.settings.layout?.wideSize === 'string', 'Falta settings.layout.wideSize.');

const custom = theme.settings.custom?.vicunav;
assert(custom, 'Falta el namespace agnóstico settings.custom.vicunav.');
for (const key of ['border', 'breakpoint', 'container', 'motion', 'opacity', 'radius', 'surface', 'text', 'section']) {
	assert(custom[key], `Falta el grupo de custom properties vicunav.${key}.`);
}

assert(
	!/bonasera|guasabara|guasábara/i.test(JSON.stringify(theme)),
	'El theme raíz no debe mencionar ninguna marca o demo concreto.'
);
assert(
	!/bonasera|guasabara|guasábara/i.test(contract),
	'El contrato público no debe mencionar ninguna marca o demo concreto.'
);

console.log('Contrato base agnóstico de theme.json validado.');
