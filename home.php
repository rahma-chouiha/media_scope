<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: loginRegister.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نادي جامعة الأغواط الذكي</title>
    <!-- ربط ملف CSS لواجهة الرئيسية -->
    
    
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<link rel="stylesheet" href="home.css">
    <nav class="navbar">
        <div class="logo">Media<span>Scope</span></div>
        <ul class="nav-links">
            <li class="dropdown"><a href="home.php">الرئيسية</a></li>  
  <li class="dropdown"> <a href="#">الأخبار</a>
            <ul class="dropdown-content">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
    <li>
        <a href="add_article.php">إضافة خبر</a>
    </li>
<?php } ?>
        <li><a href="تفاصيل الخبر.html" class="btn-add"> خبر </a></li>
        </ul>
            </li>
       <li class="dropdown">
    <a href="#">الأنشطة </a>
    <ul class="dropdown-content">
        <li><a href="#workshops">ورشات العمل</a></li>
   <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
    <li>
        <a href="اضافة ورشة عمل.html">اضافة ورشات عمل</a>
    </li>
<?php } ?>
        
    </ul>
</li>
      <li class="dropdown">
    <a href="#">النوادي </a>
    <ul class="dropdown-content">
        <li><a href="#competitions">Unebyt</a></li>
        <li><a href="#competitions">نادي مستقبل </a></li>
        <li><a href="#competitions">boomtch</a></li>
    
        
    </ul>
</li>
       
      <li class="dropdown">
            <li><a href="#footer" >تواصل معنا </a></li>
            
            <li><a href="#" class="btn-dark">الوضع الليلي</a></li>
             <a href="logout.php">تسجيل الخروج</a>
            </li>
        </ul>
    
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>مرحباً بكم في ملتقى الإبداع الطلابي</h1>
            <p>منصة رقمية تجمع أخبار النادي، الفعاليات، ومصادر التعلم في مكان واحد.</p>
           <a href="#about-section" class="cta-btn">اكتشف نشاطاتنا</a>
        </div>
    </header>
  <main>
    <section id="about-section" class="about-us">
    <div class="container">
        <h2>من نحن؟</h2>
        <p>نحن نادٍ جامعي يهدف إلى تمكين الطلبة تقنياً وإبداعياً من خلال ورش عمل وفعاليات مستمرة.</p>
        
        <div class="features">
            <div class="feature-box">
                <h3>رؤيتنا</h3>
                <p>بناء جيل واعٍ تقنياً وقادر على الابتكار.</p>
            </div>
            <div class="feature-box">
                <h3>أهدافنا</h3>
                <p>تنظيم دورات، مسابقات، ومشاريع برمجية مشتركة.</p>
            </div>
        </div>
    </div>
</section>

    <section class="news-section">
        <h2 class="section-title">آخر أخبار النادي</h2>
        <div class="news-grid">
            <div class="news-card">
                <div class="card-image"></div>
                <div class="card-content">
                    <h3>ورشة العمل البرمجية</h3>
                    <p>انضم إلينا في ورشة العمل القادمة حول تطوير تطبيقات الويب باستخدام Django.</p>
                    <a href="#" class="read-more">اقرأ المزيد ←</a>
                </div>
            </div>
            <div class="news-card">
                <div class="card-image1"></div>
                <div class="card-content">
                    <h3>مسابقة الابتكار 2026</h3>
                    <p>تعلن الجامعة عن فتح باب التسجيل في مسابقة الابتكار السنوية لجميع التخصصات.</p>
                    <a href="#" class="read-more">اقرأ المزيد ←</a>
                </div>
            </div>
        </div>
    </section>
    <section id="workshops" class="activity-section">
    <div class="container">
        <h2>ورشات العمل القادمة</h2>
    
        <div class="activity-grid">
            <div class="activity-box">
                <div class="icon">💻</div>
                <h3>تطوير الويب</h3>
                <p>تعلم أساسيات Django و React لبناء مواقع متكاملة.</p>
            </div>
            <div class="activity-box">
                <div class="icon">🤖</div>
                <h3>الذكاء الاصطناعي</h3>
                <p>مقدمة في تعلم الآلة باستخدام لغة Python.</p>
            </div>
        </div>
    </div>
</section>
</main>
<footer id="footer">
    <h2>تواصل معنا</h2>
     <p> &copy; media_scope News 2026</p>

</footer>
<script src="home.js"></script>
</body>
</html>