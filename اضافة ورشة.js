
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
        // جلب الورشات القديمة أو إنشاء مصفوفة جديدة
        const workshops = JSON.parse(localStorage.getItem('workshops')) || [];
        
        // إضافة الورشة الجديدة
        const newWorkshop = {
            id: Date.now(),
            title: title,
            content: content,
            emoji: emoji
        };

        workshops.push(newWorkshop);
        localStorage.setItem('workshops', JSON.stringify(workshops));

        alert("تم نشر الورشة بنجاح!");
        window.location.reload(); // تحديث القائمة في صفحة التحكم
    } else {
        alert("يرجى ملء جميع الحقول ووضع إيموجي!");
    }

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