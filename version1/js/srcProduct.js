function submitSearch() {
    document.getElementById('searchForm').submit();
}

function focusSearchInput() {
    const search_product = document.getElementById('search_product');
    search_product.focus();
}

window.onload = function() {
    const search_product = document.getElementById('search_product');
    const searchValue = '<?= htmlspecialchars($search_product) ?>';

    if (searchValue) {
        setTimeout(() => {
            search_product.focus();
            search_product.setSelectionRange(search_product.value.length, search_product.value.length);
        }, 0);
    } else {
        search_product.focus();
    }
};