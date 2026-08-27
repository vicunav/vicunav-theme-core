import { createHash } from 'node:crypto';
import { existsSync, readFileSync } from 'node:fs';
import path from 'node:path';

const repoRoot = path.resolve(import.meta.dirname, '..');
const readJson = (relativePath) =>
	JSON.parse(readFileSync(path.join(repoRoot, relativePath), 'utf8'));
const assert = (condition, message) => {
	if (!condition) {
		throw new Error(message);
	}
};
const toMap = (items, key = 'slug', value = 'color') =>
	new Map(items.map((item) => [item[key], item[value]]));

const theme = readJson('theme.json');
const variation = readJson('styles/bonasera.json');
const variationRaw = readFileSync(path.join(repoRoot, 'styles/bonasera.json'), 'utf8');
const contract = readFileSync(path.join(repoRoot, 'docs/contrato-publico.md'), 'utf8');
const documentation = readFileSync(path.join(repoRoot, 'docs/variacion-bonasera.md'), 'utf8');

assert(theme.$schema === 'https://schemas.wp.org/wp/6.6/theme.json', 'El schema base no está fijado a WordPress 6.6.');
assert(variation.$schema === theme.$schema, 'La variación y el theme usan schemas distintos.');
assert(theme.version === 3 && variation.version === 3, 'El contrato debe usar theme.json v3.');
assert(variation.title === 'Bonasera', 'La variación perdió su título seleccionable.');

const basePalette = toMap(theme.settings.color.palette);
const variationPalette = toMap(variation.settings.color.palette);
const expectedPalette = new Map([
	['vicunav-primary', '#0D0D0D'],
	['vicunav-secondary', '#4A3B33'],
	['vicunav-accent', '#9DAAAA'],
	['vicunav-positive', '#4D673B'],
	['vicunav-warning', '#9F4527'],
	['vicunav-danger', '#A8432B'],
	['vicunav-info', '#557259'],
	['vicunav-neutral-100', '#FAEBD7'],
	['vicunav-neutral-200', '#F0DFC4'],
	['vicunav-neutral-300', '#FFFDF8'],
	['vicunav-neutral-400', 'rgba(13, 13, 13, 0.12)'],
	['vicunav-neutral-500', 'rgba(13, 13, 13, 0.5)'],
	['vicunav-neutral-600', 'rgba(13, 13, 13, 0.62)'],
	['vicunav-neutral-700', 'rgba(13, 13, 13, 0.75)'],
	['vicunav-neutral-800', '#4A3B33'],
	['vicunav-neutral-900', '#0D0D0D'],
]);

assert(variationPalette.size === expectedPalette.size, 'La paleta Bonasera tiene entradas inesperadas.');
for (const [slug, color] of expectedPalette) {
	assert(basePalette.has(slug), `El contrato base no publica ${slug}.`);
	assert(variationPalette.get(slug) === color, `Valor Bonasera inesperado para ${slug}.`);
	const documented =
		contract.includes(`\`${slug}\``) ||
		(slug.startsWith('vicunav-neutral-') && contract.includes('`vicunav-neutral-100` a `vicunav-neutral-900`'));
	assert(documented, `El contrato público no documenta ${slug}.`);
}
assert(basePalette.get('vicunav-primary') === '#1D4ED8', 'Bonasera sustituyó la identidad predeterminada.');

const spacing = toMap(variation.settings.spacing.spacingSizes, 'slug', 'size');
const expectedSpacing = new Map([
	['bonasera-space-1', '0.25rem'],
	['vicunav-space-xs', '0.5rem'],
	['bonasera-space-3', '0.75rem'],
	['vicunav-space-sm', '1rem'],
	['vicunav-space-md', '1.5rem'],
	['vicunav-space-lg', '2rem'],
	['vicunav-space-xl', '3rem'],
	['bonasera-space-8', '4rem'],
	['bonasera-space-9', '6rem'],
	['bonasera-space-10', '8.75rem'],
]);
assert(spacing.size === expectedSpacing.size, 'La escala de espaciado no tiene diez pasos.');
for (const [slug, size] of expectedSpacing) {
	assert(spacing.get(slug) === size, `Espaciado inesperado para ${slug}.`);
}

const fontSizes = toMap(variation.settings.typography.fontSizes, 'slug', 'size');
const expectedFontSizes = new Map([
	['bonasera-xs', '0.6875rem'],
	['vicunav-sm', '0.78125rem'],
	['bonasera-base', '0.875rem'],
	['vicunav-md', '0.9375rem'],
	['vicunav-lg', '1.1875rem'],
	['bonasera-xl', '1.375rem'],
	['bonasera-xxl', '1.625rem'],
	['vicunav-xl', 'clamp(2.25rem, 5vw, 3.375rem)'],
]);
assert(fontSizes.size === expectedFontSizes.size, 'La escala tipográfica no tiene ocho pasos.');
for (const [slug, size] of expectedFontSizes) {
	assert(fontSizes.get(slug) === size, `Tamaño inesperado para ${slug}.`);
}

