<?php
session_start();

// Nạp Composer Autoload
require __DIR__ . '/../vendor/autoload.php';

use QLPhongTro\Config\Database;

// Controller
use QLPhongTro\Controllers\UserController;
use QLPhongTro\Controllers\RoleController;
use QLPhongTro\Controllers\DiaDiemController;
use QLPhongTro\Controllers\PhongTroController;
use QLPhongTro\Controllers\PhongTroHinhAnhController;
use QLPhongTro\Controllers\KhachHangController;
use QLPhongTro\Controllers\NhanVienController;
use QLPhongTro\Controllers\KhachHangYeuThichController;
use QLPhongTro\Controllers\AD_RC;
use QLPhongTro\Controllers\ContactController;
use QLPhongTro\Controllers\ProfileController;

// Kết nối CSDL
$db = Database::getInstance();
$conn = $db->getConnection();

// Khởi tạo Controller
$userController         = new UserController($conn);
$roleController         = new RoleController($conn);
$diaDiemController      = new DiaDiemController($conn);
$phongTroController     = new PhongTroController($conn);
$phongTroHAController   = new PhongTroHinhAnhController($conn);
$khachHangController    = new KhachHangController($conn);
$nhanVienController     = new NhanVienController($conn);
$yeuThichController = new KhachHangYeuThichController($conn);
$ARController     = new AD_RC($conn);
$contactController = new ContactController($conn);
$profileController = new ProfileController($conn);
// Xác định hành động
$action = $_GET['action'] ?? 'home';

