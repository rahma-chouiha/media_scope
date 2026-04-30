
const isDark = localStorage.getItem("theme") === "dark";
if (isDark) document.body.classList.add("dark-mode");

let workshopsList = JSON.parse(localStorage.getItem("workshops")) || [];
document.addEventListener("DOMContentLoaded", displayWorkshops);

function createRestorePoint(currentWorkshops) {
    localStorage.setItem("workshops_backup", JSON.stringify(currentWorkshops));
}



function createRestorePoint(currentWorkshops) {
    localStorage.setItem("workshops_backup", JSON.stringify(currentWorkshops));
}

function restoreLastPoint() {
    let backup = localStorage.getItem("workshops_backup");
    if (backup) {
        workshopsList = JSON.parse(backup);
        localStorage.setItem("workshops", JSON.stringify(workshopsList));
        displayWorkshops();
        alert("تم استعادة النقطة السابقة بنجاح");
    } else {
        alert("لا توجد نقطة استعادة");
    }
}
function saveToMemory() {
    localStorage.setItem("workshops", JSON.stringify(workshopsList));
}
function addWorkshop() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const emoji = document.getElementById('emoji').value; // جلب الإيموجي

    if (title && content && emoji) {
        // إضافة الورشة الجديدة
        const newWorkshop = {
            id: Date.now(),
            title: title,
            content: content,
            emoji: emoji
        };

        createRestorePoint(workshopsList);
        workshopsList.push(newWorkshop);
        saveToMemory();
        displayWorkshops();

        alert("تم نشر الورشة بنجاح!");

        document.getElementById('title').value = "";
        document.getElementById('content').value = "";
        document.getElementById('emoji').value = "";
    } else {
        alert("يرجى ملء جميع الحقول ووضع إيموجي!");
    }

}

function displayWorkshops() {
    const container = document.getElementById("workshopsList");
    if (!container) return;
    container.innerHTML = "";

    workshopsList.forEach(workshop => {
        const div = document.createElement("div");
        div.className = "article";
        div.innerHTML = `
            <h4>${workshop.emoji || "🛠️"} ${workshop.title}</h4>
            <button class="btn-delete" onclick="deleteWorkshop(${workshop.id})">حذف</button>
        `;
        container.appendChild(div);
    });
}


function deleteWorkshop(id) {
    if(confirm("هل أنت متأكد؟ (يمكنك التراجع)")) {
        createRestorePoint(  workshopsList);
       workshopsList =   workshopsList.filter(a => a.id !== id);
        saveToMemory();
        displayWorkshops();
    }
}
window.addWorkshop = addWorkshop;
window.deleteWorkshop = deleteWorkshop;
window.restoreLastPoint = restoreLastPoint;

