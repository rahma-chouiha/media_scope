const darkBtn = document.querySelector('.btn-dark');
const body = document.body;
// وظيفة التبديل
if (darkBtn) {
    darkBtn.addEventListener('click', (e) => {
        e.preventDefault();
        body.classList.toggle('dark-mode');
        
        // حفظ الوضع
        const isDark = body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        
        // تغيير نص الزر
        darkBtn.textContent = isDark ? 'الوضع الفاتح ☀️' : 'الوضع الليلي 🌙';
    });
}

// عند تحميل الصفحة
if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    if (darkBtn) darkBtn.textContent = 'الوضع الفاتح ☀️';
}

document.addEventListener('DOMContentLoaded', () => {
    const grid = document.querySelector('.news-grid');
    if (!grid) return;
    
    let savedArticles = JSON.parse(localStorage.getItem('articles') || "[]");
    
    // إدراج الأخبار بشكل ديناميكي من الذاكرة إلى الواجهة الرئيسية
    savedArticles.reverse().forEach(a => {
        let card = document.createElement('div');
        card.className = 'news-card';
        
        let imgStyle = (a.image && a.image.trim() !== '') ? `background-image: url('${a.image}')` : `background-color: var(--primary)`;
        let shortContent = a.content.length > 100 ? a.content.substring(0, 100) + '...' : a.content;
        
        card.innerHTML = `
            <div class="card-image" style="height: 240px; width: 100%; background-size: cover; background-position: center; border-bottom: 1px solid var(--border); ${imgStyle}"></div>
            <div class="card-content">
                <h3>${a.title}</h3>
                <p>${shortContent}</p>
                <a href="تفاصيل الخبر.html?id=${a.id}" class="read-more">اقرأ المزيد ←</a>
            </div>
        `;
        grid.prepend(card); // يتم إضافتها في أعلى الشبكة
    });
});
// نضع هذا الكود في ملف الجافاسكريبت الخاص بالصفحة الرئيسية
document.addEventListener("DOMContentLoaded", function() {
    displayWorkshops();
});

function displayWorkshops() {
    const grid = document.querySelector(".activity-grid"); // الحاوية التي تحتوي على الورشات
    if (!grid) return;

    // جلب الورشات من الـ localStorage
    let workshops = JSON.parse(localStorage.getItem("workshops")) || [];

    // مسح المحتوى الثابت (إذا أردت استبداله بالكامل بالديناميكي)
    // grid.innerHTML = ""; 
workshops.forEach(workshop => {
        const card = document.createElement("div");
        card.className = "activity-box"; // نفس كلاس التنسيق للبطاقات الثابتة

        card.innerHTML = `
            <div class="icon">${workshop.emoji || "🛠️"}</div>
            <h3>${workshop.title || "ورشة جديدة"}</h3>
            <p>${workshop.content || ""}</p>
        `;
        grid.appendChild(card);
    });
}

