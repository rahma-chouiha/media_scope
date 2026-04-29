const darkBtn = document.querySelector('.btn-dark');
const body = document.body;

if (darkBtn) {
    darkBtn.addEventListener('click', (e) => {
        e.preventDefault();
        body.classList.toggle('dark-mode');
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        darkBtn.textContent = isDark ? 'الوضع الفاتح ☀️' : 'الوضع الليلي 🌙';
    });
}

if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    if (darkBtn) darkBtn.textContent = 'الوضع الفاتح ☀️';
}
let likes = 0;
const actsDiv = document.querySelector('.actions');
if (actsDiv) {
    const likeBtn = actsDiv.querySelector('.btn-join');
    if (likeBtn) {
        likeBtn.addEventListener('click', () => {
            likes++;
            likeBtn.innerText = `👍 إعجاب (${likes})`;
        });
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const articleId = urlParams.get('id');
    if (articleId) {
        let savedArticles = JSON.parse(localStorage.getItem('articles')) || [];
        let article = savedArticles.find(a => a.id == parseInt(articleId));
        if (article) {
            const titleEl = document.querySelector('.article-title');
            const textEl = document.querySelector('.article-text');
            const imgEl = document.querySelector('.featured-image');
            if (titleEl) titleEl.textContent = article.title;
            if (textEl) textEl.innerHTML = `<p>${article.content}</p>`;
            if (imgEl && article.image && article.image.trim() !== '') {
                imgEl.src = article.image;
            } else if (imgEl) {
                imgEl.style.display = 'none';
            }
        }
    }
});
