// Tilni almashtirish tugmasini tanlash
const swapButton = document.getElementById('swap-languages');

// Tilni almashtirish tugmasi bosilganda
swapButton.addEventListener('click', function() {
    const sourceLanguage = document.getElementById('source-language').value;
    const targetLanguage = document.getElementById('target-language').value;

    // Almashtirilgan tillarni joylashtirish
    document.getElementById('source-language').value = targetLanguage;
    document.getElementById('target-language').value = sourceLanguage;
});