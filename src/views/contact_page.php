<?php
ob_start();
?>

<link rel="stylesheet" href="/public/styles/contact/style.css">

<div class="contact-container">
    <div class="contact-wrapper">

        <div class="contact-form-section">
            <div class="contact-content">
                <div class="contact-form-card">
                    <div class="form-header">
                        <h2 class="form-title">Liên Hệ</h2>
                        <p class="form-subtitle">
                            Mọi thắc mắc liên hệ với chúng tôi theo hướng dẫn bên dưới!
                        </p>
                    </div>

                    <form action="#" method="POST" style="width: 100%;">
                        <div class="form-group">
                            <div class="input-container">
                                <input type="text" name="name" placeholder="Họ & Tên" class="form-input" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <input type="email" name="email" placeholder="Mail" class="form-input" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <input type="tel" name="phone" placeholder="Số Điện Thoại" class="form-input" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="textarea-container">
                                <textarea name="message" placeholder="Nội Dung" class="form-textarea"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="submit-button">GỬI NGAY</button>
                    </form>
                </div>

                <div class="contact-info-section">
                    <div class="info-header">
                        <h2 class="info-title">THÔNG TIN LIÊN HỆ</h2>
                    </div>

                    <div class="info-content">
                        <div class="info-item">
                            <img class="info-icon" alt="Email icon"
                                src="https://c.animaapp.com/9cQhdlZc/img/frame.svg" />
                            <div class="info-text">info@gmail.com</div>
                        </div>

                        <div class="info-item">
                            <img class="info-icon" alt="Phone icon"
                                src="https://c.animaapp.com/9cQhdlZc/img/vector.svg" />
                            <div class="info-text">+84345651206</div>
                        </div>

                        <div class="info-item">
                            <img class="info-icon" alt="Location icon"
                                src="https://c.animaapp.com/9cQhdlZc/img/vector-2.svg" />
                            <div class="info-text">Thủ Đức, Tp. Hồ Chí Minh</div>
                        </div>

                        <div class="info-item">
                            <img class="info-icon" alt="Website icon"
                                src="https://c.animaapp.com/9cQhdlZc/img/vector-2.svg" />
                            <div class="info-text">www.timtro24h.com</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="map-container">
            <?php include __DIR__ . '/components/Home/map.php'; ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layouts/main.php'; ?>