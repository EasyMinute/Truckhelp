// jQuery(document).ready(function($) {
//     // Function to set checkbox status based on URL parameters
//     function setCheckboxesFromParams() {
//         var params = new URLSearchParams(window.location.search);
//
//         params.forEach(function(value, key) {
//             if (key === 'product_cat' || key === 'product_tag') {
//                 $('input.filter-checkbox[data-type="' + (key === 'product_cat' ? 'category' : 'tag') + '"][value="' + value + '"]').prop('checked', true);
//             }
//         });
//     }
//
//     // Set checkboxes on page load
//     setCheckboxesFromParams();
//
//     // Update URL and reload page on checkbox change
//     $('.filter-checkbox').change(function() {
//         var url = new URL(window.location.href);
//         var params = new URLSearchParams(url.search);
//
//         // Remove existing filter params
//         params.delete('product_cat');
//         params.delete('product_tag');
//
//         // Add new filter params
//         $('.filter-checkbox:checked').each(function() {
//             var type = $(this).data('type');
//             var value = $(this).val();
//             params.append(type === 'category' ? 'product_cat' : 'product_tag', value);
//         });
//
//         // Update URL
//         url.search = params.toString();
//         window.history.pushState({}, '', url);
//
//         // Reload page
//         window.location.reload();
//     });
//
// });
