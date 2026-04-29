const isDark = localStorage.getItem("theme") === "dark";
if (isDark) document.body.classList.add("dark-mode");

let articles = JSON.parse(localStorage.getItem("articles") || "[]");
document.addEventListener("DOMContentLoaded", displayArticles);

function createRestorePoint(currentArticles) {
    localStorage.setItem("articles_backup", JSON.stringify(currentArticles));
}

function restoreLastPoint() {
    let backup = localStorage.getItem("articles_backup");
    if (backup) {
        articles = JSON.parse(backup);
        localStorage.setItem("articles", JSON.stringify(articles));
        displayArticles();
        alert("تم استعادة النقطة السابقة بنجاح");
    } else {
        alert("لا توجد نقطة استعادة");
    }
}

function saveToMemory() {
    localStorage.setItem("articles", JSON.stringify(articles));
}

function addArticle() {
    let title = document.getElementById("title").value;
    let content = document.getElementById("content").value;
    let image = document.getElementById("image").value;

    if (!title || !content) {
        alert("يرجى ملء العنوان والمحتوى");
        return;
    }

    createRestorePoint(articles);
    let article = { id: Date.now(), title: title, content: content, image: image, date: new Date().toLocaleDateString("ar-AE") };
    articles.push(article);
    saveToMemory();
    displayArticles();
    
    document.getElementById("title").value = "";
    document.getElementById("content").value = "";
    document.getElementById("image").value = "";
}

function displayArticles() {
    let container = document.getElementById("articlesList");
    if (!container) return;
    container.innerHTML = "";

    articles.forEach(a => {
        let div = document.createElement("div");
        div.className = "article";
        div.innerHTML = `<h4>${a.title}</h4> <button class="btn-delete" onclick="deleteArticle(${a.id})">حذف</button>`;
        container.appendChild(div);
    });
}

function deleteArticle(id) {
    if(confirm("هل أنت متأكد؟ (يمكنك التراجع)")) {
        createRestorePoint(articles);
        articles = articles.filter(a => a.id !== id);
        saveToMemory();
        displayArticles();
    }
}

window.addArticle = addArticle;
window.deleteArticle = deleteArticle;
window.restoreLastPoint = restoreLastPoint;
