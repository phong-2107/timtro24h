<?php
// views/admin/create-room/index.php

// Import các model nếu cần thiết
// use QLPhongTro\Models\PhongTro;
// use QLPhongTro\Models\DiaDiem;

// Lấy danh sách địa điểm để hiển thị trong dropdown
// $diaDiemModel = new DiaDiem($dbConn);
// $diaDiems = $diaDiemModel->getAll();
?>

<div class="create-room-page">
    <div class="form-container">
        <div class="page-title">
            <h2>Thêm tin phòng</h2>
        </div>
        <form class="room-form" method="post" action="/admin/room/store" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-field">
                    <label for="tieuDe">Tiêu đề</label>
                    <input type="text" id="tieuDe" name="tieuDe" class="form-input" required />
                </div>
                
                <div class="form-field">
                    <label for="diaDiem_id">Địa điểm</label>
                    <select id="diaDiem_id" name="diaDiem_id" class="form-input" required>
                        <option value="">-- Chọn địa điểm --</option>
                        <?php 
                        // if (isset($diaDiems) && is_array($diaDiems)) {
                        //     foreach ($diaDiems as $diaDiem) {
                        //         echo '<option value="' . $diaDiem['id'] . '">' . $diaDiem['tinhThanh'] . ' - ' . $diaDiem['quanHuyen'] . '</option>';
                        //     }
                        // }
                        ?>
                    </select>
                </div>
                
                <div class="form-field">
                    <label for="dienTich">Diện tích (m²)</label>
                    <input type="text" id="dienTich" name="dienTich" class="form-input" required />
                </div>
                
                <div class="form-field">
                    <label for="gia">Giá (VNĐ)</label>
                    <input type="text" id="gia" name="gia" class="form-input" required />
                </div>
                
                <div class="form-field">
                    <label for="trangThai">Trạng thái</label>
                    <select id="trangThai" name="trangThai" class="form-input" required>
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                
                <div class="form-field">
                    <label for="diaChiCuThe">Địa chỉ cụ thể</label>
                    <input type="text" id="diaChiCuThe" name="diaChiCuThe" class="form-input" required />
                </div>
                
                <div class="form-field description-field">
                    <label for="moTa">Mô tả</label>
                    <textarea 
                        id="moTa" 
                        name="moTa"
                        class="form-input description-textarea" 
                        rows="5"
                        required
                    ></textarea>
                </div>
                
                <div class="form-field image-field">
                    <label>Ảnh phòng</label>
                    <div class="image-upload-container">
                        <label for="roomImages" class="image-upload-btn">
                            <span class="upload-icon">+</span>
                            <span>Chọn ảnh phòng</span>
                        </label>
                        <input 
                            type="file" 
                            id="roomImages"
                            name="roomImages[]" 
                            accept="image/*" 
                            multiple 
                            style="display: none;"
                            required
                        />
                    </div>
                    
                    <div class="image-previews-wrapper" id="imagePreviews">
                        <!-- Image previews will be displayed here dynamically via JavaScript -->
                    </div>
                </div>
            </div>
            
            <!-- Thêm hidden field cho người đăng nếu cần thiết -->
            <input type="hidden" name="nguoiDang_id" value="<?php //echo $_SESSION['user_id'] ?? 1; ?>" />
            
            <div class="form-actions">
                <button type="submit" class="submit-btn">Xác nhận</button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript for handling image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('roomImages');
        const previewContainer = document.getElementById('imagePreviews');
        let selectedImages = [];
        
        imageInput.addEventListener('change', function(e) {
            if (this.files) {
                const files = Array.from(this.files);
                files.forEach(file => {
                    // Create file reader to read the file as data URL
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Add to selected images array
                        selectedImages.push(e.target.result);
                        
                        // Create and display the preview
                        displayImagePreview(e.target.result);
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        });
        
        function displayImagePreview(src) {
            // Create preview container
            const previewItem = document.createElement('div');
            previewItem.className = 'image-preview-item';
            
            // Create image element
            const img = document.createElement('img');
            img.src = src;
            img.className = 'preview-image';
            img.alt = 'Preview';
            
            // Create remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-image-btn';
            removeBtn.textContent = '×';
            removeBtn.onclick = function() {
                // Remove from selected images array
                const index = selectedImages.indexOf(src);
                if (index > -1) {
                    selectedImages.splice(index, 1);
                }
                
                // Remove from DOM
                previewContainer.removeChild(previewItem);
            };
            
            // Append elements to preview item
            previewItem.appendChild(img);
            previewItem.appendChild(removeBtn);
            
            // Append to preview container
            previewContainer.appendChild(previewItem);
        }
    });
</script>