const expectedFonts = new Map([
	['vicunav-heading', ['assets/fonts/big-shoulders-display-latin.woff2', '203dd8ba4ae61b19cd2e00c66708f0d0f6d8484cdfdb1d7e8be37260d36a99b1']],
	['vicunav-body', ['assets/fonts/jost-latin.woff2', '235d8f8964bfdf105fc0c3e4c77b5e70f31bee1dad611d59318b5f2a5cb64d90']],
]);
for (const family of variation.settings.typography.fontFamilies) {
	const expected = expectedFonts.get(family.slug);
	assert(expected, `Familia inesperada: ${family.slug}.`);
	const relativePath = family.fontFace[0].src.replace('file:./', '');
	assert(relativePath === expected[0], `Ruta de fuente inesperada: ${family.slug}.`);
	const absolutePath = path.join(repoRoot, relativePath);
	assert(existsSync(absolutePath), `Falta la fuente local ${relativePath}.`);
	const digest = createHash('sha256').update(readFileSync(absolutePath)).digest('hex');
	assert(digest === expected[1], `Checksum inesperado: ${relativePath}.`);
}
assert(expectedFonts.size === variation.settings.typography.fontFamilies.length, 'Faltan familias Bonasera.');
assert(!theme.settings.typography.fontFamilies.some(({ fontFace }) => fontFace), 'El theme base incorporó fuentes Bonasera.');

assert(variation.settings.layout.contentSize === '42rem', 'El ancho de contenido cambió.');
assert(variation.settings.layout.wideSize === '77.5rem', 'El ancho de 1240 px cambió.');
assert(variation.settings.custom.bonasera.container.max === '1240px', 'El token de contenedor cambió.');
assert(
	Object.keys(variation.settings.custom.bonasera.breakpoint).sort().join(',') === 'large,medium,small,wide',
	'La escala de breakpoints está incompleta.'
);
assert(variation.settings.shadow.presets.length === 5, 'Falta una sombra Bonasera.');
assert(variation.styles.spacing.blockGap === 'var(--wp--preset--spacing--vicunav-space-md)', 'El ritmo global cambió.');
assert(variation.styles.elements.button.css.includes('&:hover { opacity: 0.72; }'), 'El hover de botón no reproduce la fuente.');
for (const level of ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']) {
	assert(variation.styles.elements[level].css === 'transform: scaleY(1.22);', `Falta la escala vertical de ${level}.`);
}

assert(!variationRaw.includes('http://'), 'La variación contiene una URL HTTP.');
assert(
	(variationRaw.match(/https:\/\//g) ?? []).length === 1,
	'La variación contiene una dependencia remota además del schema.'
);
assert(
	!/var\(\s*--wp--(?:preset|custom)--[a-z-]+--\d+[a-z]/.test(variationRaw),
	'La variación referencia un slug sin normalizar.'
);
assert(documentation.includes('1e1f62787e088c0ca9701500e764802499d1b253'), 'La documentación perdió el commit fuente.');

const contrastPairs = [
	['#0D0D0D', '#FAEBD7', 'tinta sobre crema'],
	['#4A3B33', '#FAEBD7', 'marrón sobre crema'],
	['#FAEBD7', '#0D0D0D', 'crema sobre tinta'],
	['#0D0D0D', '#9DAAAA', 'tinta sobre salvia'],
	['#0D0D0D', '#FFFDF8', 'tinta sobre papel'],
	['#FAEBD7', '#4A3B33', 'crema sobre marrón'],
	['#4D673B', '#FAEBD7', 'positivo sobre crema'],
	['#9F4527', '#FAEBD7', 'advertencia sobre crema'],
	['#A8432B', '#FAEBD7', 'peligro sobre crema'],
	['#557259', '#FAEBD7', 'información sobre crema'],
];
for (const [foreground, background, label] of contrastPairs) {
	assert(contrast(foreground, background) >= 4.5, `Contraste AA insuficiente: ${label}.`);
}

console.log('Contrato visual Bonasera validado.');

function contrast(foreground, background) {
	const brighter = Math.max(luminance(foreground), luminance(background));
	const darker = Math.min(luminance(foreground), luminance(background));
	return (brighter + 0.05) / (darker + 0.05);
}

function luminance(hex) {
	const channels = hex.match(/[a-f\d]{2}/gi).map((channel) => Number.parseInt(channel, 16) / 255);
	const linear = channels.map((channel) =>
		channel <= 0.04045 ? channel / 12.92 : ((channel + 0.055) / 1.055) ** 2.4
	);
	return 0.2126 * linear[0] + 0.7152 * linear[1] + 0.0722 * linear[2];
}
