<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tính Phí Bảo Hiểm</title>
  <link rel="stylesheet" href="public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="public/images/tinhphi_logo.png" alt="Logo" width="200" class="d-inline-block align-text-top">
      </a>
    </div>
  </nav>
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-12">
        <div class="text-danger p-3 fs-2 fw-bold">Tính Phí Bảo Hiểm Dai-Ichi</div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 d-flex justify-content-end p-2">
        <button type="button" class="btn btn-success">Xem ngành nghề</button>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12 p-0 pt-3">
          <div class="accordion w-100" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="padding: 5px;">
                  <span class="accordion-number">1</span> NGƯỜI ĐƯỢC BH CHÍNH
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form class="w-100">
                    <!-- Name input -->
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoVaTen" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="email" class="form-control shadow-sm" id="hoVaTen" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh">
                            <option value="1" selected>Nam</option>
                            <option value="2">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="date" class="form-control shadow-sm" id="ngaySinh" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="number" class="form-control shadow-sm" id="tuoi" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <input type="number" class="form-control shadow-sm" id="nhomNghe" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="goiBaoHiem" class="form-label m-0 text-start text-label">Gói bảo hiểm</label>
                          <select class="form-select" aria-label="Default select example" id="goiBaoHiem">
                            <option value="1" selected>AN TÂM SONG HÀNH</option>
                            <option value="2">AN THỊNH ĐÀU TƯ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="thoiHan" class="form-label m-0 text-start text-label">Thời hạn (Năm)</label>
                          <input type="number" class="form-control shadow-sm" id="thoiHan" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="soTienBaoHiem1" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="soTienBaoHiem1" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="phiCoban1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="phiCoban1" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru">
                          <label class="form-check-label text-black" for="noiTru">
                            NỘI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru20">
                          <label class="form-check-label text-black" for="noiTru20">
                            NỘI TRÚ ĐỒNG CHI TRẢ 20%
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="ngoaiTru">
                          <label class="form-check-label text-black" for="ngoaiTru">
                            NGOẠI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="taiNanCC">
                          <label class="form-check-label text-black" for="taiNanCC">
                            TAI NẠN CC
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi">
                          <label class="form-check-label text-black" for="hoTroVienPhi">
                            HỖ TRỢ VIỆN PHÍ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon">
                            <option value="1" selected>10000</option>
                            <option value="2">20000</option>
                            <option value="3">30000</option>
                            <option value="4">40000</option>
                            <option value="5">50000</option>
                            <option value="6">60000</option>
                            <option value="7">70000</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="hoTroVienPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap">
                          <label class="form-check-label text-black" for="BHNCaoCap">
                            BHN CAO CẤP TOÀN DIỆN
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHUngThu">
                          <label class="form-check-label text-black" for="BHUngThu">
                            BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <hr style="color: red;">
                    <div class="row">
                      <table class="table table-bordered">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỮA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1">Xóa</button>
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="padding: 5px;">
                  <span class="accordion-number">2</span> NGƯỜI ĐƯỢC BH BỔ SUNG 1
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form class="w-100">
                    <!-- Name input -->
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoVaTen" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="email" class="form-control shadow-sm" id="hoVaTen" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh">
                            <option value="1" selected>Nam</option>
                            <option value="2">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="date" class="form-control shadow-sm" id="ngaySinh" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="number" class="form-control shadow-sm" id="tuoi" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <input type="number" class="form-control shadow-sm" id="nhomNghe" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru">
                          <label class="form-check-label text-black" for="noiTru">
                            NỘI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru20">
                          <label class="form-check-label text-black" for="noiTru20">
                            NỘI TRÚ ĐỒNG CHI TRẢ 20%
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="ngoaiTru">
                          <label class="form-check-label text-black" for="ngoaiTru">
                            NGOẠI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="taiNanCC">
                          <label class="form-check-label text-black" for="taiNanCC">
                            TAI NẠN CC
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi">
                          <label class="form-check-label text-black" for="hoTroVienPhi">
                            HỖ TRỢ VIỆN PHÍ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon">
                            <option value="1" selected>10000</option>
                            <option value="2">20000</option>
                            <option value="3">30000</option>
                            <option value="4">40000</option>
                            <option value="5">50000</option>
                            <option value="6">60000</option>
                            <option value="7">70000</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="hoTroVienPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap">
                          <label class="form-check-label text-black" for="BHNCaoCap">
                            BHN CAO CẤP TOÀN DIỆN
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHUngThu">
                          <label class="form-check-label text-black" for="BHUngThu">
                            BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <hr style="color: red;">
                    <div class="row">
                      <table class="table table-bordered">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỮA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1">Xóa</button>
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="padding: 5px;">
                  <span class="accordion-number">3</span> NGƯỜI ĐƯỢC BH BỔ SUNG 2
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form class="w-100">
                    <!-- Name input -->
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoVaTen" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="email" class="form-control shadow-sm" id="hoVaTen" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh">
                            <option value="1" selected>Nam</option>
                            <option value="2">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="date" class="form-control shadow-sm" id="ngaySinh" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="number" class="form-control shadow-sm" id="tuoi" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <input type="number" class="form-control shadow-sm" id="nhomNghe" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru">
                          <label class="form-check-label text-black" for="noiTru">
                            NỘI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru20">
                          <label class="form-check-label text-black" for="noiTru20">
                            NỘI TRÚ ĐỒNG CHI TRẢ 20%
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="ngoaiTru">
                          <label class="form-check-label text-black" for="ngoaiTru">
                            NGOẠI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="taiNanCC">
                          <label class="form-check-label text-black" for="taiNanCC">
                            TAI NẠN CC
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi">
                          <label class="form-check-label text-black" for="hoTroVienPhi">
                            HỖ TRỢ VIỆN PHÍ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon">
                            <option value="1" selected>10000</option>
                            <option value="2">20000</option>
                            <option value="3">30000</option>
                            <option value="4">40000</option>
                            <option value="5">50000</option>
                            <option value="6">60000</option>
                            <option value="7">70000</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="hoTroVienPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap">
                          <label class="form-check-label text-black" for="BHNCaoCap">
                            BHN CAO CẤP TOÀN DIỆN
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHUngThu">
                          <label class="form-check-label text-black" for="BHUngThu">
                            BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <hr style="color: red;">
                    <div class="row">
                      <table class="table table-bordered">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỮA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1">Xóa</button>
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="padding: 5px;">
                  <span class="accordion-number">4</span> NGƯỜI ĐƯỢC BH BỔ SUNG 3
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <form class="w-100">
                    <!-- Name input -->
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoVaTen" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="email" class="form-control shadow-sm" id="hoVaTen" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh">
                            <option value="1" selected>Nam</option>
                            <option value="2">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="date" class="form-control shadow-sm" id="ngaySinh" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="number" class="form-control shadow-sm" id="tuoi" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <input type="number" class="form-control shadow-sm" id="nhomNghe" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru">
                          <label class="form-check-label text-black" for="noiTru">
                            NỘI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru20">
                          <label class="form-check-label text-black" for="noiTru20">
                            NỘI TRÚ ĐỒNG CHI TRẢ 20%
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="ngoaiTru">
                          <label class="form-check-label text-black" for="ngoaiTru">
                            NGOẠI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon">
                            <option value="1" selected>Phổ Thông</option>
                            <option value="2">Đặt Biệt</option>
                            <option value="3">Cao cấp</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4"></div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="taiNanCC">
                          <label class="form-check-label text-black" for="taiNanCC">
                            TAI NẠN CC
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi">
                          <label class="form-check-label text-black" for="hoTroVienPhi">
                            HỖ TRỢ VIỆN PHÍ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon">
                            <option value="1" selected>10000</option>
                            <option value="2">20000</option>
                            <option value="3">30000</option>
                            <option value="4">40000</option>
                            <option value="5">50000</option>
                            <option value="6">60000</option>
                            <option value="7">70000</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="hoTroVienPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap">
                          <label class="form-check-label text-black" for="BHNCaoCap">
                            BHN CAO CẤP TOÀN DIỆN
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHUngThu">
                          <label class="form-check-label text-black" for="BHUngThu">
                            BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuTienBH" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuTienBH" oninput="updateAmountText(this)" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
                    </div>

                    <hr style="color: red;">
                    <div class="row">
                      <table class="table table-bordered">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỮA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                            <td class="text-danger fw-bold">1000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1">Xóa</button>
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="w-100 mb-2" style="overflow-x: hidden;">
    <div class="row">
      <div class="col-sm-12 d-flex justify-content-center mt-3 text-bg-light">
        <div class="text-success pt-2 pb-2 fs-5 fw-bold text-decoration-underline">Tổng cộng phí</div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">QUÝ (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">Nửa năm (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold">Năm (VNĐ): 0</div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="./index.js"></script>

</html>