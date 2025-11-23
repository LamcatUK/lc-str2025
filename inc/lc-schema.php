<?php
/**
 * LC Schema Functions.
 *
 * @package lc-str2025
 */

/**
 * Disables Yoast SEO JSON-LD output.
 */
add_filter( 'wpseo_json_ld_output', '__return_false' );

/**
 * Output our base schema from ACF.
 */
add_action(
'wp_head',
function () {
if ( get_field( 'schema' ) ) {
echo '<script type="application/ld+json">';
echo get_field( 'schema' );
echo '</script>';
}
},
5
);

/**
 * Transform Trustindex schema in the footer.
 * Extracts aggregateRating from Trustindex and merges into our LegalService schema.
 */
add_action(
'wp_footer',
function () {
?>
<script>
(function() {
// Wait for Trustindex to inject their schema.
setTimeout(function() {
var scripts = document.querySelectorAll('script[type="application/ld+json"]');
var trustindexRating = null;
var ourSchema = null;
var ourSchemaElement = null;

scripts.forEach(function(script) {
try {
var data = JSON.parse(script.textContent);

// Find Trustindex schema (has aggregateRating but wrong @type).
if (data.aggregateRating && (data['@type'] === 'Product' || data['@type'] === 'Organization')) {
trustindexRating = data.aggregateRating;
// Remove Trustindex's schema.
script.remove();
}

// Find our LegalService schema.
if (data['@type'] === 'LegalService') {
ourSchema = data;
ourSchemaElement = script;
}
} catch(e) {
// Invalid JSON, skip.
}
});

// If we found both, merge the rating into our schema.
if (trustindexRating && ourSchema && ourSchemaElement) {
ourSchema.aggregateRating = trustindexRating;
ourSchemaElement.textContent = JSON.stringify(ourSchema);
console.log('✓ Merged Trustindex rating into LegalService schema');
}
}, 2500); // Wait 2.5 seconds for Trustindex to load.
})();
</script>
<?php
},
999
);