// Định tuyến 
switch ($action) {
    // ---------- USER ----------
    case 'login':        $userController->showLogin(); break;
    case 'do_login':     $userController->login(); break;

    case 'register':     $userController->showRegister(); break;
    case 'do_register':  $userController->register(); break;

    case 'logout': $userController->logout(); break;
    // case 'profile':           $userController->profile(); break;
    // case 'update_profile':    $userController->updateProfile(); break;

    // ---------- ROLE ----------
    case 'role_index':    $roleController->index(); break;
    case 'role_show':     $roleController->show($_GET['id'] ?? 0); break;
    case 'role_create':   $roleController->createForm(); break;
    case 'role_store':    $roleController->store(); break;
    case 'role_edit':     $roleController->editForm($_GET['id'] ?? 0); break;
    case 'role_update':   $roleController->update($_GET['id'] ?? 0); break;
    case 'role_delete':   $roleController->delete($_GET['id'] ?? 0); break;

    // ---------- DIA DIEM ----------
    case 'diadiem_index':     $diaDiemController->index(); break;
    case 'diadiem_show':      $diaDiemController->show($_GET['id'] ?? 0); break;
    case 'diadiem_create':    $diaDiemController->createForm(); break;
    case 'diadiem_store':     $diaDiemController->store(); break;
    case 'phongtro_by_location': $diaDiemController->phongTroTheoDiaDiem($_GET['id'] ?? 0); break;
    
    

    // ---------- PHONG TRO ----------
    case 'phongtro_index':     $phongTroController->index(); break;
    case 'phongtro_show':      $phongTroController->show($_GET['id'] ?? 0); break;
    case 'phongtro_create':    $phongTroController->createForm(); break;
    case 'phongtro_store':     $phongTroController->store(); break;
    case 'phongtro_edit':      $phongTroController->editForm($_GET['id'] ?? 0); break;
    case 'phongtro_update':    $phongTroController->update($_GET['id'] ?? 0); break;
    case 'phongtro_delete':    $phongTroController->delete($_GET['id'] ?? 0); break;
    case 'phongtro_search':    $phongTroController->search(); break;
    case 'phongtro_detail': $phongTroController->detailPage($_GET['id'] ?? 0); break;
    case 'phongtro_list_by_diadien':
        $diaDiemId = $_GET['diaDiem_id'] ?? 0;
        $phongTroController->listByDiaDiem($diaDiemId);
        break;
    case 'phongtro_roompage': $phongTroController->roomPage(); break;
    case 'phongtro_find': $phongTroController->find(); break;    

    // ---------- PHONGTRO HINHANH ----------
    case 'phongtrohinhanh_index':
        $phongTroHAController->index($_GET['id'] ?? 0);
        break;
    case 'phongtrohinhanh_upload':
        $phongTroHAController->upload($_GET['id'] ?? 0);
        break;
    case 'phongtrohinhanh_delete':
        $phongTroHAController->delete($_GET['image_id'] ?? 0, $_GET['phongtro_id'] ?? 0);
        break;

    // ---------- CONTACT ----------
    // case 'contact':
    //     $contactController->show();
    //     break;
    

    // ---------- TIN TỨC ----------
    case 'news': 
        $newsController = new \QLPhongTro\Controllers\NewsController();
        $newsController->index(); 
        break;

    // ---------- KHACH HANG ----------
    case 'khachhang_index':           $khachHangController->index(); break;
    case 'khachhang_show':            $khachHangController->show($_GET['id'] ?? 0); break;
    case 'khachhang_yeuthich':        $khachHangController->yeuThich($_GET['userId'] ?? 0); break;
    case 'khachhang_add_fav':         $khachHangController->themYeuThich($_GET['userId'] ?? 0, $_GET['phongTroId'] ?? 0); break;
    case 'khachhang_remove_fav':      $khachHangController->xoaYeuThich($_GET['userId'] ?? 0, $_GET['phongTroId'] ?? 0); break;

    // ---------- LIÊN HỆ ----------
    case 'contact':        $contactController->index(); break;
    case 'contact_submit': $contactController->submit(); break;

    // ---------- PROFILE ----------
    case 'profile':
        $profileController = new QLPhongTro\Controllers\ProfileController($conn);
        $profileController->showProfile();
        break;

    case 'update_profile':
        $profileController = new QLPhongTro\Controllers\ProfileController($conn);
        $profileController->updateProfile();
        break;

    case 'change_password':
        $profileController = new QLPhongTro\Controllers\ProfileController($conn);
        $profileController->showChangePassword();
        break;

    case 'do_change_password':
        $profileController = new QLPhongTro\Controllers\ProfileController($conn);
        $profileController->changePassword();
        break;

    // ---------- YEU THICH ----------
    case 'yeuthich_index': 
        $yeuThichController->index($_GET['user'] ?? 0); 
        break;

    case 'yeuthich_add': 
        $yeuThichController->add($_GET['user'] ?? 0, $_GET['phong'] ?? 0); 
        break;

    case 'yeuthich_remove': 
        $yeuThichController->remove($_GET['user'] ?? 0, $_GET['phong'] ?? 0); 
        break;
    
    // ---------- NHAN VIEN ----------
    case 'nhanvien_index':        $nhanVienController->index(); break;
    case 'nhanvien_show':         $nhanVienController->show($_GET['id'] ?? 0); break;
    case 'nhanvien_create':       $nhanVienController->createForm(); break;
    case 'nhanvien_store':        $nhanVienController->store(); break;

    // ---------- TRANG CHỦ ----------
    case 'admin_home':
        include __DIR__ . '/../src/views/user/admin_home.php';
        break;
    case 'home':
    default:
        include __DIR__ . '/../src/views/homepage.php';
        break;

    // ---------- ADMIN UI ----------
    case 'manager':
        include __DIR__ . '/../src/views/admin/layouts/main.php';
        break;
    case 'user_index': $userController->index(); break;
    case 'room_index':
        $ARController->index(); // ✅ Dùng lại biến đã khởi tạo bên trên
        break;
    
    case 'room_get':
        $ARController->get();
        break;
    
    case 'room_create':
        $ARController->create();
        break;
    
    case 'room_update':
        $ARController->update();
        break;
    
    case 'room_delete':
        $ARController->delete();
        break;

}    