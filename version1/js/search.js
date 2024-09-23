function submitSearch() {
    document.getElementById('searchForm').submit();
}

function focusSearchInput() {
    const searchInput = document.getElementById('searchInput');
    searchInput.focus();
}

window.onload = function() {
    const searchInput = document.getElementById('searchInput');
    if ('<?= htmlspecialchars($search_query) ?>') {
        setTimeout(() => {
            searchInput.focus();
            searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length); // 将光标放在末尾
        }, 0);
    } else {
        searchInput.focus();
    }
};


