<?php if (!empty($news)): ?>
<div class="news <?= $className ?? '' ?>">
    <div class="frame-wrapper">
        <div class="frame-13"></div>
    </div>

    <div class="header-2">
        <div class="frame-14">
            <p class="p"><?= htmlspecialchars($news['title'] ?? '') ?></p>
        </div>
        <div class="frame-14">
            <p class="text-wrapper-12"><?= htmlspecialchars($news['content'] ?? '') ?></p>
        </div>
    </div>
</div>
<?php endif; ?>