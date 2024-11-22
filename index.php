<?php

require 'vendor/autoload.php'; // Include Composer autoloader

use PhpOffice\PhpSpreadsheet\IOFactory;

try {
  // Specify the file path
  $filePathATSH = 'database/ATSH.xlsx';
  $filePathATDT = 'database/ATDT.xlsx';
  $filePathBHCCTD = 'database/BHCCTD.xlsx';
  $filePathCSSKTC = 'database/CSSKTC.xlsx';
  $filePathHTDTUT = 'database/HTDTUT.xlsx';
  $filePathHTVP = 'database/HTVP.xlsx';
  $filePathTNCC = 'database/TNCC.xlsx';

  // Load the spreadsheet file
  $spreadsheetATSH = IOFactory::load($filePathATSH);
  $spreadsheetATDT = IOFactory::load($filePathATDT);
  $spreadsheetBHCCTD = IOFactory::load($filePathBHCCTD);
  $spreadsheetCSSKTC = IOFactory::load($filePathCSSKTC);
  $spreadsheetHTDTUT = IOFactory::load($filePathHTDTUT);
  $spreadsheetHTVP = IOFactory::load($filePathHTVP);
  $spreadsheetTNCC = IOFactory::load($filePathTNCC);

  // Get the first sheet
  $sheetATSH = $spreadsheetATSH->getActiveSheet();
  $sheetATDT = $spreadsheetATDT->getActiveSheet();
  $sheetBHCCTD = $spreadsheetBHCCTD->getActiveSheet();
  $sheetCSSKTC = $spreadsheetCSSKTC->getActiveSheet();
  $sheetHTDTUT = $spreadsheetHTDTUT->getActiveSheet();
  $sheetHTVP = $spreadsheetHTVP->getActiveSheet();
  $sheetTNCC = $spreadsheetTNCC->getActiveSheet();

  // Convert the sheet data to an array
  $dataATSH = $sheetATSH->toArray();
  $dataATDT = $sheetATDT->toArray();
  $dataBHCCTD = $sheetBHCCTD->toArray();
  $dataCSSKTC = $sheetCSSKTC->toArray();
  $dataHTDTUT = $sheetHTDTUT->toArray();
  $dataHTVP = $sheetHTVP->toArray();
  $dataTNCC = $sheetTNCC->toArray();

  // Remove the header row
  $dataResultATSH = array_slice($dataATSH, 1);
  $dataResultATDT = array_slice($dataATDT, 1);
  $dataResultBHCCTD = array_slice($dataBHCCTD, 1);
  $dataResultCSSKTC = array_slice($dataCSSKTC, 1);
  $dataResultHTDTUT = array_slice($dataHTDTUT, 1);
  $dataResultHTVP = array_slice($dataHTVP, 1);
  $dataResultTNCC = array_slice($dataTNCC, 1);

  // Display the result
  // print_r($dataResult); // The result is stored in $dataResult
  // Encode $dataResult as JSON and print it for JavaScript
  echo '<script>';
  echo 'const dataResultATSH = ' . json_encode($dataResultATSH) . ';';
  echo 'const dataResultATDT = ' . json_encode($dataResultATDT) . ';';
  echo 'const dataResultBHCCTD = ' . json_encode($dataResultBHCCTD) . ';';
  echo 'const dataResultCSSKTC = ' . json_encode($dataResultCSSKTC) . ';';
  echo 'const dataResultHTDTUT = ' . json_encode($dataResultHTDTUT) . ';';
  echo 'const dataResultHTVP = ' . json_encode($dataResultHTVP) . ';';
  echo 'const dataResultTNCC = ' . json_encode($dataResultTNCC) . ';';
  echo '</script>';
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
  echo 'Error loading file: ', $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tính Phí Bảo Hiểm</title>
  <link rel="stylesheet" href="public/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Xem ngành nghề</button>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Xem và chọn Nhóm ngành nghề</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="customInputContainer">
              <div class="customInput">
                <div class="selectedData">Chọn nhóm ngành nghề</div>
                <i class="fa-solid fa-angle-right"></i>
              </div>
              <div class="options">
                <div class="searchInput">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên">
                </div>
                <ul>
                </ul>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-primary" id="chooseMajorBtn" onclick="setNhomNghe()">Chọn</button>
          </div>
        </div>
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
                          <label for="hoVaTen_1" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="text" class="form-control shadow-sm" id="hoVaTen_1" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh_1" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh_1" onchange="updateChiPhi(1, 'phiCoban_1')">
                            <option value="Nam" selected>Nam</option>
                            <option value="Nu">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh_1" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="date" class="form-control shadow-sm" id="ngaySinh_1" aria-describedby="emailHelp" onchange="calculateAge(this, 1)">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi_1" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="text" class="form-control shadow-sm" id="tuoi_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe_1" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <div class="d-flex align-items-center">
                            <input type="number" class="form-control shadow-sm" id="nhomNghe_1" disabled aria-describedby="emailHelp" onchange="updateChiPhi(1, 'phiCoban_1')">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="1">
                              <i class="ph ph-list-magnifying-glass fs-4"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="goiBaoHiem" class="form-label m-0 text-start text-label">Gói bảo hiểm</label>
                          <select class="form-select" aria-label="Default select example" id="goiBaoHiem" onchange="updateChiPhi(1, 'phiCoban_1')">
                            <option value="ATSH" selected>AN TÂM SONG HÀNH</option>
                            <option value="ATDT">AN THỊNH ĐÀU TƯ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="thoiHan" class="form-label m-0 text-start text-label">Thời hạn (Năm)</label>
                          <select class="form-select" aria-label="Default select example" id="thoiHan" onchange="updateChiPhi(1, 'phiCoban_1')">
                            <!-- render options from 11 to 76 -->
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26" selected>26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                            <option value="60">60</option>
                            <option value="61">61</option>
                            <option value="62">62</option>
                            <option value="63">63</option>
                            <option value="64">64</option>
                            <option value="65">65</option>
                            <option value="66">66</option>
                            <option value="67">67</option>
                            <option value="68">68</option>
                            <option value="69">69</option>
                            <option value="70">70</option>
                            <option value="71">71</option>
                            <option value="72">72</option>
                            <option value="73">73</option>
                            <option value="74">74</option>
                            <option value="75">75</option>
                            <option value="76">76</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="soTienBaoHiem_1" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="soTienBaoHiem_1" oninput="updateAmountText('soTienBaoHiem_1', 1, 'phiCoban_1')" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="phiCoban_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="phiCoban_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru_1" onchange="handleChecked('noiTru', 1)">
                          <label class="form-check-label text-black" for="noiTru_1">
                            NỘI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon_1" disabled onchange="handleChangeSelect('noiTru', 1)">
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao cấp</option>
                            <option value="co_ban">Cơ bản</option>
                            <option value="thinh_vuong">Thịnh vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTruWrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTruPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTruPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="noiTru20_1" onchange="handleChecked('noiTru20', 1)">
                          <label class="form-check-label text-black" for="noiTru20_1">
                            NỘI TRÚ ĐỒNG CHI TRẢ 20%
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon_1" disabled onchange="handleChangeSelect('noiTru20', 1)">
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao cấp</option>
                            <option value="co_ban">Cơ bản</option>
                            <option value="thinh_vuong">Thịnh vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTru20WrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTru20PhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTru20PhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="ngoaiTru_1" onchange="handleChecked('ngoaiTru', 1)">
                          <label class="form-check-label text-black" for="ngoaiTru_1">
                            NGOẠI TRÚ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon_1" disabled onchange="handleChangeSelect('ngoaiTru', 1)">
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao cấp</option>
                            <option value="co_ban">Cơ bản</option>
                            <option value="thinh_vuong">Thịnh vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="ngoaiTruWrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="ngoaiTruPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="ngoaiTruPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="taiNanCC_1"  onchange="handleCheckedWithInputMoney('taiNanCC', 1)">
                          <label class="form-check-label text-black" for="taiNanCC_1">
                            TAI NẠN CC
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH_1" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH_1" oninput="changeInputMoney('taiNanCC', 1)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi_1" onchange="handleCheckedWithInputMoney('hoTroVienPhi', 1)">
                          <label class="form-check-label text-black" for="hoTroVienPhi_1">
                            HỖ TRỢ VIỆN PHÍ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon_1" disabled onchange="changeInputMoney('hoTroVienPhi', 1)">
                            <option value="100000" selected>100.000</option>
                            <option value="200000">200.000</option>
                            <option value="300000">300.000</option>
                            <option value="400000">400.000</option>
                            <option value="500000">500.000</option>
                            <option value="600000">600.000</option>
                            <option value="700000">700.000</option>
                            <option value="800000">800.000</option>
                            <option value="900000">900.000</option>
                            <option value="1000000">1.000.000</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="hoTroVienPhiPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap_1" onchange="handleCheckedWithInputMoney('BHNCaoCap', 1)">
                          <label class="form-check-label text-black" for="BHNCaoCap_1">
                            BHN CAO CẤP TOÀN DIỆN
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapSotienBH_1" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapSotienBH_1" oninput="changeInputMoney('BHNCaoCap', 1)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" value="" id="BHUngThu_1" onchange="handleCheckedWithInputMoney('BHUngThu', 1)">
                          <label class="form-check-label text-black" for="BHUngThu_1">
                            BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuSotienBH_1" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuSotienBH_1" oninput="changeInputMoney('BHUngThu', 1)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan_1" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <hr id="lineRed_1" style="color: red;" class="d-none">
                    <div class="row">
                      <table class="table table-bordered d-none" id="tableMain_1">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỮA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold" id="phiQuy_1">1000</td>
                            <td class="text-danger fw-bold" id="phiNuaNam_1">1000</td>
                            <td class="text-danger fw-bold" id="phi1Nam_1">1000</td>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan" class="form-label m-0 text-start text-label">Phi cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="BHUngThuPhiCoBan" aria-describedby="emailHelp">
                        </div>
                      </div>
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
                      <table class="table table-bordered d-none">
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
  let ages = [];
  dataResultATSH.forEach(row => {
    // save row[0] is age
    ages.push(row[0]);
  });
  // sort ages and unique ages and get min and max
  ages = [...new Set(ages)].sort((a, b) => a - b);
  let minAge = ages[0];
  let maxAge = ages[ages.length - 1];


  // // Example: Process dataResult in JavaScript
  // dataResult.forEach(row => {
  //   console.log(`ID: ${row[0]}, Name: ${row[1]}, Age: ${row[2]}`);
  // });


  // =============== dropdown ===============
  let customInput = document.querySelector(".customInput");
  selectedData = document.querySelector(".selectedData");
  searchInput = document.querySelector(".searchInput input");
  ul = document.querySelector(".options ul");
  customInputContainer = document.querySelector(".customInputContainer");

  window.addEventListener("click", (e) => {
    if (document.querySelector(".searchInput").contains(e.target)) {
      document.querySelector(".searchInput").classList.add("focus");
    } else {
      document.querySelector(".searchInput").classList.remove("focus");
    }
  });

  var countries = [
    "Bảo vệ-Các cơ quan hành chính sự nghiệp/trường học/văn phòng công ty - Nhóm 1",
    "Bưu điện-Nhân viên quầy giao dịch/phân loại thư - Nhóm 1",
    "Buôn bán-Các mặt hàng THÔNG THƯỜNG và ít di chuyển xa - Nhóm 1",
    "Sản xuất xe-Kỹ sư, chủ cửa hàng, quản lý, bán hàng - Nhóm 1",
    "Cảnh sát/Công an-Nhân viên hành chính văn phòng (không có quân hàm) - Nhóm 1",
    "Nghề thông dụng-Hưu trí, Kinh doanh tự do, Nội trợ, Giúp việc nhà - Nhóm 1",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Hướng dẫn viên tại văn phòng (không theo đoàn) - Nhóm 1",
    "Ngành nghề khác-Nhân viên giữ xe - Nhóm 1",
    "Nhân viên văn phòng - Nhóm 1",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên phục vụ bàn, phục vụ phòng - Nhóm 1",
    "Điện ảnh/Truyền hình-Bán vé, phục vụ, vệ sinh - Nhóm 1",
    "Rừng-Kiểm lâm, phụ trách hành chính văn phòng, không tuần tra - Nhóm 1",
    "Ngư nghiệp/Sông-Trực tiếp nuôi trồng thủy sản trên đất liền/ao - Nhóm 1",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhà văn, Nhà thơ - Nhóm 1",
    "Nước-Kỹ sư, Quản lý, Giám sát viên - Nhóm 1",
    "Thể thao-Huấn huyện viên cử tạ, đường đua, tennis, cầu lông, bơi lội - Nhóm 1",
    "Trồng trọt-Nông dân (ruộng, rẫy, rau, hoa, củ, quả, bông, thuốc lá..) - Nhóm 1",
    "Y tế-Bác sĩ, y tá làm việc trong nhà tù/trại giam - Nhóm 1",
    "Y tế-Bác sĩ, y tá, điều dưỡng, dược sĩ, kĩ thuật viên xét nghiệm/gây mê - Nhóm 1",
    "Bưu điện-Kỹ sư, cán bộ quản lý - Nhóm 1",
    "Trẻ em - Nhóm 1",
    "Buôn bán-Trình dược viên, Tư vấn tài chính, Thu ngân, Thư ký - Nhóm 1",
    "Cảnh sát/Công an-Cán bộ hải quan (không có quân hàm công an) - Nhóm 1",
    "Chăn nuôi-Chăn nuôi gia súc/ gia cầm tại hộ gia đình, nuôi tằm - Nhóm 1",
    "Chăn nuôi-Người điều hành trang trại (không trực tiếp chăn nuôi) - Nhóm 1",
    "Bowling-Nhân viên vệ sinh - Nhóm 1",
    "Golf - Bowling-Quản lý, Công nhân bảo dưỡng, bảo trì sân golf - Nhóm 1",
    "Golf - Bowling-Huấn luyện viên, nhân viên lượm banh (cady) - Nhóm 1",
    "Hồ Bơi-Huấn luyện viên hồ bơi - Nhóm 1",
    "Golf - Bowling-Nhân viên ghi điểm, thu ngân, bán vé, phụ trách - Nhóm 1",
    "Điện ảnh/Truyền hình-Nhân viên điều hành trang thiết bị điện - Nhóm 1",
    "DV giải trí/Các lĩnh vực khác-Nhân viên điều hành trang thiết bị điện - Nhóm 1",
    "Điện ảnh/Truyền hình-Đạo diễn, Nhà sản xuất, Người viết kịch bản phim - Nhóm 1",
    "Điện ảnh/Truyền hình-Nghệ sĩ hóa trang, Nhân viên nhà hát kịch - Nhóm 1",
    "Điện ảnh/Truyền hình-Nhân viên phụ trách ánh sáng và tiếng động - Nhóm 1",
    "Điện ảnh/Truyền hình-Kỹ sư/quản lý/giám sát phòng điều khiển/chiếu phim - Nhóm 1",
    "Điện ảnh/Truyền hình-Nhân viên khâu kịch bản - Nhóm 1",
    "Điện ảnh/Truyền hình-Nhân viên khai thác/xử lý phim âm bản - Nhóm 1",
    "Điện ảnh/Truyền hình-Chủ nhiệm/phát hành phim/Người dẫn chương trình - Nhóm 1",
    "Điện ảnh/Truyền hình-Biên tập viên/ Phóng viên làm việc văn phòng - Nhóm 1",
    "Sản xuất giấy-Công nhân kiểm hàng hóa bao bì - Nhóm 1",
    "Dệt May/Giày Dép/Túi xách/Nón-Đốc công, công nhân may/thêu/trải vải - Nhóm 1",
    "Dệt May/Giày Dép/Túi xách/Nón-KCS/thợ may/thợ đóng giày, phân số - Nhóm 1",
    "Dệt May/Giày Dép/Túi xách/Nón-Nhân viên thiết kế, kỹ sư, quản lý - Nhóm 1",
    "Sản xuất Nhựa/Cao su/Da-Kỹ sư/ kỹ sư hóa giám sát, Quản lý - Nhóm 1",
    "Điện tử-Kỹ sư, Đốc công, Quản lý, Giám sát viên - Nhóm 1",
    "Ăn uống/Chế biến thực phẩm-Kỹ thuật viên, nghiên cứu sản phẩm mới - Nhóm 1",
    "Thuốc lá-Kỹ thuật viên - Nhóm 1",
    "Sản xuất xe-Công nhân/thợ sửa chữa, bảo trì xe đạp - Nhóm 1",
    "Sản xuất xe-Công nhân/ thợ rửa xe, thợ dán đề can (decal) các loại xe - Nhóm 1",
    "Xi măng/Vôi/Thạch cao-Kỹ sư, nhân viên làm việc văn phòng - Nhóm 1",
    "CNTT-Cử nhân, Kỹ sư (mạng máy tính/khoa học/kỹ thuật máy tính) - Nhóm 1",
    "CNTT-Chủ tiệm, nhân viên tiệm Internet/ Game; Kỹ sư kinh doanh - Nhóm 1",
    "CNTT-Kỹ thuật phần mềm/hệ thống thông tin/ truyền thông/đồ họa - Nhóm 1",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên hành chính văn phòng - Nhóm 1",
    "Giáo dục-Giáo viên, Giáo viên thể dục/giáo dục quốc phòng - Nhóm 1",
    "Giáo dục-Học sinh, Sinh viên (trừ sinh viên học viện quân sự), Học viên - Nhóm 1",
    "Hàng không-Lãnh đạo sân bay. Kiểm soát viên điều khiển không lưu - Nhóm 1",
    "Hàng không-Nhân viên hải quan/ văn phòng/ dịch vụ, soát vé, thu phí - Nhóm 1",
    "Hàng không-Nhân viên đài hoa tiêu - Nhóm 1",
    "Hàng không-Nhân viên vệ sinh sân bay, buồng lái. - Nhóm 1",
    "Hàng không-Phát ngôn viên - Nhóm 1",
    "Đường bộ-Nhân viên/Phụ trách văn phòng, trạm thu phí, bán vé xe - Nhóm 1",
    "Đường sắt-Ban giám đốc/Nhân viên/Kỹ sư văn phòng, phòng vé, dịch vụ - Nhóm 1",
    "Đường sắt-Nhân viên/bảo vệ chắn tàu, Soát vé, Phục vụ trên tàu - Nhóm 1",
    "Đường sắt-Trưởng ga, Phát thanh viên, Nhân viên vệ sinh tàu/sân ga. - Nhóm 1",
    "Cảng-Nhân viên hải quan - Nhóm 1",
    "Đường sông-Dân cư đi lại bằng ghe/thuyền ở vùng sông nước - Nhóm 1",
    "Chế biến gỗ-Nhân viên hành chính - Nhóm 1",
    "Rừng-Nghiên cứu thí nghiệm giống cây, nghiên cứu thổ nhưỡng - Nhóm 1",
    "Khai thác quặng/than đá/dầu khí mặt đất-Điều hành, văn phòng - Nhóm 1",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Quản lý, Thu ngân, Tiếp tân, Tư vấn - Nhóm 1",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên trực cửa/pha chế/dọn dẹp - Nhóm 1",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên kinh doanh - Nhóm 1",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên văn phòng - Nhóm 1",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Điều tra viên - Nhóm 1",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Giám đốc, Quản lý - Nhóm 1",
    "Ngành nghề khác-Công nhân tiệm giặt ủi - Nhóm 1",
    "Ngành nghề khác-Công nhân lau chùi/phụ việc vặt - Nhóm 1",
    "Ngành nghề khác-Giữ trẻ, Vú em - Nhóm 1",
    "Ngành nghề khác-Làm nhang, hàng mã - Nhóm 1",
    "Ngành nghề khác-Người môi giới (nội bộ) - Nhóm 1",
    "Ngành nghề khác-Nhân viên cân cầu đuờng - Nhóm 1",
    "Ngành nghề khác-Nhân viên nhà tắm hơi - Nhóm 1",
    "Ngành nghề khác-Nhân viên phòng công chứng - Nhóm 1",
    "Ngành nghề khác-Nhân viên phụ trách khai báo hải quan - Nhóm 1",
    "Chăm sóc sắc đẹp-Phun xăm thẩm mỹ, kỹ thuật viên Thẩm mỹ viện - Nhóm 1",
    "Ngành nghề khác-Nhân viên trạm sửa chữa - Nhóm 1",
    "Ngành nghề khác-Nhân viên viện bảo tàng - Nhóm 1",
    "Ngành nghề khác-Thầy địa lý - Nhóm 1",
    "Ngành nghề khác-Thợ chụp hình tại tiệm/studio - Nhóm 1",
    "Ngành nghề khác-Thợ sửa đồng hồ/ điện thoại di động - Nhóm 1",
    "Chăm sóc sắc đẹp-Thợ làm tóc, gội đầu, rửa mặt, làm móng, trang điểm - Nhóm 1",
    "Ngành nghề khác-Thủ thư - Nhóm 1",
    "Ngành nghề khác-Trợ lý bán hàng - Nhóm 1",
    "Ngư nghiệp/Sông-Điều hành, quản lý, Cán bộ thủy nông, nghiên cứu - Nhóm 1",
    "Điện/viễn thông-Kỹ sư điện phụ trách tư vấn/ thiết kế - Nhóm 1",
    "Điện/viễn thông-Kỹ sư trưởng nhà máy năng lượng - Nhóm 1",
    "Điện/viễn thông-Nhân viên phụ trách hành chính - Nhóm 1",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên dựng và quay phim quảng cáo - Nhóm 1",
    "Thể thao-Huấn huyện viên/Vận động viên môn Bi sắt, bắn cung, bowling - Nhóm 1",
    "Thể thao-Huấn huyện viên bóng chày, bóng chuyền, bóng ném, bóng rổ - Nhóm 1",
    "Thể thao-Huấn huyện viên/Vận động viên billiards, bóng bàn, golf - Nhóm 1",
    "Thể thao-Huấn huyện viên thể dục dụng cụ, trượt băng, Yoga - Nhóm 1",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên hành chính, kinh doanh, chế bản - Nhóm 1",
    "Quảng cáo/Báo chí/Truyền hình-Nhà văn, Nhà thơ, Họa sĩ, Biên tập viên, MC - Nhóm 1",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên/ Nhà báo làm việc văn phòng - Nhóm 1",
    "Quảng cáo/Báo chí/Truyền hình-Thợ xếp chữ. Chủ hiệu. Chủ kinh doanh - Nhóm 1",
    "Nghề thông dụng-Tu sĩ/Cha cố/nhân viên tôn giáo/đền đài/nhà thờ. - Nhóm 1",
    "Trồng trọt-Nhà ươm cây/ ươm hoa, Chủ vườn cây/ trồng cây ăn trái - Nhóm 1",
    "Trồng trọt-Điều hành nông trại không trực tiếp tham gia sản xuất - Nhóm 1",
    "Trồng trọt-Trồng, thu hoạch cà phê, Chủ quản lý vườn cây công nghiệp - Nhóm 1",
    "Trồng trọt-Chủ đồn điền/nông trường. Buôn bán máy móc nông nghiệp - Nhóm 1",
    "Trồng trọt-Làm muối, Kỹ thuật viên/hướng dẫn viên nông nghiệp - Nhóm 1",
    "Xây dựng-Nhân viên điều khiển thang máy/cáp treo (trên mặt đất). - Nhóm 1",
    "Xây dựng-Nhân viên thiết kế/họa sĩ/họa viên làm việc văn phòng - Nhóm 1",
    "Đường sắt/cầu đường-Nhân viên đo đạc địa hình (vùng đồng bằng) - Nhóm 1",
    "Thủy điện - Thủy lợi-Nhân viên đo đạc địa hình (vùng đồng bằng) - Nhóm 1",
    "Y tế-Công nhân phụ việc vặt - Nhóm 1",
    "Y tế-Nhân viên vệ sinh - Nhóm 1",
    "Y tế-Nhân viên y tế hành chính - Nhóm 1",
    "Y tế-Nữ hộ sinh, hộ lý - Nhóm 1",
    "Y tế-Thanh tra bệnh học - Nhóm 1",
    "Y tế-Nhân viên phân tích; Giám định pháp y - Nhóm 1",
    "Ăn uống/Chế biến thực phẩm-Chủ không trực tiếp sản xuất/nấu nướng - Nhóm 1",
    "Ăn uống/Chế biến thực phẩm-Quản lý, kiểm tra chất lượng thực phẩm - Nhóm 1",
    "Buôn bán-Bảo hiểm, vé tàu/vé xe/vé máy bay/vé số tại đại lý, tại nhà - Nhóm 1",
    "Buôn bán-Chủ tiệm, quản lý cửa hàng/siêu thị/TT thương mại/ tại nhà - Nhóm 1",
    "Buôn bán-Nhân viên bán trong cửa hàng/siêu thị/TT thương mại/ tại nhà - Nhóm 1",
    "Buôn bán-Nhân viên kinh doanh có ra ngoài gặp khách hàng bằng xe máy - Nhóm 1",
    "Buôn bán-Thiết bị điện/ điện tử/ Xe, ôtô - Nhóm 1",
    "Buôn bán-Thức ăn chăn nuôi, phân bón - Nhóm 1",
    "Buôn bán-Thuốc tây, tạp hóa, thực phẩm, rau quả, thịt, hải sản - Nhóm 1",
    "Buôn bán-Vật liệu xây dựng/sắt/thép/tôn/nhôm/kính/nội thất - Nhóm 1",
    "Cảnh sát/Công an-Giảng viên, sinh viên ngành an ninh/cảnh sát/sĩ quan - Nhóm 1",
    "DV giải trí/Nghệ thuật-Sân khấu-Người mẫu ảnh - Nhóm 1",
    "Hàng thủ công mỹ nghệ-Thợ đan dây nhựa - Nhóm 1",
    "Ngành nghề khác-Dịch vụ mai táng (nhân viên nhà đòn và chôn cất) - Nhóm 1",
    "Ngành nghề khác-Dịch vụ mai táng (ướp xác, tẩm liệm xác) - Nhóm 1",
    "Ngư nghiệp/Biển-Đan lưới, vá lưới - Nhóm 1",
    "Nghề thông dụng-Ban giám đốc, chủ doanh nghiệp, cán bộ quản lý - Nhóm 1",
    "Điện/viễn thông-Thợ sửa điện thoại bàn/ điện thoại di động - Nhóm 1",
    "Quân đội-Bác sĩ, y tá bệnh viện quân y - Nhóm 1",
    "Quân đội-Bộ đội xuất ngũ đang chờ việc - Nhóm 1",
    "Quản lý đô thị-Quản lý, giám sát viên - Nhóm 1",
    "Xây dựng-Giám đốc công ty xây dựng, không đi công trình - Nhóm 1",
    "Xây dựng-Kiến trúc sư thiết kế, kỹ sư xây dựng làm việc văn phòng - Nhóm 1",
    "Sản xuất xe-Công nhân kiểm tra chất lượng lốp ô tô - Nhóm 1",
    "Đường bộ-Quản lý điều hành đội xe, không lái. Quản lý bến xe, kiểm định - Nhóm 2",
    "Đường bộ-Tài xế xe cứu thương/ xe cứu hỏa/ xe xích lô/ ba gác đạp - Nhóm 2",
    "Đường sắt-Công nhân nạp nhiên liệu. Bảo vệ ga/ bảo vệ trên tàu - Nhóm 2",
    "Cảng-Kiểm tra viên, Quản lý/ Giám sát, Nhân viên giữ kho - Nhóm 2",
    "CNTT-Kỹ thuật viên lắp ráp/sửa chữa/bảo trì máy vi tính, laptop - Nhóm 2",
    "Xi măng/Vôi/Thạch cao-Giám sát viên, kỹ thuật viên, kỹ sư tại xưởng - Nhóm 2",
    "Xi măng/Vôi/Thạch cao-Công nhân vận hành máy, Thủ kho - Nhóm 2",
    "CNTT-Kỹ thuật viên kiểm tra chất lượng sản phẩm - Nhóm 2",
    "Sản xuất xe-Chủ quản lý tại gara - không trực tiếp làm - Nhóm 2",
    "Sản xuất xe-Đốc công, giám sát viên, kỹ thuật viên - Nhóm 2",
    "Thuốc lá-Công nhân sản xuất, công đoạn khác. Thủ kho - Nhóm 2",
    "Thiết bị phụ tùng điện-Công nhân lắp ráp, Công nhân đóng gói - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Công nhân điều khiển ở xưởng nghiền đá - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Công nhân sản xuất chế biến thực phẩm - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Công nhân sản xuất nước đá - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Giết mổ gia cầm - Nhóm 2",
    "Sản xuất Nhựa/Cao su/Da-Đốc công, giám sát viên, kỹ thuật viên - Nhóm 2",
    "Sản xuất Nhựa/Cao su/Da-Thủ kho - Nhóm 2",
    "Điện tử-Công nhân đóng gói/ kiểm hàng - Nhóm 2",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thiết kế mẫu đúc - Nhóm 2",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Kỹ sư cơ khí, Giám sát/Đốc công - Nhóm 2",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân xe sợi vải, cắt, chặt, mài, keo - Nhóm 2",
    "Sản xuất hóa chất-Kỹ sư hóa dầu. Kỹ sư/ nhân viên phòng thí nghiệm - Nhóm 2",
    "Sản xuất hóa chất-Kỹ thuật viên kiểm phẩm. Công nhân đóng gói. - Nhóm 2",
    "Kiếng/Thủy tinh-Thủ kho, quản lý, đốc công, chủ xưởng, chủ cửa hàng - Nhóm 2",
    "Nệm/gối/gấu bông-Công nhân sản xuất, nhuộm, hồ. Thủ kho - Nhóm 2",
    "Dệt May/Giày Dép/Túi xách/Nón-Thủ kho, kỹ thuật viên, Thợ sửa máy may - Nhóm 2",
    "Gốm/Gạch/Sứ-Thủ kho, Chủ lò gạch, Chủ lò gốm - Nhóm 2",
    "Hàng nội thất-Kỹ thuật viên, đốc công, giám sát viên, thủ kho - Nhóm 2",
    "Hàng thủ công mỹ nghệ-Sản xuất hàng đá mỹ nghệ, đan mây tre liễu gai - Nhóm 2",
    "Hàng thủ công mỹ nghệ-Kiểm tra nguyên liệu, đóng gói. Thủ kho - Nhóm 2",
    "Dệt May/Giày Dép/Túi xách/Nón-Ủi/hấp/sấy/nhuộm/in/vẽ/phân loại/đóng gói - Nhóm 2",
    "Sản xuất giấy-Kỹ thuật viên, giám sát viên, thủ kho - Nhóm 2",
    "Điện ảnh/Truyền hình-Nhân viên đạo cụ, dựng cảnh phim trường/sân khấu - Nhóm 2",
    "Buôn bán-Sơn/ Hóa chất/Thuốc trừ sâu/Bình ắcquy/Phế liệu; Thủ kho - Nhóm 2",
    "Hồ Bơi-Nhân viên cứu nạn tại hồ bơi - Nhóm 2",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên/Chủ quán bar, phòng trà, karaoke - Nhóm 2",
    "Giải trí đặc biệt-Nhân viên quán café/ quán rượu/ bar/ phòng trà - Nhóm 2",
    "Giải trí đặc biệt-Nhân viên pha chế (bartender) - Nhóm 2",
    "Giải trí đặc biệt-Nhân viên tụ điểm ca nhạc/ nhân viên spa - Nhóm 2",
    "Giải trí đặc biệt-Nhân viên karaoke/ vũ trường - Nhóm 2",
    "DV giải trí/Nghệ thuật-Sân khấu-Nghệ sĩ điêu khắc - Nhóm 2",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên nhà hát kịch, Nghệ sĩ cải lương - Nhóm 2",
    "Chăn nuôi-Người bắt động vật ở đồng, rẫy (chuột, rắn, …) - Nhóm 2",
    "Cảnh sát/Công an-Cảnh sát, dân phòng phụ trách an ninh khu vực - Nhóm 2",
    "Cảnh sát/Công an-Công an/Quản giáo trại giam - Nhóm 2",
    "Cảnh sát/Công an-Công an chốt đèn/ trật tự giao thông tại trạm - Nhóm 2",
    "Cảnh sát/Công an-Xử lý giao thông, tai nạn/ thanh tra giao thông - Nhóm 2",
    "Chăn nuôi-Bác sĩ thú y/ nhân viên thú y (vật nuôi) - Nhóm 2",
    "Cảnh sát/Công an-Kinh tế (không liên quan chống buôn lậu qua biên giới) - Nhóm 2",
    "Bưu điện-Nhân viên chuyển phát thư/giao nhận hàng hóa - Nhóm 2",
    "Bưu điện-Tài xế lái xe đưa thư - Nhóm 2",
    "Buôn bán-Chủ tiệm cầm đồ - Nhóm 2",
    "Y tế-Bác sĩ thú y (thú cưng, chăn nuôi) - Nhóm 2",
    "Xây dựng-Kỹ sư giám sát công trình, Đốc công, thầu/cai xây dựng - Nhóm 2",
    "Đường bộ-Tài xế lái xe cơ quan/ công ty, Tài xế xe đưa thư/ bưu kiện - Nhóm 2",
    "Hàng không-Phi công/ Tiếp viên hàng không (hãng hàng không dân dụng) - Nhóm 2",
    "Đường sắt-Lái tàu, Phụ lái. Giám sát hàng hóa vận tải. Kỹ sư cơ khí - Nhóm 2",
    "Điện/viễn thông-Nhân viên ghi chỉ số đồng hồ/ thu tiền - Nhóm 2",
    "Chăn nuôi-Công nhân/Người trực tiếp chăn nuôi gia súc trang trại - Nhóm 2",
    "Trồng trọt-Người sử dụng máy tuốt lúa, máy gặt. - Nhóm 2",
    "Chăn nuôi-Nuôi ong, nuôi đà điểu - Nhóm 2",
    "Quân đội-Nhân viên phòng hồ sơ chiến thuật (học viện quân sự) - Nhóm 2",
    "Quân đội-Quân nhân phụ trách hành chính, hậu cần, quân y & thông tin mặt đất. - Nhóm 2",
    "Thể thao-Huấn huyện viên bóng bầu dục, bóng đá, võ thuật - Nhóm 2",
    "Thể thao-Vận động viên/Cầu thủ bóng chày, bóng chuyền, bóng rổ - Nhóm 2",
    "Điện ảnh/Truyền hình-Nhân viên quay phim, chụp ảnh - Nhóm 2",
    "Điện tử-Công nhân lắp ráp/ điều hành, chế tạo mạch tổ hợp - Nhóm 2",
    "Điện tử-Kỹ thuật viên, Thợ sửa chữa đồ điện tử, Thủ kho - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Công nhân đóng gói - Nhóm 2",
    "Ngư nghiệp/Sông-Nuôi thủy sản, cá bè - Nhóm 2",
    "Điện ảnh/Truyền hình-Diễn viên - Nhóm 2",
    "Thiết bị phụ tùng điện-Kỹ sư, Đốc công, Giám sát viên, Thủ kho - Nhóm 2",
    "Ngư nghiệp/Sông-Đánh bắt cá trên đồng, rẫy - Nhóm 2",
    "Chăm sóc sắc đẹp-Nhân viên massage/bấm huyệt/xông hơi tại cơ sở/spa/salon - Nhóm 2",
    "Bảo vệ-Khu vui chơi giải trí, công viên, kho bãi - Nhóm 2",
    "DV giải trí/Nghệ thuật-Sân khấu-Ca sĩ, Nhạc sĩ, Nhạc công - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Sản xuất, làm bánh tráng/bánh ướt/bánh mì - Nhóm 2",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Đầu bếp/nấu ăn/phục vụ trong bếp - Nhóm 2",
    "Buôn bán-Buôn bán có giao hàng, chở hàng bằng xe máy - Nhóm 2",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Hướng dẫn viên du lịch theo đoàn - Nhóm 2",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên làm việc bên ngoài - Nhóm 2",
    "Quản lý đô thị-Công nhân vệ sinh đường phố, gom rác, quét đường - Nhóm 2",
    "Sản xuất xe-Thợ sửa chữa và bảo trì xe gắn máy, Thủ kho - Nhóm 2",
    "Cảnh sát/Công an-Làm việc văn phòng, xã/ phường/quận/ huyện/ tỉnh. - Nhóm 2",
    "Buôn bán-Buôn bán có trực tiếp nấu/quán ăn di động/quán lề đường - Nhóm 2",
    "Buôn bán-Vàng bạc/đá quý/kim cương/ngoại tệ - Nhóm 2",
    "Buôn bán-Các mặt hàng dễ cháy nổ/Xăng/Dầu/Gas; Thủ kho - Nhóm 2",
    "Buôn bán-Lắp đặt dụng cụ gas/khí hóa lỏng - Nhóm 2",
    "Sản xuất Nhựa/Cao su/Da-Công nhân cạo mủ cao su - Nhóm 2",
    "Sản xuất Nhựa/Cao su/Da-Công nhân đóng gói/kiểm tra vệ sinh chai - Nhóm 2",
    "Buôn bán-Gỗ tại xưởng - Nhóm 2",
    "Bảo vệ-Kho bạc, nhà hàng, khách sạn, nhà máy, bệnh viện, siêu thị - Nhóm 2",
    "Y tế-Nhân viên làm răng sứ giả; sản xuất/đóng gói thuốc, dụng cụ y tế - Nhóm 2",
    "Y tế-Nhân viên y tế, giám sát viên trong BV tâm thần/ trại cai nghiện - Nhóm 2",
    "Quân đội-Bộ đội/Sỹ quan làm việc văn phòng, tham mưu, kiểm soát quân sự. - Nhóm 2",
    "Quân đội-Hải quân trên đất liền. - Nhóm 2",
    "Ngư nghiệp/Biển-Bắt ốc, bắt phi ốc ven bờ khi nước biển cạn - Nhóm 2",
    "Ngư nghiệp/Biển-Đan lưới có cắn chì - Nhóm 2",
    "Nước-Công nhân điều khiển, vận hành trong nhà máy cấp thoát nước - Nhóm 2",
    "Quân đội-Sỹ quan binh chủng bộ binh, huấn luyện tân binh mới - Nhóm 2",
    "Quản lý đô thị-Công nhân chăm sóc cây, tưới cây - Nhóm 2",
    "Ngành nghề khác-Thợ chụp ảnh/quay phim ngoại cảnh, đám cưới, phim trường - Nhóm 2",
    "Hàng thủ công mỹ nghệ-Làm cầu lông, sản phẩm sơn mài, mỹ nghệ, sơn - Nhóm 2",
    "Khai thác quặng/than đá/dầu khí mặt đất-Nhân viên hóa phân tích - Nhóm 2",
    "DV giải trí/Nghệ thuật-Sân khấu-Người mẫu thời trang - Nhóm 2",
    "Gốm/Gạch/Sứ-Thợ/công nhân vẽ trang trí trên gốm, sửa khô sản phẩm - Nhóm 2",
    "Chăn nuôi-Nhân viên chế biến sản phẩm nông nghiệp - Nhóm 2",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên thu phí lưu động - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Sản xuất, làm bánh kẹo/bánh kem/kem lạnh - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Làm phở/hủ tiếu/mì/bún/miến/giò chả - Nhóm 2",
    "Y tế-Nhân viên vật lý trị liệu - Nhóm 2",
    "Thủy điện - Thủy lợi-Kỹ sư, Giám sát, đốc công tại công trình - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Chủ cơ sở giết mổ gia súc (không làm) - Nhóm 2",
    "Y tế-Đầu bếp trong bệnh viện - Nhóm 2",
    "Y tế-Bác sĩ, y tá, điều dưỡng trong BV tâm thần/ trại cai nghiện - Nhóm 2",
    "Đường sắt/cầu đường-Đốc công và giám sát viên - Nhóm 2",
    "Đường sắt/cầu đường-Kỹ sư, Nhân viên đo đạc khảo sát giao thông - Nhóm 2",
    "Xây dựng-Quản lý/chủ tiệm cơ sở làm cửa nhôm, sắt (không làm) - Nhóm 2",
    "Thể thao-Huấn huyện/Vận động viên lướt nước, đua thuyền, thuyền buồm - Nhóm 2",
    "Trồng trọt-Công nhân điều khiển/sửa chữa/bảo trì máy nông nghiệp - Nhóm 2",
    "Trồng trọt-Trồng tiêu/điều/cao su/chè (trà)/mía/ca cao/dừa, hái chè - Nhóm 2",
    "Tòa án-Nhân viên cưỡng chế thi hành án - Nhóm 2",
    "Tòa án-Điều tra viên và nhân viên phụ trách tội phạm kinh tế - Nhóm 2",
    "Tòa án-Quan tòa, luật sư, thư ký, thông dịch viên - Nhóm 2",
    "Quảng cáo/Báo chí/Truyền hình-Công nhân in. Thợ in. Thợ đóng sách - Nhóm 2",
    "Quảng cáo-Thợ vẽ/ dựng bảng hiệu dưới đất - Nhóm 2",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên phát hành báo/ giao phát báo - Nhóm 2",
    "Thể thao-Vận động viên/Cầu thể dục dụng cụ, trượt băng - Nhóm 2",
    "Thể thao-Huấn huyện viên khúc côn cầu, bóng ném - Nhóm 2",
    "Thể thao-Vận động viên/Cầu thủ cử tạ, đường đua, tennis, cầu lông - Nhóm 2",
    "Thể thao-Huấn huyện/Vận động viên bắn súng, du thuyền - Nhóm 2",
    "Quân đội-Sỹ quan/ bộ đội trực chỉ đồn biên phòng không tuần tra thực địa - Nhóm 2",
    "Điện/viễn thông-Nhân viên hành chính tại nhà máy/ trạm phát điện - Nhóm 2",
    "Điện/viễn thông-Kiểm tra viên - Nhóm 2",
    "Ngư nghiệp/Sông-Điều hành trại cá, chế biến thủy hải sản. Thủ kho - Nhóm 2",
    "Điện/viễn thông-Kỹ sư giám sát & kiểm tra trên máy tính, bảng điện tử - Nhóm 2",
    "Nước-Nhân viên ghi chỉ số đồng hồ nước/ đưa giấy báo/ thu tiền nước - Nhóm 2",
    "Nước-Nhân viên hành chính làm việc cho đập nước & hồ chứa - Nhóm 2",
    "Nước-Nhân viên kiểm tra chất lượng nước trong nhà máy, công trình - Nhóm 2",
    "Quân đội-Giáo viên/ Sỹ quan dạy môn giáo dục quốc phòng - Nhóm 2",
    "Ăn uống/Chế biến thực phẩm-Người trực tiếp nấu rượu - Nhóm 2",
    "Buôn bán-Nhân viên tiếp thị sản phẩm; Bán vé số dạo - Nhóm 2",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên chuyển hành lý/khuân vác - Nhóm 2",
    "Rừng-Quản đốc, Ươm cây ở lâm trường - Nhóm 2",
    "Chế biến gỗ-Thợ đánh dấu gỗ, đo đạc, phân loại gỗ, chà nhám gỗ - Nhóm 2",
    "Chế biến gỗ-Chủ xưởng, Quản đốc, kiểm tra viên - Nhóm 2",
    "Chế biến gỗ-Khâu hoàn thiện sản phẩm. Thợ lắp ráp sản phẩm - Nhóm 2",
    "Rừng-Công nhân trồng rừng, trồng bạch đàn/keo lá tràm/ phi lao/ dương - Nhóm 3",
    "Rừng-Nhân viên chữa cháy rừng, Ban quản lý rừng phòng hộ - Nhóm 3",
    "Chế biến gỗ-Công nhân bảo quản, sản xuất ván ép - Nhóm 3",
    "Chế biến gỗ-Thợ cưa xẻ gỗ tại xưởng/Thợ mộc/Lắp ráp gỗ nội thất - Nhóm 3",
    "Cảng-Công nhân xưởng đóng tàu, Kỹ sư, Đốc công (tại cảng/đất liền) - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Tuyển than trên băng truyền - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Kỹ sư/kỹ thuật viên/đốc công - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Phụ trách an toàn mỏ - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Nhân viên khảo sát địa chất - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân sản xuất, chế biến - Nhóm 3",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên hộ tống chở tiền - Nhóm 3",
    "Lao động phổ thông (không làm việc trên cao >=4m/ hóa chất/ thuốc nổ) - Nhóm 3",
    "Quân đội-Bộ đội, sỹ quan đồn biên phòng (có tuần tra thực địa); - Nhóm 3",
    "Quân đội-Bộ đội làm việc trong các đơn vị phụ trách vũ khí, đạn dược - Nhóm 3",
    "Quân đội-Nghĩa vụ quân sự, quân nhân mới nhập ngũ - Nhóm 3",
    "Quân đội-Quân nhân đặc biệt (biệt kích/đặc công) - Nhóm 3",
    "Quân đội-Quân nhân đảm đương nhiệm vụ đặc biệt trong cơ quan tình báo - Nhóm 3",
    "Quân đội-Quân nhân phụ trách bộc phá; người nhái; hải quân trên đảo/biển - Nhóm 3",
    "Quân đội-Quân nhân tiền tuyến - Nhóm 3",
    "Quân đội-Quân nhân vũ khí hóa học, thử chất nổ - Nhóm 3",
    "Quân đội-Sinh viên học viện quân sự - Nhóm 3",
    "Điện/viễn thông-Kỹ sư nhà máy năng lượng - Nhóm 3",
    "Điện/viễn thông-Nhân viên điều hành máy tuabin/ phòng phát điện - Nhóm 3",
    "Điện/viễn thông-Kỹ thuật viên, nhân viên kiểm tra máy phát - Nhóm 3",
    "Điện/viễn thông-Công nhân lắp ráp/bảo trì/phụ trách bảng điện - Nhóm 3",
    "Điện/viễn thông-Công nhân bảo trì cao ốc văn phòng & nhà máy - Nhóm 3",
    "Điện/viễn thông-Kỹ thuật viên lắp đặt & bảo trì điện kế/ đồng hồ - Nhóm 3",
    "Điện/viễn thông-Công nhân đặt cáp ngầm, cáp quang bưu điện - Nhóm 3",
    "Nước-Công nhân bảo trì - Nhóm 3",
    "Nước-Công nhân nhà máy nước - Nhóm 3",
    "Nước-Giám sát viên, kiểm tra viên, công nhân lắp đặt máy móc mạ điện - Nhóm 3",
    "Nước-Giám sát viên, kiểm tra viên, công nhân đường hầm - Nhóm 3",
    "Thể thao-Vận động viên/Cầu thủ bóng đá, võ thuật - Nhóm 3",
    "Thể thao-Huấn huyện viên/Vận động viên lướt ván, xuồng máy - Nhóm 3",
    "Xây dựng-Công nhân chống thấm. Công nhân sửa chữa, bảo trì thang máy - Nhóm 3",
    "Xây dựng-Thợ trang trí nội thất, Thợ ống nước - Nhóm 3",
    "Trồng trọt-Lái xe công nông, Lái máy cày tay, nạo vét mương - Nhóm 3",
    "Xây dựng-Thợ làm cửa nhôm/ kính. Thợ làm cửa sắt tại xưởng cơ khí - Nhóm 3",
    "Xây dựng-Thợ làm trần thạch cao, la phông, Thợ điêu khắc ở độ cao<4m - Nhóm 3",
    "Đường sắt/cầu đường-Nhân viên đo đạc địa hình (vùng núi/ngoài khơi) - Nhóm 3",
    "Thủy điện - Thủy lợi-Bảo vệ công trường - Nhóm 3",
    "Thủy điện - Thủy lợi-Nhân viên đo đạc địa hình (vùng núi/ngoài khơi) - Nhóm 3",
    "Đường sắt/cầu đường-Bảo vệ công trường - Nhóm 3",
    "Đường sắt/cầu đường-Công nhân kỹ thuật công trình trên mặt đất. - Nhóm 3",
    "Đường sắt/cầu đường-Công nhân bảo trì, lắp đặt đường ống. - Nhóm 3",
    "Đường sắt/cầu đường-Công nhân địa chất/ khoan máy, khoan giếng - Nhóm 3",
    "Y tế-Bác sĩ thú y (trong sở thú) - Nhóm 3",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Tài xế chở tiền mặt - Nhóm 3",
    "Chăm sóc sắc đẹp-Thợ xăm hình tại tiệm - Nhóm 3",
    "Dệt May/Giày Dép/Túi xách/Nón-Sửa chữa, bảo trì, vận hành trong nhà máy - Nhóm 3",
    "Chăn nuôi-Nhân viên huấn luyện chó, nhân viên bắt chó. Giết mổ gia súc - Nhóm 3",
    "Cảnh sát/Công an-Huấn luyện chó - Nhóm 3",
    "Cảnh sát/Công an-Lính cứu hỏa, đội cứu nạn cứu hộ - Nhóm 3",
    "Cảnh sát/Công an-Công an nghĩa vụ (nghĩa vụ quân sự) - Nhóm 3",
    "Kiếng/Thủy tinh-Công nhân ép hơi, pha màu, phối màu, đánh bóng - Nhóm 3",
    "Kiếng/Thủy tinh-Công nhân lắp ráp, vận hành máy - Nhóm 3",
    "Kiếng/Thủy tinh-Kỹ thuật viên lò nung - Nhóm 3",
    "Lao động tự do (không làm việc trên cao >=4m/ hóa chất/ thuốc nổ) - Nhóm 3",
    "DV giải trí/Các lĩnh vực khác-Thợ lắp ráp ăng ten tại nhà và văn phòng - Nhóm 3",
    "Ngư nghiệp/Biển-Nuôi tôm hùm, ốc hương, rùa, baba, nghêu - Nhóm 3",
    "Quản lý đô thị-Công nhân trồng cây xanh, cắt tỉa cây xanh ở độ cao <4m - Nhóm 3",
    "Quản lý đô thị-Công nhân xử lý và chế biến rác thải sinh hoạt - Nhóm 3",
    "Quản lý đô thị-Nhân viên đổ rác thải - Nhóm 3",
    "Điện/viễn thông-Trực/điều hành trạm biến áp - Nhóm 3",
    "Nước- Thợ ống nước, thợ hàn (nối, gắn) ống nước, Thợ khoan giếng - Nhóm 3",
    "Quân đội-Quân nhân đặc biệt (không quân/nhảy dù/hoa tiêu) - Nhóm 3",
    "Quản lý đô thị-Tài xế lái xe tưới cây - Nhóm 3",
    "Sản xuất hóa chất-Công nhân sửa chữa bình ắc quy, phun sơn bằng máy - Nhóm 3",
    "Sản xuất hóa chất-Tổ trưởng/ca trưởng/kỹ thuật viên xưởng tạo khí nhà máy đạm - Nhóm 3",
    "Thiết bị phụ tùng điện-Lắp ráp thiết bị phòng cháy chữa cháy - Nhóm 3",
    "Thợ hàn cơ khí tại tiệm/xưởng/nhà máy (không làm tại công trình) - Nhóm 3",
    "Trồng trọt-Công nhân chăm sóc cây xanh, cắt tỉa cây độ cao <4m - Nhóm 3",
    "Bảo vệ-Vệ sĩ, thám tử tư - Nhóm 3",
    "Bảo vệ-Ngân hàng, nông trường, quán bar/ karaoke, vũ trường - Nhóm 3",
    "Buôn bán-Buôn bán hàng chuyến liên tỉnh/ có đi qua cửa khẩu - Nhóm 3",
    "Bưu điện-Nhân viên khuân vác bưu kiện - Nhóm 3",
    "Sản xuất xe-Sửa chữa, lắp ráp, bảo trì ô tô và đầu máy xe lửa - Nhóm 3",
    "Cảnh sát/Công an-Đội chống buôn lậu biên giới. Cảnh sát cơ động - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ nguội, Thợ tiện, Thợ rèn - Nhóm 3",
    "Cảnh sát/Công an-Tuần tra giao thông, Cảnh sát 113 - Nhóm 3",
    "Gốm/Gạch/Sứ-Công nhân lò nung, phân loại, bưng, phơi gạch gốm - Nhóm 3",
    "Gốm/Gạch/Sứ-Công nhân khoan/nghiền khoáng chất, sàng lọc - Nhóm 3",
    "Gốm/Gạch/Sứ-Công nhân tạo sản phẩm/ tạo hình/ sản xuất/ tráng men - Nhóm 3",
    "Khai thác quặng/than đá/dầu khí mặt đất-Vận chuyển than trên đường ray - Nhóm 3",
    "Ngư nghiệp/Sông-Đánh cá trên sông/ hồ/ đầm/ phá - Nhóm 3",
    "Ngư nghiệp/Biển-Người trực tiếp nuôi trồng thủy sản ven biển - Nhóm 3",
    "Thuốc lá-Công nhân lò sấy - Nhóm 3",
    "Nhựa/Cao su/Da-Công nhân làm khuôn, đổ khuôn, phối liệu/pha chế - Nhóm 3",
    "Điện/viễn thông-Công nhân đặt cáp ngầm điện lực - Nhóm 3",
    "Điện/viễn thông-Công nhân đường dây sửa chữa, lắp đặt điện nhà - Nhóm 3",
    "Nước-Công nhân thi công xây dựng đường ống cấp nước - Nhóm 3",
    "Điện/viễn thông-Công nhân đường dây sửa chữa, lắp đặt điện thoại - Nhóm 3",
    "Đường sông-Lái đò ngang, Lái phà, Nhân viên trên phà (trên sông) - Nhóm 3",
    "Đường sắt/cầu đường-Công nhân bảo dưỡng, làm đường đồng bằng - Nhóm 3",
    "Xây dựng-Thợ điều khiển máy móc xây dựng. Thợ tạc tượng - Nhóm 3",
    "Đường sắt-Kĩ thuật viên/ Công nhân sửa chữa, lắp, bảo trì. Thợ máy - Nhóm 3",
    "Đường sắt-Nhân viên khuân vác hàng/hành lý. Thợ cơ khí. Thợ điện - Nhóm 3",
    "Đường bộ-Tài xế taxi/xe du lịch/xe ba bánh/ba gác máy/xe ôm/Grab/Go-Viet - Nhóm 3",
    "Chăn nuôi-Nuôi cá sấu, rắn - Nhóm 3",
    "Đường bộ-Tài xế/phụ xế xe vận tải hàng hóa <=4 tấn, xe công nông - Nhóm 3",
    "Kiếng/Thủy tinh-Công nhân thổi thủy tinh, uốn, cắt kiếng, mài cạnh - Nhóm 3",
    "Hàng nội thất-Thợ sản xuất, sửa chữa nội thất đồ gỗ/ đồ kim loại - Nhóm 3",
    "Hàng thủ công mỹ nghệ-Sản xuất dao, kéo, đồ kim loại (tiện, nề, sơn) - Nhóm 3",
    "Xây dựng-Thợ lắp ráp kính/ cửa nhôm, cửa kính, cửa window - Nhóm 3",
    "Đường bộ-Tài xế/nhân viên xe khách, xe buýt nội thành, xe chở rác - Nhóm 3",
    "Xi măng/Vôi/Thạch cao-Thợ làm trần thạch cao - Nhóm 3",
    "Xây dựng-Thợ mộc, mộc cốp pha. Thợ đóng trần thạch cao - Nhóm 3",
    "Xây dựng-Thợ điện - Nhóm 3",
    "Xây dựng-Thợ xây bia mộ - Nhóm 3",
    "Y tế-Nhân viên làm việc với máy phóng xạ, X-quang, CT Scan, MRI - Nhóm 3",
    "Cảnh sát/Công an-Sĩ quan/Đội trưởng/Nhân viên phòng cháy chữa cháy - Nhóm 3",
    "Cảnh sát/Công an-Đội điều tra và hỏi cung bị can. Đội chống bạo động - Nhóm 3",
    "Cảnh sát/Công an-Hình sự/ điều tra/ chuyên trách phòng chống ma tuý - Nhóm 3",
    "Buôn bán-Thu mua dụng cụ gas/ khí hóa lỏng đã qua sử dụng - Nhóm 3",
    "Bảo vệ-Công trường xây dựng - Nhóm 3",
    "Hồ Bơi-Nhân viên cứu nạn (bãi tắm biển) - Nhóm 3",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên đoàn nghệ thuật biểu diễn lưu động - Nhóm 3",
    "Sở thú-Bác sĩ thú y trong sở thú - Nhóm 3",
    "Bowling-Nhân viên bảo trì máy móc - Nhóm 3",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân thử nghiệm - Nhóm 3",
    "Điện ảnh/Truyền hình-Tài xế đoàn làm phim - Nhóm 3",
    "DV giải trí/Các lĩnh vực khác-Thợ ống nước/Thợ máy/Thợ điện/Lắp camera - Nhóm 3",
    "Sản xuất giấy-Công nhân nghiền bột giấy/ sản xuất giấy - Nhóm 3",
    "Hàng nội thất-Làm đá hoa cương - Nhóm 3",
    "Nhựa/Cao su/Da-Công nhân cán ép mủ cao su/ sản xuất nhựa/ thuộc da - Nhóm 3",
    "Nhựa/Cao su/Da-Công nhân chế tạo, hoàn chỉnh sản phẩm cao su - Nhóm 3",
    "Nệm/gối/gấu bông-Công nhân cắt bông, nhồi, ép hơi, cắt xén - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ hàn cơ khí tại tiệm/xưởng/nhà máy - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân lắp ráp, vận hành máy - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy cắt - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy giùi - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy khoan - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy xay xát - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân xi mạ, Thợ chạm khắc/xi mạ/sơn - Nhóm 3",
    "Điện tử-Công nhân sản xuất, Nhân viên lắp đặt camera - Nhóm 3",
    "Nhựa/Cao su/Da-Công nhân vận hành máy, bảo trì máy - Nhóm 3",
    "Ăn uống/Chế biến thực phẩm-Giết mổ gia súc - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Lái xe nâng - Nhóm 3",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ ống nước, Thợ điện - Nhóm 3",
    "Thiết bị phụ tùng điện-Sản xuất/ sửa chữa máy điều hòa (tại xưởng) - Nhóm 3",
    "Thiết bị phụ tùng điện-Thợ điện; Công nhân xưởng đúc - Nhóm 3",
    "Thiết bị phụ tùng điện-Thợ hàn phụ tùng điện (không làm tại công trình) - Nhóm 3",
    "Điện/viễn thông-Thợ điện dân dụng, điện lạnh làm việc độ cao < 4m - Nhóm 3",
    "Sản xuất hóa chất-Công nhân sản xuất, đóng gói xà phòng/chất tẩy rửa - Nhóm 3",
    "Sản xuất xe-Công nhân cơ khí, Công nhân/ca trưởng lắp ráp, sản xuất - Nhóm 3",
    "Sản xuất hóa chất-Công nhân sản xuất pin, phân bón, hóa chất. Thủ kho - Nhóm 3",
    "Xi măng/Vôi/Thạch cao-Công nhân sản xuất, tiếp xúc bụi/nhiệt/lò nung - Nhóm 3",
    "Đường bộ-Chủ xe/nhân viên theo xe, không trực tiếp lái. Khuân vác - Nhóm 3",
    "Đường bộ-Tài xế xe đoàn làm phim/ thực địa. Giáo viên dạy lái xe - Nhóm 3",
    "Hàng không-Nhân viên vệ sinh máy bay (bên ngoài) - Nhóm 3",
    "Hàng không-Nhân viên khuân vác hành lý, hàng hóa - Nhóm 3",
    "Hàng không-Kiểm tra viên tại sân bay. Lái xe bus phục vụ trong sân bay - Nhóm 3",
    "Hàng không-Bảo trì máy bay/ bảo dưỡng đường băng/nạp nhiên liệu/cơ khí - Nhóm 3",
    "Cảng-Hoa tiêu, NV lái canô kiểm tra khu vực cảng, Khuân vác tại cảng - Nhóm 3",
    "Đường sông-Lái đò, ghe, thuyền buôn bán trên sông - Nhóm 3",
    "Chế biến gỗ-Bốc dỡ gỗ tại xưởng chế biến, kho gỗ - Nhóm 3",
    "Chế biến gỗ-Công nhân điều khiển cần cẩu tại xưởng/nhà máy - Nhóm 3",
    "Đường bộ-Tài xế chuyên chở nguyên vật liệu (trong khu vực khai thác) - Nhóm 3",
    "Đường bộ-Tài xế xe chở than từ nơi khai thác, xe trộn bê tông - Nhóm 4",
    "Khai thác gỗ-Điều khiển cần cẩu, điều khiển bộ nối tại nơi khai thác - Nhóm 4",
    "Đường sông-Tàu chở khách cự ly xa (đò dọc) - Nhóm 4",
    "Khai thác gỗ-Quản đốc, giám sát viên, công nhân tại nơi bốc dỡ - Nhóm 4",
    "Đường sông-Nhân viên/thủy thủ tàu du lịch, tàu chở vật liệu xây dựng - Nhóm 4",
    "Cảng-Điều khiển cần cẩu. Điều khiển ròng rọc nâng hàng - Nhóm 4",
    "Cảng-Công nhân xưởng đóng tàu và đốc công (làm việc ngoài khơi). - Nhóm 4",
    "Hàng không-Nhân viên vệ sinh tường cao hoặc trần - Nhóm 4",
    "Đường bộ-Tài xế xe chở cát/đá/vật liệu xây dựng. Nhân viên áp tải - Nhóm 4",
    "Xi măng/Vôi/Thạch cao-Công nhân đào đắp, khai thác nguyên liệu - Nhóm 4",
    "Thiết bị phụ tùng điện-Lắp đặt, sửa chữa điều hòa (trên tầng cao) - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thủ kho - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Hướng dẫn điều khiển cẩu cần trục - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân chưng cất - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Lái xe cẩu cần trục - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ làm khuôn mẫu - Nhóm 4",
    "Sản xuất hóa chất-Chiết nạp, sản xuất khí công nghiệp/khí nén - Nhóm 4",
    "Sản xuất hóa chất-Công nhân chiết nạp, sản xuất gas/khí hóa lỏng - Nhóm 4",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên võ thuật/xiếc thú//múa lửa - Nhóm 4",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên xiếc trên cao, nhào lộn - Nhóm 4",
    "Xây dựng-Thợ sơn tường/sơn nước, quét vôi - Nhóm 4",
    "Xây dựng-Thợ xây, Thợ hồ, Phụ hồ. Thầu xây dựng có trực tiếp làm. - Nhóm 4",
    "Thủy điện - Thủy lợi-Công nhân xây dựng - Nhóm 4",
    "Xi măng/Vôi/Thạch cao-Công nhân điều hành và sản xuất bê tông - Nhóm 4",
    "Xây dựng-Thợ hàn tại công trình, Thợ làm cửa sắt tại công trình - Nhóm 4",
    "Đường bộ-Tài xế/phụ xế xe tải công trình, xe container, cẩu/cần trục - Nhóm 4",
    "Đường bộ-Tài xế lái xe ủi/san lấp/ múc/đào, xe lu, xe kobe/xe ben - Nhóm 4",
    "Đường bộ-Tài xế/phụ xế xe tải hàng hóa >4 tấn, xe khách liên tỉnh - Nhóm 4",
    "Đường sông-Vận tải đường sông (tàu thủy, sà lan) - Nhóm 4",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân sản xuất/luyện/cán/đúc - Nhóm 4",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên xiếc - Nhóm 4",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân khai thác - Nhóm 4",
    "Trồng trọt-Hái dừa - Nhóm 4",
    "Rừng-Nhân viên kiểm lâm có làm việc/tuần tra tại lâm trường, rừng - Nhóm 4",
    "Quản lý đô thị-Công nhân cắt tỉa cây xanh ở độ cao >=4m - Nhóm 4",
    "Nhựa/Cao su/Da-Công nhận vận hành, bảo trì nồi hơi/ lò hơi - Nhóm 4",
    "Điện/viễn thông-Công nhân đường dây cao thế, làm việc ở độ cao >=4m - Nhóm 4",
    "Hàng nội thất-Ốp đá hoa cương - Nhóm 4",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân vận hành, bảo trì nồi hơi/lò hơi - Nhóm 4",
    "DV giải trí/Các lĩnh vực khác-Thợ lắp dựng ăng ten/bảo trì ở độ cao >=4m - Nhóm 4",
    "Đường sắt/cầu đường-Điều khiển máy san đất, máy đào, máy múc, dập - Nhóm 4",
    "Đường sắt/cầu đường-Công nhân làm đường núi/ tàu nạo vét. - Nhóm 4",
    "Đường sắt/cầu đường-Công nhân sửa chữa, bảo trì, lắp đặt đường dây - Nhóm 4",
    "Thủy điện - Thủy lợi-Công nhân sử dụng máy móc công trình - Nhóm 4",
    "Đường sắt/cầu đường-Điều khiển máy móc làm đường/ lái cẩu - Nhóm 4",
    "Đường sắt/cầu đường-Lái xe chở đất đá, trộn bê tông, xe lu, xe ben - Nhóm 4",
    "Xây dựng-Thợ trang trí ngoại thất. Công nhân lắp đặt thang máy. - Nhóm 4",
    "Xây dựng-Công nhân ốp đá (đá mài, đá rửa, đá hoa cương), giàn giáo - Nhóm 4",
    "Quảng cáo-Nhân viên vẽ/lắp đặt/dựng bảng quảng cáo ngoài trời - Nhóm 4",
    "Điện/viễn thông-Thi công đường cáp (bảo trì, quấn cáp) ở độ cao >=4m - Nhóm 4",
    "Rừng-Quản lý/nhân viên khu bảo tồn thiên nhiên - Nhóm 4",
    "Đường biển-Lái thuyền & nhân viên trên tàu cứu hộ, tàu du lịch, du thuyền - Nhóm Từ chối",
    "Đường biển-Thợ lặn biển - Nhóm Từ chối",
    "Đường biển-Thủy thủ, nhân viên trên tàu/ sà lan/ phà/ thuyền buồm - Nhóm Từ chối",
    "Đường bộ-Tài xế/phụ xế áp tải xe chở khí hóa lỏng, xe bồn xăng dầu - Nhóm Từ chối",
    "Đường bộ-Tài xế/phụ xế xe vận chuyển vật liệu cháy nổ - Nhóm Từ chối",
    "Đường bộ-Tài xế, phụ xế lái xe toa kéo - Nhóm Từ chối",
    "Đường sông-Nhân viên/thủy thủ tàu cứu hộ. Tàu/sà lan chở xăng dầu - Nhóm Từ chối",
    "Khai thác gỗ-Lái xe và phụ xe chở gỗ - Nhóm Từ chối",
    "Đường sông- Thợ lặn sông - Nhóm Từ chối",
    "Khai thác gỗ-Công nhân, Thợ cưa xẻ gỗ tại nơi khai thác - Nhóm Từ chối",
    "Xi măng/Vôi/Thạch cao-Công nhân điều hành và sản xuất chất phụ gia - Nhóm Từ chối",
    "Xi măng/Vôi/Thạch cao-Công nhân nổ mìn - Nhóm Từ chối",
    "Hàng không-Phi công đang được huấn luyện trong công ty hàng không - Nhóm Từ chối",
    "Hàng không-Phi công máy bay trực thăng - Nhóm Từ chối",
    "Sản xuất hóa chất-Công nhân sản xuất các loại axít - Nhóm Từ chối",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân khuân vác sắt/ thép/ tôn - Nhóm Từ chối",
    "Sản xuất Thuốc súng/Chất nổ-Nơi làm việc/ công việc có liên quan - Nhóm Từ chối",
    "Khai thác quặng/than đá/dầu khí ở dưới lòng đất-Công nhân hầm mỏ - Nhóm Từ chối",
    "Sản xuất hóa chất-Công nhân làm việc với hóa chất độc hại - Nhóm Từ chối",
    "DV giải trí/Nghệ thuật-Sân khấu-Múa lân/ sư tử/ rồng - Nhóm Từ chối",
    "Sở thú-Nhân viên chăm sóc thú, Nhân viên huấn luyện thú - Nhóm Từ chối",
    "Điện ảnh/Truyền hình-Diễn viên đóng thế vai nguy hiểm (Cascader) - Nhóm Từ chối",
    "Giải trí đặc biệt-Gái bán bar, mời rượu, gái nhảy - Nhóm Từ chối",
    "Chăm sóc sắc đẹp-Làm nghề massage tại nhà - Nhóm Từ chối",
    "Nước-Thợ đào giếng - Nhóm Từ chối",
    "Sản xuất xe-Nhân viên chạy thử xe ôtô, môtô (thử tốc độ - va đập) - Nhóm Từ chối",
    "Điện/viễn thông-Công nhân đường hầm, vận hành lò hơi, nồi hơi - Nhóm Từ chối",
    "Ngành nghề khác-Thợ lặn - Nhóm Từ chối",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân nổ mìn - Nhóm Từ chối",
    "Khai thác quặng/than đá-tất cả nhân viên làm việc ngoài khơi - Nhóm Từ chối",
    "Khai thác quặng/than đá/dầu khí ngoài khơi-Thợ lặn - Nhóm Từ chối",
    "Ngành nghề khác-Công nhân lau chùi bên ngoài cao ốc - Nhóm Từ chối",
    "Ngành nghề khác-Nhân viên lau chùi ống khói - Nhóm Từ chối",
    "Điện/viễn thông-Nhân viên phụ trách máy biến thế - Nhóm Từ chối",
    "Thể thao-Vận động viên/Cầu thủ bóng bầu dục, khúc côn cầu - Nhóm Từ chối",
    "Thể thao-Huấn huyện viên/Vận động viên/Thợ lặn biển, leo núi - Nhóm Từ chối",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên chiến trường - Nhóm Từ chối",
    "Xây dựng-Công nhân lau kiếng nhà cao tầng - Nhóm Từ chối",
    "Đường sắt/cầu đường-Công nhân kỹ thuật công trình dưới lòng đất - Nhóm Từ chối",
    "Đường sắt/cầu đường-Công nhân xây dựng cầu; Công nhân nổ mìn - Nhóm Từ chối",
    "Đường biển-Dân cư trên đảo ven biển - Nhóm 1 & Loại trừ",
    "Ngư nghiệp/Biển-Đánh bắt cá biển/ Ngư dân, Đánh bắt hải sản gần bờ - Nhóm 4 Tăng phí & Loại trừ",
    "Đường biển-Ngư dân đi biển, Tàu công. Người làm việc trên giàn khoan - Nhóm 4 Tăng phí & Loại trừ",
    "Đường biển-Công việc có đi lại trên biển - Nhóm 4 Tăng phí & Loại trừ",
  ];

  function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  customInput.addEventListener("click", () => {
    customInputContainer.classList.toggle("show");
  });

  let countriesLength = countries.length;

  for (let i = 0; i < countriesLength; i++) {
    let country = countries[i];
    const li = document.createElement("li");
    const countryName = document.createTextNode(country);
    li.appendChild(countryName);
    ul.appendChild(li);
  }

  ul.querySelectorAll("li").forEach((li) => {
    li.addEventListener("click", (e) => {
      let selectdItem = e.target.innerText;
      selectedData.innerText = selectdItem;

      for (const li of document.querySelectorAll("li.selected")) {
        li.classList.remove("selected");
      }
      e.target.classList.add("selected");
      customInputContainer.classList.toggle("show");
    });
  });

  function updateData(data) {
    let selectedCountry = data.innerText;
    selectedData.innerText = selectedCountry;

    for (const li of document.querySelectorAll("li.selected")) {
      li.classList.remove("selected");
    }
    data.classList.add("selected");
    customInputContainer.classList.toggle("show");
    console.log(selectedCountry);
  }

  searchInput.addEventListener("keyup", (e) => {
    let searchedVal = searchInput.value.toLowerCase();
    let searched_country = [];

    searched_country = countries
      .filter((data) => {
        // Normalize both mainText and searchQuery to remove diacritics
        const normalizedMainText = removeDiacritics(data).toLowerCase();
        const normalizedSearchQuery = removeDiacritics(searchedVal).toLowerCase();

        // Check if the searchQuery is present in the mainText
        return normalizedMainText.includes(normalizedSearchQuery);
      })
      .map((data) => {
        return `<li onClick="updateData(this)">${data}</li>`;
      })
      .join("");
    ul.innerHTML = searched_country ?
      searched_country :
      "<p style='margin-top: 1rem;'>Opps can't find any result <p style='margin-top: .2rem; font-size: .9rem;'>Try searching something else.</p></p>";
  });

  const chooseMajorBtn = document.getElementById("chooseMajorBtn");
  // add event listener click to the button
  // chooseMajorBtn.addEventListener("click", () => {
  //   // get the selected major
  //   const selectedMajor = selectedData.innerText;
  //   const normalizedMainText = removeDiacritics(selectedMajor).toLowerCase();
  //   let nhomNganh = 0;
  //   if (normalizedMainText.includes('1') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
  //     nhomNganh = 1;
  //   }
  //   if (normalizedMainText.includes('2') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
  //     nhomNganh = 2;
  //   }
  //   if (normalizedMainText.includes('3') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
  //     nhomNganh = 3;
  //   }
  //   if (normalizedMainText.includes('4') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
  //     nhomNganh = 4;
  //   }
  //   // check if the selected major is empty
  //   if (selectedMajor === "Chọn ngành nghề") {
  //     // if it is empty, show an alert
  //     alert("Vui lòng chọn ngành nghề");
  //   } else {
  //     // set value for id 'nhomNghe'
  //     if (nhomNganh === 0) {
  //       alert("Ngành nghề không hợp lệ");
  //     } else {
  //       document.getElementById("nhomNghe_1").value = nhomNganh;
  //       updateChiPhi(1, `phiCoban_1`);
  //       // hide the modal
  //       const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
  //       // clear selected data and search input
  //       selectedData.innerText = "Chọn nhóm ngành nghề";
  //       searchInput.value = "";

  //       modal.hide();
  //     }
  //   }
  // });

  let priorityGlobal = 0;
  const exampleModal = document.getElementById('exampleModal')
  if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const priority = button.getAttribute('data-bs-whatever')
      if (!priority) {
        document.getElementById('chooseMajorBtn').style.display = 'none';
      }else{
        document.getElementById('chooseMajorBtn').style.display = 'block';
      }
      priorityGlobal = priority
    })
  }

  function setNhomNghe() {
    // const selectedMajor = document.getElementById(inputId).value;
    const selectedMajor = selectedData.innerText;
    const normalizedMainText = removeDiacritics(selectedMajor).toLowerCase();
    console.log(normalizedMainText);
    let nhomNganh = 0;
    if (normalizedMainText.includes('1') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
      nhomNganh = 1;
    }
    if (normalizedMainText.includes('2') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
      nhomNganh = 2;
    }
    if (normalizedMainText.includes('3') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
      nhomNganh = 3;
    }
    if (normalizedMainText.includes('4') && !normalizedMainText.includes('loai tru') && !normalizedMainText.includes('tu choi')) {
      nhomNganh = 4;
    }
    if (nhomNganh === 0) {
      alert("Ngành nghề không hợp lệ");
    } else {
      document.getElementById(`nhomNghe_${priorityGlobal}`).value = nhomNganh;
      updateChiPhi(priorityGlobal, `phiCoban_${priorityGlobal}`);
      handleChangeSelect('noiTru', priorityGlobal);
      handleChangeSelect('noiTru20', priorityGlobal);
      handleChangeSelect('ngoaiTru', priorityGlobal);
      changeInputMoney('taiNanCC', priorityGlobal);
      changeInputMoney('hoTroVienPhi', priorityGlobal);

      // hide the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
      // clear selected data and search input
      selectedData.innerText = "Chọn nhóm ngành nghề";
      searchInput.value = "";

      modal.hide();
    }
  }
</script>
<script src="./index.js"></script>

</html>