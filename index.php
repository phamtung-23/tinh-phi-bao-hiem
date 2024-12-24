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
<html lang="vi">

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
        <div class="text-danger p-3 fs-2 fw-bold">Tính Phí Bảo Hiểm Dai-ichi</div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 d-flex justify-content-end p-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Xem ngành nghề</button>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog w-80 m-2" style="max-width: 100%;">
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
                          <input type="text" class="form-control shadow-sm no-text-input" id="ngaySinh_1" placeholder="DD/MM/YYYY" oninput="calculateAge(this, 1)">
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
                            <input type="number" class="form-control shadow-sm" id="nhomNghe_1" aria-describedby="emailHelp" onchange="updateChiPhi(1, 'phiCoban_1')" min="1" max="4" oninput="validateInputNhomNghe(this, 1)">
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
                            <option value="ATDT">AN THỊNH ĐẦU TƯ</option>
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
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru_1" onchange="handleChecked('noiTru', 1)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru_1">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon_1" disabled onchange="handleChangeSelect('noiTru', 1)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTruWrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTruPhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTruPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru20_1" onchange="handleChecked('noiTru20', 1)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru20_1">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon_1" disabled onchange="handleChangeSelect('noiTru20', 1)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTru20WrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTru20PhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTru20PhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="ngoaiTru_1" onchange="handleChecked('ngoaiTru', 1)">
                          </div>
                          <label class="form-check-label text-black" for="ngoaiTru_1">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon_1" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon_1" disabled onchange="handleChangeSelect('ngoaiTru', 1)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="ngoaiTruWrapperPhiCoBan_1" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="ngoaiTruPhiCoBan_1" class="form-label m-0 text-start text-label">Phi Cơ Bản</label>
                          <input type="email" class="form-control shadow-sm" id="ngoaiTruPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="taiNanCC_1" onchange="handleCheckedWithInputMoney('taiNanCC', 1)">
                          </div>
                          <label class="form-check-label text-black" for="taiNanCC_1">
                            Bảo Hiểm Tai Nạn Cao Cấp
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
                          <label for="taiNanCCPhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi_1" onchange="handleCheckedWithInputMoney('hoTroVienPhi', 1)">
                          </div>
                          <label class="form-check-label text-black" for="hoTroVienPhi_1">
                            Bảo Hiểm Hỗ Trợ Viện Phí
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
                          <label for="hoTroVienPhiPhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="hoTroVienPhiPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap_1" onchange="handleCheckedWithInputMoney('BHNCaoCap', 1)">
                          </div>
                          <label class="form-check-label text-black" for="BHNCaoCap_1">
                            Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện
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
                          <label for="BHNCaoCapPhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan_1" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHUngThu_1" onchange="handleCheckedWithInputMoney('BHUngThu', 1)">
                          </div>
                          <label class="form-check-label text-black" for="BHUngThu_1">
                            Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư
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
                          <label for="BHUngThuPhiCoBan_1" class="form-label m-0 text-start text-label">Phí cơ bản</label>
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
                            <th scope="col">NỬA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold" id="phiQuy_1">0</td>
                            <td class="text-danger fw-bold" id="phiNuaNam_1">0</td>
                            <td class="text-danger fw-bold" id="phi1Nam_1">0</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="1">Xóa</button>
                      <!-- <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button> -->
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
                          <label for="hoVaTen_2" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="text" class="form-control shadow-sm" id="hoVaTen_2" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh_2" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh_2" onchange="updateChiPhi(2, 'phiCoban_2')">
                            <option value="Nam" selected>Nam</option>
                            <option value="Nu">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh_2" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="text" class="form-control shadow-sm no-text-input" id="ngaySinh_2" placeholder="DD/MM/YYYY" oninput="calculateAge(this, 2)">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi_2" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="text" class="form-control shadow-sm" id="tuoi_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe_2" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <div class="d-flex align-items-center">
                            <input type="number" class="form-control shadow-sm" id="nhomNghe_2" aria-describedby="emailHelp" onchange="updateChiPhi(2, 'phiCoban_2')" min="1" max="4" oninput="validateInputNhomNghe(this, 2)">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="2">
                              <i class="ph ph-list-magnifying-glass fs-4"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru_2" onchange="handleChecked('noiTru', 2)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru_2">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon_2" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon_2" disabled onchange="handleChangeSelect('noiTru', 2)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTruWrapperPhiCoBan_2" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTruPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTruPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru20_2" onchange="handleChecked('noiTru20', 2)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru20_2">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon_2" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon_2" disabled onchange="handleChangeSelect('noiTru20', 2)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTru20WrapperPhiCoBan_2" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTru20PhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTru20PhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="ngoaiTru_2" onchange="handleChecked('ngoaiTru', 2)">
                          </div>
                          <label class="form-check-label text-black" for="ngoaiTru_2">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon_2" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon_2" disabled onchange="handleChangeSelect('ngoaiTru', 2)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="ngoaiTruWrapperPhiCoBan_2" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="ngoaiTruPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="ngoaiTruPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="taiNanCC_2" onchange="handleCheckedWithInputMoney('taiNanCC', 2)">
                          </div>
                          <label class="form-check-label text-black" for="taiNanCC_2">
                            Bảo Hiểm Tai Nạn Cao Cấp
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH_2" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH_2" oninput="changeInputMoney('taiNanCC', 2)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi_2" onchange="handleCheckedWithInputMoney('hoTroVienPhi', 2)">
                          </div>
                          <label class="form-check-label text-black" for="hoTroVienPhi_2">
                            Bảo Hiểm Hỗ Trợ Viện Phí
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon_2" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon_2" disabled onchange="changeInputMoney('hoTroVienPhi', 2)">
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
                          <label for="hoTroVienPhiPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="hoTroVienPhiPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap_2" onchange="handleCheckedWithInputMoney('BHNCaoCap', 2)">
                          </div>
                          <label class="form-check-label text-black" for="BHNCaoCap_2">
                            Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapSotienBH_2" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapSotienBH_2" oninput="changeInputMoney('BHNCaoCap', 2)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHUngThu_2" onchange="handleCheckedWithInputMoney('BHUngThu', 2)">
                          </div>
                          <label class="form-check-label text-black" for="BHUngThu_2">
                            Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuSotienBH_2" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuSotienBH_2" oninput="changeInputMoney('BHUngThu', 2)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan_2" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuPhiCoBan_2" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <hr id="lineRed_2" style="color: red;" class="d-none">
                    <div class="row">
                      <table class="table table-bordered d-none" id="tableMain_2">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỬA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold" id="phiQuy_2">0</td>
                            <td class="text-danger fw-bold" id="phiNuaNam_2">0</td>
                            <td class="text-danger fw-bold" id="phi1Nam_2">0</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="2">Xóa</button>
                      <!-- <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button> -->
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
                          <label for="hoVaTen_3" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="text" class="form-control shadow-sm" id="hoVaTen_3" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh_3" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh_3" onchange="updateChiPhi(3, 'phiCoban_3')">
                            <option value="Nam" selected>Nam</option>
                            <option value="Nu">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh_3" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="text" class="form-control shadow-sm no-text-input" id="ngaySinh_3" placeholder="DD/MM/YYYY" oninput="calculateAge(this, 3)">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi_3" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="text" class="form-control shadow-sm" id="tuoi_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe_3" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <div class="d-flex align-items-center">
                            <input type="number" class="form-control shadow-sm" id="nhomNghe_3" aria-describedby="emailHelp" onchange="updateChiPhi(3, 'phiCoban_3')" min="1" max="4" oninput="validateInputNhomNghe(this, 3)">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="3">
                              <i class="ph ph-list-magnifying-glass fs-4"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru_3" onchange="handleChecked('noiTru', 3)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru_3">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon_3" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon_3" disabled onchange="handleChangeSelect('noiTru', 3)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTruWrapperPhiCoBan_3" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTruPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTruPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru20_3" onchange="handleChecked('noiTru20', 3)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru20_3">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon_3" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon_3" disabled onchange="handleChangeSelect('noiTru20', 3)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTru20WrapperPhiCoBan_3" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTru20PhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTru20PhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="ngoaiTru_3" onchange="handleChecked('ngoaiTru', 3)">
                          </div>
                          <label class="form-check-label text-black" for="ngoaiTru_3">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon_3" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon_3" disabled onchange="handleChangeSelect('ngoaiTru', 3)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="ngoaiTruWrapperPhiCoBan_3" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="ngoaiTruPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="ngoaiTruPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="taiNanCC_3" onchange="handleCheckedWithInputMoney('taiNanCC', 3)">
                          </div>
                          <label class="form-check-label text-black" for="taiNanCC_3">
                            Bảo Hiểm Tai Nạn Cao Cấp
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH_3" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH_3" oninput="changeInputMoney('taiNanCC', 3)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi_3" onchange="handleCheckedWithInputMoney('hoTroVienPhi', 3)">
                          </div>
                          <label class="form-check-label text-black" for="hoTroVienPhi_3">
                            Bảo Hiểm Hỗ Trợ Viện Phí
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon_3" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon_3" disabled onchange="changeInputMoney('hoTroVienPhi', 3)">
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
                          <label for="hoTroVienPhiPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="hoTroVienPhiPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap_3" onchange="handleCheckedWithInputMoney('BHNCaoCap', 3)">
                          </div>
                          <label class="form-check-label text-black" for="BHNCaoCap_3">
                            Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapSotienBH_3" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapSotienBH_3" oninput="changeInputMoney('BHNCaoCap', 3)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHUngThu_3" onchange="handleCheckedWithInputMoney('BHUngThu', 3)">
                          </div>
                          <label class="form-check-label text-black" for="BHUngThu_3">
                            Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuSotienBH_3" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuSotienBH_3" oninput="changeInputMoney('BHUngThu', 3)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan_3" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuPhiCoBan_3" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <hr id="lineRed_3" style="color: red;" class="d-none">
                    <div class="row">
                      <table class="table table-bordered d-none" id="tableMain_3">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỬA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold" id="phiQuy_3">0</td>
                            <td class="text-danger fw-bold" id="phiNuaNam_3">0</td>
                            <td class="text-danger fw-bold" id="phi1Nam_3">0</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-danger btn-block mb-4 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="3">Xóa</button>
                      <!-- <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính phí</button> -->
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
                          <label for="hoVaTen_4" class="form-label m-0 text-start text-label">Họ và Tên</label>
                          <input type="text" class="form-control shadow-sm" id="hoVaTen_4" aria-describedby="emailHelp">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="gioiTinh_4" class="form-label m-0 text-start text-label">Giới tính</label>
                          <select class="form-select" aria-label="Default select example" id="gioiTinh_4"
                            onchange="updateChiPhi(4, 'phiCoban_4')">
                            <option value="Nam" selected>Nam</option>
                            <option value="Nu">Nữ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngaySinh_4" class="form-label m-0 text-start text-label">Ngày sinh</label>
                          <input type="text" class="form-control shadow-sm no-text-input" id="ngaySinh_4" placeholder="DD/MM/YYYY"
                            oninput="calculateAge(this, 4)">
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="tuoi_4" class="form-label m-0 text-start text-label">Tuổi</label>
                          <input type="text" class="form-control shadow-sm" id="tuoi_4" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="nhomNghe_4" class="form-label m-0 text-start text-label">Nhóm nghề</label>
                          <div class="d-flex align-items-center">
                            <input type="number" class="form-control shadow-sm" id="nhomNghe_4" aria-describedby="emailHelp"
                              onchange="updateChiPhi(4, 'phiCoban_4')" min="1" max="4" oninput="validateInputNhomNghe(this, 4)">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                              data-bs-whatever="4">
                              <i class="ph ph-list-magnifying-glass fs-4"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru_4" onchange="handleChecked('noiTru', 4)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru_4">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTruLuaChon_4" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTruLuaChon_4" disabled
                            onchange="handleChangeSelect('noiTru', 4)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTruWrapperPhiCoBan_4" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTruPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTruPhiCoBan_4" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="noiTru20_4" onchange="handleChecked('noiTru20', 4)">
                          </div>
                          <label class="form-check-label text-black" for="noiTru20_4">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="noiTru20LuaChon_4" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="noiTru20LuaChon_4" disabled
                            onchange="handleChangeSelect('noiTru20', 4)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="noiTru20WrapperPhiCoBan_4" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="noiTru20PhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="noiTru20PhiCoBan_4" aria-describedby="emailHelp"
                            disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="ngoaiTru_4" onchange="handleChecked('ngoaiTru', 4)">
                          </div>
                          <label class="form-check-label text-black" for="ngoaiTru_4">
                            Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="ngoaiTruLuaChon_4" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="ngoaiTruLuaChon_4" disabled
                            onchange="handleChangeSelect('ngoaiTru', 4)">
                            <option value="co_ban">Cơ Bản</option>
                            <option value="pho_thong" selected>Phổ Thông</option>
                            <option value="dac_biet">Đặc Biệt</option>
                            <option value="cao_cap">Cao Cấp</option>
                            <option value="thinh_vuong">Thịnh Vượng</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div id="ngoaiTruWrapperPhiCoBan_4" class="mb-3 d-flex flex-column justify-content-start d-none">
                          <label for="ngoaiTruPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="ngoaiTruPhiCoBan_4" aria-describedby="emailHelp"
                            disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="taiNanCC_4" onchange="handleCheckedWithInputMoney('taiNanCC', 4)">
                          </div>
                          <label class="form-check-label text-black" for="taiNanCC_4">
                            Bảo Hiểm Tai Nạn Cao Cấp
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCSotienBH_4" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCSotienBH_4"
                            oninput="changeInputMoney('taiNanCC', 4)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="taiNanCCPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="email" class="form-control shadow-sm" id="taiNanCCPhiCoBan_4" aria-describedby="emailHelp"
                            disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="hoTroVienPhi_4" onchange="handleCheckedWithInputMoney('hoTroVienPhi', 4)">
                          </div>
                          <label class="form-check-label text-black" for="hoTroVienPhi_4">
                            Bảo Hiểm Hỗ Trợ Viện Phí
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="hoTroVienPhiLuaChon_4" class="form-label m-0 text-start text-label">Lựa chọn</label>
                          <select class="form-select" aria-label="Default select example" id="hoTroVienPhiLuaChon_4" disabled
                            onchange="changeInputMoney('hoTroVienPhi', 4)">
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
                          <label for="hoTroVienPhiPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="hoTroVienPhiPhiCoBan_4" aria-describedby="emailHelp"
                            disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHNCaoCap_4" onchange="handleCheckedWithInputMoney('BHNCaoCap', 4)">
                          </div>
                          <label class="form-check-label text-black" for="BHNCaoCap_4">
                            Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapSotienBH_4" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapSotienBH_4"
                            oninput="changeInputMoney('BHNCaoCap', 4)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHNCaoCapPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHNCaoCapPhiCoBan_4" aria-describedby="emailHelp"
                            disabled>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-2 d-flex align-items-center">
                      <div class="col-sm-4">
                        <div class="form-check mb-3 d-flex justify-content-start align-items-center gap-2">
                          <div>
                            <input class="form-check-input" type="checkbox" value="" id="BHUngThu_4" onchange="handleCheckedWithInputMoney('BHUngThu', 4)">
                          </div>
                          <label class="form-check-label text-black" for="BHUngThu_4">
                            Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư
                          </label>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuSotienBH_4" class="form-label m-0 text-start text-label">Số tiền bảo hiểm</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuSotienBH_4"
                            oninput="changeInputMoney('BHUngThu', 4)" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="mb-3 d-flex flex-column justify-content-start">
                          <label for="BHUngThuPhiCoBan_4" class="form-label m-0 text-start text-label">Phí cơ bản</label>
                          <input type="text" class="form-control shadow-sm" id="BHUngThuPhiCoBan_4" aria-describedby="emailHelp" disabled>
                        </div>
                      </div>
                    </div>

                    <hr id="lineRed_4" style="color: red;" class="d-none">
                    <div class="row">
                      <table class="table table-bordered d-none" id="tableMain_4">
                        <thead class="table-primary">
                          <tr>
                            <th scope="col">QÚY</th>
                            <th scope="col">NỬA NĂM</th>
                            <th scope="col">NĂM</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <tr>
                            <td class="text-danger fw-bold" id="phiQuy_4">0</td>
                            <td class="text-danger fw-bold" id="phiNuaNam_4">0</td>
                            <td class="text-danger fw-bold" id="phi1Nam_4">0</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <hr style="color: red;">
                    <!-- Submit button -->
                    <div class="row d-flex justify-content-center mt-3">
                      <button data-mdb-ripple-init type="button" style="width: 150px;"
                        class="btn btn-danger btn-block mb-4 m-1" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="4">Xóa</button>
                      <!-- <button data-mdb-ripple-init type="button" style="width: 150px;" class="btn btn-success btn-block mb-4 m-1">Tính
                        phí</button> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa dữ liệu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Bạn có chắc chắn muốn Xóa dữ liệu không?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
              <button type="button" class="btn btn-danger" onclick="clearData()">Xóa</button>
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
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold" id="totalQuy">QUÝ (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold" id="totalNuaNam">Nửa năm (VNĐ): 0</div>
      </div>
      <div class="col-sm-4 d-flex justify-content-center text-bg-light pb-3">
        <div class="text-primary-emphasis pt-2 pb-2 fs-6 fw-semibold" id="total1Nam">Năm (VNĐ): 0</div>
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

  var danhSachNhomNghe = [
    "Bảo vệ-Các cơ quan hành chính sự nghiệp/trường học/văn phòng công ty - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Bưu điện-Nhân viên quầy giao dịch/phân loại thư - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Các mặt hàng THÔNG THƯỜNG và ít di chuyển xa - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất xe-Kỹ sư, chủ cửa hàng, quản lý, bán hàng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Cảnh sát/Công an-Nhân viên hành chính văn phòng (không có quân hàm) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Nghề thông dụng-Hưu trí, Kinh doanh tự do, Nội trợ, Giúp việc nhà - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Hướng dẫn viên tại văn phòng (không theo đoàn) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên giữ xe - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Nhân viên văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên phục vụ bàn, phục vụ phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Bán vé, phục vụ, vệ sinh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Rừng-Kiểm lâm, phụ trách hành chính văn phòng, không tuần tra - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngư nghiệp/Sông-Trực tiếp nuôi trồng thủy sản trên đất liền/ao - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhà văn, Nhà thơ - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Nước-Kỹ sư, Quản lý, Giám sát viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thể thao-Huấn huyện viên cử tạ, đường đua, tennis, cầu lông, bơi lội - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Nông dân (ruộng, rẫy, rau, hoa, củ, quả, bông, thuốc lá..) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Bác sĩ, y tá làm việc trong nhà tù/trại giam - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Bác sĩ, y tá, điều dưỡng, dược sĩ, kĩ thuật viên xét nghiệm/gây mê - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Bưu điện-Kỹ sư, cán bộ quản lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trẻ em - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Trình dược viên, Tư vấn tài chính, Thu ngân, Thư ký - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Cảnh sát/Công an-Cán bộ hải quan (không có quân hàm công an) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Chăn nuôi-Chăn nuôi gia súc/ gia cầm tại hộ gia đình, nuôi tằm - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Chăn nuôi-Người điều hành trang trại (không trực tiếp chăn nuôi) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Bowling-Nhân viên vệ sinh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Golf - Bowling-Quản lý, Công nhân bảo dưỡng, bảo trì sân golf - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Golf - Bowling-Huấn luyện viên, nhân viên lượm banh (cady) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hồ Bơi-Huấn luyện viên hồ bơi - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Golf - Bowling-Nhân viên ghi điểm, thu ngân, bán vé, phụ trách - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Nhân viên điều hành trang thiết bị điện - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "DV giải trí/Các lĩnh vực khác-Nhân viên điều hành trang thiết bị điện - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Đạo diễn, Nhà sản xuất, Người viết kịch bản phim - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Nghệ sĩ hóa trang, Nhân viên nhà hát kịch - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Nhân viên phụ trách ánh sáng và tiếng động - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Kỹ sư/quản lý/giám sát phòng điều khiển/chiếu phim - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Nhân viên khâu kịch bản - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Nhân viên khai thác/xử lý phim âm bản - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Chủ nhiệm/phát hành phim/Người dẫn chương trình - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện ảnh/Truyền hình-Biên tập viên/ Phóng viên làm việc văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất giấy-Công nhân kiểm hàng hóa bao bì - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Đốc công, công nhân may/thêu/trải vải - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-KCS/thợ may/thợ đóng giày, phân số - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Nhân viên thiết kế, kỹ sư, quản lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất Nhựa/Cao su/Da-Kỹ sư/ kỹ sư hóa giám sát, Quản lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện tử-Kỹ sư, Đốc công, Quản lý, Giám sát viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ăn uống/Chế biến thực phẩm-Kỹ thuật viên, nghiên cứu sản phẩm mới - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thuốc lá-Kỹ thuật viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất xe-Công nhân/thợ sửa chữa, bảo trì xe đạp - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất xe-Công nhân/ thợ rửa xe, thợ dán đề can (decal) các loại xe - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Xi măng/Vôi/Thạch cao-Kỹ sư, nhân viên làm việc văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "CNTT-Cử nhân, Kỹ sư (mạng máy tính/khoa học/kỹ thuật máy tính) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "CNTT-Chủ tiệm, nhân viên tiệm Internet/ Game; Kỹ sư kinh doanh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "CNTT-Kỹ thuật phần mềm/hệ thống thông tin/ truyền thông/đồ họa - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên hành chính văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Giáo dục-Giáo viên, Giáo viên thể dục/giáo dục quốc phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Giáo dục-Học sinh, Sinh viên (trừ sinh viên học viện quân sự), Học viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng không-Lãnh đạo sân bay. Kiểm soát viên điều khiển không lưu - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng không-Nhân viên hải quan/ văn phòng/ dịch vụ, soát vé, thu phí - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng không-Nhân viên đài hoa tiêu - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng không-Nhân viên vệ sinh sân bay, buồng lái. - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng không-Phát ngôn viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường bộ-Nhân viên/Phụ trách văn phòng, trạm thu phí, bán vé xe - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường sắt-Ban giám đốc/Nhân viên/Kỹ sư văn phòng, phòng vé, dịch vụ - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường sắt-Nhân viên/bảo vệ chắn tàu, Soát vé, Phục vụ trên tàu - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường sắt-Trưởng ga, Phát thanh viên, Nhân viên vệ sinh tàu/sân ga. - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Cảng-Nhân viên hải quan - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường sông-Dân cư đi lại bằng ghe/thuyền ở vùng sông nước - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Chế biến gỗ-Nhân viên hành chính - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Rừng-Nghiên cứu thí nghiệm giống cây, nghiên cứu thổ nhưỡng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Điều hành, văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Quản lý, Thu ngân, Tiếp tân, Tư vấn - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên trực cửa/pha chế/dọn dẹp - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên kinh doanh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Điều tra viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Giám đốc, Quản lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Công nhân tiệm giặt ủi - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Công nhân lau chùi/phụ việc vặt - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Giữ trẻ, Vú em - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Làm nhang, hàng mã - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Người môi giới (nội bộ) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên cân cầu đuờng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên nhà tắm hơi - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên phòng công chứng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên phụ trách khai báo hải quan - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Chăm sóc sắc đẹp-Phun xăm thẩm mỹ, kỹ thuật viên Thẩm mỹ viện - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên trạm sửa chữa - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Nhân viên viện bảo tàng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Thầy địa lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Thợ chụp hình tại tiệm/studio - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Thợ sửa đồng hồ/ điện thoại di động - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Chăm sóc sắc đẹp-Thợ làm tóc, gội đầu, rửa mặt, làm móng, trang điểm - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Thủ thư - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Trợ lý bán hàng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngư nghiệp/Sông-Điều hành, quản lý, Cán bộ thủy nông, nghiên cứu - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện/viễn thông-Kỹ sư điện phụ trách tư vấn/ thiết kế - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện/viễn thông-Kỹ sư trưởng nhà máy năng lượng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện/viễn thông-Nhân viên phụ trách hành chính - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên dựng và quay phim quảng cáo - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thể thao-Huấn huyện viên/Vận động viên môn Bi sắt, bắn cung, bowling - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thể thao-Huấn huyện viên bóng chày, bóng chuyền, bóng ném, bóng rổ - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thể thao-Huấn huyện viên/Vận động viên billiards, bóng bàn, golf - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thể thao-Huấn huyện viên thể dục dụng cụ, trượt băng, Yoga - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên hành chính, kinh doanh, chế bản - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quảng cáo/Báo chí/Truyền hình-Nhà văn, Nhà thơ, Họa sĩ, Biên tập viên, MC - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên/ Nhà báo làm việc văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quảng cáo/Báo chí/Truyền hình-Thợ xếp chữ. Chủ hiệu. Chủ kinh doanh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Nghề thông dụng-Tu sĩ/Cha cố/nhân viên tôn giáo/đền đài/nhà thờ. - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Nhà ươm cây/ ươm hoa, Chủ vườn cây/ trồng cây ăn trái - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Điều hành nông trại không trực tiếp tham gia sản xuất - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Trồng, thu hoạch cà phê, Chủ quản lý vườn cây công nghiệp - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Chủ đồn điền/nông trường. Buôn bán máy móc nông nghiệp - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Trồng trọt-Làm muối, Kỹ thuật viên/hướng dẫn viên nông nghiệp - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Xây dựng-Nhân viên điều khiển thang máy/cáp treo (trên mặt đất). - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Xây dựng-Nhân viên thiết kế/họa sĩ/họa viên làm việc văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường sắt/cầu đường-Nhân viên đo đạc địa hình (vùng đồng bằng) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Thủy điện - Thủy lợi-Nhân viên đo đạc địa hình (vùng đồng bằng) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Công nhân phụ việc vặt - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Nhân viên vệ sinh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Nhân viên y tế hành chính - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Nữ hộ sinh, hộ lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Thanh tra bệnh học - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Y tế-Nhân viên phân tích; Giám định pháp y - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ăn uống/Chế biến thực phẩm-Chủ không trực tiếp sản xuất/nấu nướng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ăn uống/Chế biến thực phẩm-Quản lý, kiểm tra chất lượng thực phẩm - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Bảo hiểm, vé tàu/vé xe/vé máy bay/vé số tại đại lý, tại nhà - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Chủ tiệm, quản lý cửa hàng/siêu thị/TT thương mại/ tại nhà - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Nhân viên bán trong cửa hàng/siêu thị/TT thương mại/ tại nhà - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Nhân viên kinh doanh có ra ngoài gặp khách hàng bằng xe máy - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Thiết bị điện/ điện tử/ Xe, ôtô - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Thức ăn chăn nuôi, phân bón - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Thuốc tây, tạp hóa, thực phẩm, rau quả, thịt, hải sản - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Buôn bán-Vật liệu xây dựng/sắt/thép/tôn/nhôm/kính/nội thất - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Cảnh sát/Công an-Giảng viên, sinh viên ngành an ninh/cảnh sát/sĩ quan - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Người mẫu ảnh - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Hàng thủ công mỹ nghệ-Thợ đan dây nhựa - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Dịch vụ mai táng (nhân viên nhà đòn và chôn cất) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngành nghề khác-Dịch vụ mai táng (ướp xác, tẩm liệm xác) - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Ngư nghiệp/Biển-Đan lưới, vá lưới - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Nghề thông dụng-Ban giám đốc, chủ doanh nghiệp, cán bộ quản lý - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Điện/viễn thông-Thợ sửa điện thoại bàn/ điện thoại di động - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quân đội-Bác sĩ, y tá bệnh viện quân y - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quân đội-Bộ đội xuất ngũ đang chờ việc - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Quản lý đô thị-Quản lý, giám sát viên - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Xây dựng-Giám đốc công ty xây dựng, không đi công trình - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Xây dựng-Kiến trúc sư thiết kế, kỹ sư xây dựng làm việc văn phòng - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Sản xuất xe-Công nhân kiểm tra chất lượng lốp ô tô - <span class='text-danger fw-bolder'>Nhóm 1</span>",
    "Đường bộ-Quản lý điều hành đội xe, không lái. Quản lý bến xe, kiểm định - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường bộ-Tài xế xe cứu thương/ xe cứu hỏa/ xe xích lô/ ba gác đạp - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường sắt-Công nhân nạp nhiên liệu. Bảo vệ ga/ bảo vệ trên tàu - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảng-Kiểm tra viên, Quản lý/ Giám sát, Nhân viên giữ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "CNTT-Kỹ thuật viên lắp ráp/sửa chữa/bảo trì máy vi tính, laptop - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Xi măng/Vôi/Thạch cao-Giám sát viên, kỹ thuật viên, kỹ sư tại xưởng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân vận hành máy, Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "CNTT-Kỹ thuật viên kiểm tra chất lượng sản phẩm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất xe-Chủ quản lý tại gara - không trực tiếp làm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất xe-Đốc công, giám sát viên, kỹ thuật viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thuốc lá-Công nhân sản xuất, công đoạn khác. Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thiết bị phụ tùng điện-Công nhân lắp ráp, Công nhân đóng gói - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Công nhân điều khiển ở xưởng nghiền đá - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Công nhân sản xuất chế biến thực phẩm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Công nhân sản xuất nước đá - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Giết mổ gia cầm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất Nhựa/Cao su/Da-Đốc công, giám sát viên, kỹ thuật viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất Nhựa/Cao su/Da-Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện tử-Công nhân đóng gói/ kiểm hàng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thiết kế mẫu đúc - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Kỹ sư cơ khí, Giám sát/Đốc công - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân xe sợi vải, cắt, chặt, mài, keo - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất hóa chất-Kỹ sư hóa dầu. Kỹ sư/ nhân viên phòng thí nghiệm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất hóa chất-Kỹ thuật viên kiểm phẩm. Công nhân đóng gói. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Kiếng/Thủy tinh-Thủ kho, quản lý, đốc công, chủ xưởng, chủ cửa hàng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Nệm/gối/gấu bông-Công nhân sản xuất, nhuộm, hồ. Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Thủ kho, kỹ thuật viên, Thợ sửa máy may - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Gốm/Gạch/Sứ-Thủ kho, Chủ lò gạch, Chủ lò gốm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hàng nội thất-Kỹ thuật viên, đốc công, giám sát viên, thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hàng thủ công mỹ nghệ-Sản xuất hàng đá mỹ nghệ, đan mây tre liễu gai - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hàng thủ công mỹ nghệ-Kiểm tra nguyên liệu, đóng gói. Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Ủi/hấp/sấy/nhuộm/in/vẽ/phân loại/đóng gói - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất giấy-Kỹ thuật viên, giám sát viên, thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện ảnh/Truyền hình-Nhân viên đạo cụ, dựng cảnh phim trường/sân khấu - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Sơn/ Hóa chất/Thuốc trừ sâu/Bình ắcquy/Phế liệu; Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hồ Bơi-Nhân viên cứu nạn tại hồ bơi - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên/Chủ quán bar, phòng trà, karaoke - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Giải trí đặc biệt-Nhân viên quán café/ quán rượu/ bar/ phòng trà - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Giải trí đặc biệt-Nhân viên pha chế (bartender) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Giải trí đặc biệt-Nhân viên tụ điểm ca nhạc/ nhân viên spa - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Giải trí đặc biệt-Nhân viên karaoke/ vũ trường - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Nghệ sĩ điêu khắc - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên nhà hát kịch, Nghệ sĩ cải lương - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăn nuôi-Người bắt động vật ở đồng, rẫy (chuột, rắn, …) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Cảnh sát, dân phòng phụ trách an ninh khu vực - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Công an/Quản giáo trại giam - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Công an chốt đèn/ trật tự giao thông tại trạm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Xử lý giao thông, tai nạn/ thanh tra giao thông - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăn nuôi-Bác sĩ thú y/ nhân viên thú y (vật nuôi) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Kinh tế (không liên quan chống buôn lậu qua biên giới) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Bưu điện-Nhân viên chuyển phát thư/giao nhận hàng hóa - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Bưu điện-Tài xế lái xe đưa thư - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Chủ tiệm cầm đồ - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Bác sĩ thú y (thú cưng, chăn nuôi) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Xây dựng-Kỹ sư giám sát công trình, Đốc công, thầu/cai xây dựng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường bộ-Tài xế lái xe cơ quan/ công ty, Tài xế xe đưa thư/ bưu kiện - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hàng không-Phi công/ Tiếp viên hàng không (hãng hàng không dân dụng) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường sắt-Lái tàu, Phụ lái. Giám sát hàng hóa vận tải. Kỹ sư cơ khí - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện/viễn thông-Nhân viên ghi chỉ số đồng hồ/ thu tiền - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăn nuôi-Công nhân/Người trực tiếp chăn nuôi gia súc trang trại - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Trồng trọt-Người sử dụng máy tuốt lúa, máy gặt. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăn nuôi-Nuôi ong, nuôi đà điểu - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Nhân viên phòng hồ sơ chiến thuật (học viện quân sự) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Quân nhân phụ trách hành chính, hậu cần, quân y & thông tin mặt đất. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Huấn huyện viên bóng bầu dục, bóng đá, võ thuật - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Vận động viên/Cầu thủ bóng chày, bóng chuyền, bóng rổ - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện ảnh/Truyền hình-Nhân viên quay phim, chụp ảnh - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện tử-Công nhân lắp ráp/ điều hành, chế tạo mạch tổ hợp - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện tử-Kỹ thuật viên, Thợ sửa chữa đồ điện tử, Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Công nhân đóng gói - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngư nghiệp/Sông-Nuôi thủy sản, cá bè - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện ảnh/Truyền hình-Diễn viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thiết bị phụ tùng điện-Kỹ sư, Đốc công, Giám sát viên, Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngư nghiệp/Sông-Đánh bắt cá trên đồng, rẫy - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăm sóc sắc đẹp-Nhân viên massage/bấm huyệt/xông hơi tại cơ sở/spa/salon - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Bảo vệ-Khu vui chơi giải trí, công viên, kho bãi - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Ca sĩ, Nhạc sĩ, Nhạc công - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Sản xuất, làm bánh tráng/bánh ướt/bánh mì - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Đầu bếp/nấu ăn/phục vụ trong bếp - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Buôn bán có giao hàng, chở hàng bằng xe máy - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Hướng dẫn viên du lịch theo đoàn - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên làm việc bên ngoài - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quản lý đô thị-Công nhân vệ sinh đường phố, gom rác, quét đường - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất xe-Thợ sửa chữa và bảo trì xe gắn máy, Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Cảnh sát/Công an-Làm việc văn phòng, xã/ phường/quận/ huyện/ tỉnh. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Buôn bán có trực tiếp nấu/quán ăn di động/quán lề đường - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Vàng bạc/đá quý/kim cương/ngoại tệ - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Các mặt hàng dễ cháy nổ/Xăng/Dầu/Gas; Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Lắp đặt dụng cụ gas/khí hóa lỏng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất Nhựa/Cao su/Da-Công nhân cạo mủ cao su - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Sản xuất Nhựa/Cao su/Da-Công nhân đóng gói/kiểm tra vệ sinh chai - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Gỗ tại xưởng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Bảo vệ-Kho bạc, nhà hàng, khách sạn, nhà máy, bệnh viện, siêu thị - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Nhân viên làm răng sứ giả; sản xuất/đóng gói thuốc, dụng cụ y tế - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Nhân viên y tế, giám sát viên trong BV tâm thần/ trại cai nghiện - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Bộ đội/Sỹ quan làm việc văn phòng, tham mưu, kiểm soát quân sự. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Hải quân trên đất liền. - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngư nghiệp/Biển-Bắt ốc, bắt phi ốc ven bờ khi nước biển cạn - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngư nghiệp/Biển-Đan lưới có cắn chì - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Nước-Công nhân điều khiển, vận hành trong nhà máy cấp thoát nước - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Sỹ quan binh chủng bộ binh, huấn luyện tân binh mới - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quản lý đô thị-Công nhân chăm sóc cây, tưới cây - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngành nghề khác-Thợ chụp ảnh/quay phim ngoại cảnh, đám cưới, phim trường - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Hàng thủ công mỹ nghệ-Làm cầu lông, sản phẩm sơn mài, mỹ nghệ, sơn - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Nhân viên hóa phân tích - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Người mẫu thời trang - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Gốm/Gạch/Sứ-Thợ/công nhân vẽ trang trí trên gốm, sửa khô sản phẩm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chăn nuôi-Nhân viên chế biến sản phẩm nông nghiệp - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên thu phí lưu động - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Sản xuất, làm bánh kẹo/bánh kem/kem lạnh - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Làm phở/hủ tiếu/mì/bún/miến/giò chả - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Nhân viên vật lý trị liệu - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thủy điện - Thủy lợi-Kỹ sư, Giám sát, đốc công tại công trình - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Chủ cơ sở giết mổ gia súc (không làm) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Đầu bếp trong bệnh viện - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Y tế-Bác sĩ, y tá, điều dưỡng trong BV tâm thần/ trại cai nghiện - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường sắt/cầu đường-Đốc công và giám sát viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Đường sắt/cầu đường-Kỹ sư, Nhân viên đo đạc khảo sát giao thông - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Xây dựng-Quản lý/chủ tiệm cơ sở làm cửa nhôm, sắt (không làm) - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Huấn huyện/Vận động viên lướt nước, đua thuyền, thuyền buồm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Trồng trọt-Công nhân điều khiển/sửa chữa/bảo trì máy nông nghiệp - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Trồng trọt-Trồng tiêu/điều/cao su/chè (trà)/mía/ca cao/dừa, hái chè - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Tòa án-Nhân viên cưỡng chế thi hành án - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Tòa án-Điều tra viên và nhân viên phụ trách tội phạm kinh tế - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Tòa án-Quan tòa, luật sư, thư ký, thông dịch viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quảng cáo/Báo chí/Truyền hình-Công nhân in. Thợ in. Thợ đóng sách - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quảng cáo-Thợ vẽ/ dựng bảng hiệu dưới đất - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quảng cáo/Báo chí/Truyền hình-Nhân viên phát hành báo/ giao phát báo - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Vận động viên/Cầu thể dục dụng cụ, trượt băng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Huấn huyện viên khúc côn cầu, bóng ném - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Vận động viên/Cầu thủ cử tạ, đường đua, tennis, cầu lông - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Thể thao-Huấn huyện/Vận động viên bắn súng, du thuyền - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Sỹ quan/ bộ đội trực chỉ đồn biên phòng không tuần tra thực địa - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện/viễn thông-Nhân viên hành chính tại nhà máy/ trạm phát điện - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện/viễn thông-Kiểm tra viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ngư nghiệp/Sông-Điều hành trại cá, chế biến thủy hải sản. Thủ kho - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Điện/viễn thông-Kỹ sư giám sát & kiểm tra trên máy tính, bảng điện tử - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Nước-Nhân viên ghi chỉ số đồng hồ nước/ đưa giấy báo/ thu tiền nước - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Nước-Nhân viên hành chính làm việc cho đập nước & hồ chứa - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Nước-Nhân viên kiểm tra chất lượng nước trong nhà máy, công trình - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Quân đội-Giáo viên/ Sỹ quan dạy môn giáo dục quốc phòng - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Ăn uống/Chế biến thực phẩm-Người trực tiếp nấu rượu - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Buôn bán-Nhân viên tiếp thị sản phẩm; Bán vé số dạo - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Du lịch/Nhà hàng/Khách sạn/Quán ăn-Nhân viên chuyển hành lý/khuân vác - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Rừng-Quản đốc, Ươm cây ở lâm trường - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chế biến gỗ-Thợ đánh dấu gỗ, đo đạc, phân loại gỗ, chà nhám gỗ - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chế biến gỗ-Chủ xưởng, Quản đốc, kiểm tra viên - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Chế biến gỗ-Khâu hoàn thiện sản phẩm. Thợ lắp ráp sản phẩm - <span class='text-danger fw-bolder'>Nhóm 2</span>",
    "Rừng-Công nhân trồng rừng, trồng bạch đàn/keo lá tràm/ phi lao/ dương - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Rừng-Nhân viên chữa cháy rừng, Ban quản lý rừng phòng hộ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chế biến gỗ-Công nhân bảo quản, sản xuất ván ép - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chế biến gỗ-Thợ cưa xẻ gỗ tại xưởng/Thợ mộc/Lắp ráp gỗ nội thất - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảng-Công nhân xưởng đóng tàu, Kỹ sư, Đốc công (tại cảng/đất liền) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Tuyển than trên băng truyền - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Kỹ sư/kỹ thuật viên/đốc công - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Phụ trách an toàn mỏ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Nhân viên khảo sát địa chất - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân sản xuất, chế biến - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Nhân viên hộ tống chở tiền - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Lao động phổ thông (không làm việc trên cao >=4m/ hóa chất/ thuốc nổ) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Bộ đội, sỹ quan đồn biên phòng (có tuần tra thực địa); - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Bộ đội làm việc trong các đơn vị phụ trách vũ khí, đạn dược - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Nghĩa vụ quân sự, quân nhân mới nhập ngũ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân đặc biệt (biệt kích/đặc công) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân đảm đương nhiệm vụ đặc biệt trong cơ quan tình báo - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân phụ trách bộc phá; người nhái; hải quân trên đảo/biển - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân tiền tuyến - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân vũ khí hóa học, thử chất nổ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Sinh viên học viện quân sự - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Kỹ sư nhà máy năng lượng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Nhân viên điều hành máy tuabin/ phòng phát điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Kỹ thuật viên, nhân viên kiểm tra máy phát - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân lắp ráp/bảo trì/phụ trách bảng điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân bảo trì cao ốc văn phòng & nhà máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Kỹ thuật viên lắp đặt & bảo trì điện kế/ đồng hồ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân đặt cáp ngầm, cáp quang bưu điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước-Công nhân bảo trì - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước-Công nhân nhà máy nước - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước-Giám sát viên, kiểm tra viên, công nhân lắp đặt máy móc mạ điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước-Giám sát viên, kiểm tra viên, công nhân đường hầm - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thể thao-Vận động viên/Cầu thủ bóng đá, võ thuật - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thể thao-Huấn huyện viên/Vận động viên lướt ván, xuồng máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Công nhân chống thấm. Công nhân sửa chữa, bảo trì thang máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ trang trí nội thất, Thợ ống nước - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Trồng trọt-Lái xe công nông, Lái máy cày tay, nạo vét mương - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ làm cửa nhôm/ kính. Thợ làm cửa sắt tại xưởng cơ khí - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ làm trần thạch cao, la phông, Thợ điêu khắc ở độ cao<4m - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Nhân viên đo đạc địa hình (vùng núi/ngoài khơi) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thủy điện - Thủy lợi-Bảo vệ công trường - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thủy điện - Thủy lợi-Nhân viên đo đạc địa hình (vùng núi/ngoài khơi) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Bảo vệ công trường - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Công nhân kỹ thuật công trình trên mặt đất. - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Công nhân bảo trì, lắp đặt đường ống. - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Công nhân địa chất/ khoan máy, khoan giếng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Y tế-Bác sĩ thú y (trong sở thú) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Dịch vụ/Ngân hàng/Bảo hiểm/Thuế/Tài chính-Tài xế chở tiền mặt - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chăm sóc sắc đẹp-Thợ xăm hình tại tiệm - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Sửa chữa, bảo trì, vận hành trong nhà máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chăn nuôi-Nhân viên huấn luyện chó, nhân viên bắt chó. Giết mổ gia súc - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Huấn luyện chó - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Lính cứu hỏa, đội cứu nạn cứu hộ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Công an nghĩa vụ (nghĩa vụ quân sự) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Kiếng/Thủy tinh-Công nhân ép hơi, pha màu, phối màu, đánh bóng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Kiếng/Thủy tinh-Công nhân lắp ráp, vận hành máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Kiếng/Thủy tinh-Kỹ thuật viên lò nung - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Lao động tự do (không làm việc trên cao >=4m/ hóa chất/ thuốc nổ) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "DV giải trí/Các lĩnh vực khác-Thợ lắp ráp ăng ten tại nhà và văn phòng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Ngư nghiệp/Biển-Nuôi tôm hùm, ốc hương, rùa, baba, nghêu - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quản lý đô thị-Công nhân trồng cây xanh, cắt tỉa cây xanh ở độ cao <4m - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quản lý đô thị-Công nhân xử lý và chế biến rác thải sinh hoạt - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quản lý đô thị-Nhân viên đổ rác thải - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Trực/điều hành trạm biến áp - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước- Thợ ống nước, thợ hàn (nối, gắn) ống nước, Thợ khoan giếng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quân đội-Quân nhân đặc biệt (không quân/nhảy dù/hoa tiêu) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Quản lý đô thị-Tài xế lái xe tưới cây - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất hóa chất-Công nhân sửa chữa bình ắc quy, phun sơn bằng máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất hóa chất-Tổ trưởng/ca trưởng/kỹ thuật viên xưởng tạo khí nhà máy đạm - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thiết bị phụ tùng điện-Lắp ráp thiết bị phòng cháy chữa cháy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thợ hàn cơ khí tại tiệm/xưởng/nhà máy (không làm tại công trình) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Trồng trọt-Công nhân chăm sóc cây xanh, cắt tỉa cây độ cao <4m - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Bảo vệ-Vệ sĩ, thám tử tư - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Bảo vệ-Ngân hàng, nông trường, quán bar/ karaoke, vũ trường - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Buôn bán-Buôn bán hàng chuyến liên tỉnh/ có đi qua cửa khẩu - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Bưu điện-Nhân viên khuân vác bưu kiện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất xe-Sửa chữa, lắp ráp, bảo trì ô tô và đầu máy xe lửa - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Đội chống buôn lậu biên giới. Cảnh sát cơ động - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ nguội, Thợ tiện, Thợ rèn - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Tuần tra giao thông, Cảnh sát 113 - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Gốm/Gạch/Sứ-Công nhân lò nung, phân loại, bưng, phơi gạch gốm - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Gốm/Gạch/Sứ-Công nhân khoan/nghiền khoáng chất, sàng lọc - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Gốm/Gạch/Sứ-Công nhân tạo sản phẩm/ tạo hình/ sản xuất/ tráng men - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Vận chuyển than trên đường ray - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Ngư nghiệp/Sông-Đánh cá trên sông/ hồ/ đầm/ phá - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Ngư nghiệp/Biển-Người trực tiếp nuôi trồng thủy sản ven biển - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thuốc lá-Công nhân lò sấy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nhựa/Cao su/Da-Công nhân làm khuôn, đổ khuôn, phối liệu/pha chế - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân đặt cáp ngầm điện lực - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân đường dây sửa chữa, lắp đặt điện nhà - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nước-Công nhân thi công xây dựng đường ống cấp nước - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Công nhân đường dây sửa chữa, lắp đặt điện thoại - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sông-Lái đò ngang, Lái phà, Nhân viên trên phà (trên sông) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt/cầu đường-Công nhân bảo dưỡng, làm đường đồng bằng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ điều khiển máy móc xây dựng. Thợ tạc tượng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt-Kĩ thuật viên/ Công nhân sửa chữa, lắp, bảo trì. Thợ máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sắt-Nhân viên khuân vác hàng/hành lý. Thợ cơ khí. Thợ điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế taxi/xe du lịch/xe ba bánh/ba gác máy/xe ôm/Grab/Go-Viet - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chăn nuôi-Nuôi cá sấu, rắn - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế/phụ xế xe vận tải hàng hóa <=4 tấn, xe công nông - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Kiếng/Thủy tinh-Công nhân thổi thủy tinh, uốn, cắt kiếng, mài cạnh - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng nội thất-Thợ sản xuất, sửa chữa nội thất đồ gỗ/ đồ kim loại - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng thủ công mỹ nghệ-Sản xuất dao, kéo, đồ kim loại (tiện, nề, sơn) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ lắp ráp kính/ cửa nhôm, cửa kính, cửa window - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế/nhân viên xe khách, xe buýt nội thành, xe chở rác - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xi măng/Vôi/Thạch cao-Thợ làm trần thạch cao - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ mộc, mộc cốp pha. Thợ đóng trần thạch cao - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xây dựng-Thợ xây bia mộ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Y tế-Nhân viên làm việc với máy phóng xạ, X-quang, CT Scan, MRI - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Sĩ quan/Đội trưởng/Nhân viên phòng cháy chữa cháy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Đội điều tra và hỏi cung bị can. Đội chống bạo động - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảnh sát/Công an-Hình sự/ điều tra/ chuyên trách phòng chống ma tuý - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Buôn bán-Thu mua dụng cụ gas/ khí hóa lỏng đã qua sử dụng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Bảo vệ-Công trường xây dựng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hồ Bơi-Nhân viên cứu nạn (bãi tắm biển) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Nhân viên đoàn nghệ thuật biểu diễn lưu động - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sở thú-Bác sĩ thú y trong sở thú - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Bowling-Nhân viên bảo trì máy móc - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân thử nghiệm - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện ảnh/Truyền hình-Tài xế đoàn làm phim - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "DV giải trí/Các lĩnh vực khác-Thợ ống nước/Thợ máy/Thợ điện/Lắp camera - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất giấy-Công nhân nghiền bột giấy/ sản xuất giấy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng nội thất-Làm đá hoa cương - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nhựa/Cao su/Da-Công nhân cán ép mủ cao su/ sản xuất nhựa/ thuộc da - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nhựa/Cao su/Da-Công nhân chế tạo, hoàn chỉnh sản phẩm cao su - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nệm/gối/gấu bông-Công nhân cắt bông, nhồi, ép hơi, cắt xén - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ hàn cơ khí tại tiệm/xưởng/nhà máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân lắp ráp, vận hành máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy cắt - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy giùi - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy khoan - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân điều khiển máy xay xát - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân xi mạ, Thợ chạm khắc/xi mạ/sơn - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện tử-Công nhân sản xuất, Nhân viên lắp đặt camera - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Nhựa/Cao su/Da-Công nhân vận hành máy, bảo trì máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Ăn uống/Chế biến thực phẩm-Giết mổ gia súc - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Lái xe nâng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ ống nước, Thợ điện - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thiết bị phụ tùng điện-Sản xuất/ sửa chữa máy điều hòa (tại xưởng) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thiết bị phụ tùng điện-Thợ điện; Công nhân xưởng đúc - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Thiết bị phụ tùng điện-Thợ hàn phụ tùng điện (không làm tại công trình) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Điện/viễn thông-Thợ điện dân dụng, điện lạnh làm việc độ cao < 4m - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất hóa chất-Công nhân sản xuất, đóng gói xà phòng/chất tẩy rửa - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất xe-Công nhân cơ khí, Công nhân/ca trưởng lắp ráp, sản xuất - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Sản xuất hóa chất-Công nhân sản xuất pin, phân bón, hóa chất. Thủ kho - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân sản xuất, tiếp xúc bụi/nhiệt/lò nung - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Chủ xe/nhân viên theo xe, không trực tiếp lái. Khuân vác - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế xe đoàn làm phim/ thực địa. Giáo viên dạy lái xe - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng không-Nhân viên vệ sinh máy bay (bên ngoài) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng không-Nhân viên khuân vác hành lý, hàng hóa - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng không-Kiểm tra viên tại sân bay. Lái xe bus phục vụ trong sân bay - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Hàng không-Bảo trì máy bay/ bảo dưỡng đường băng/nạp nhiên liệu/cơ khí - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Cảng-Hoa tiêu, NV lái canô kiểm tra khu vực cảng, Khuân vác tại cảng - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường sông-Lái đò, ghe, thuyền buôn bán trên sông - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chế biến gỗ-Bốc dỡ gỗ tại xưởng chế biến, kho gỗ - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Chế biến gỗ-Công nhân điều khiển cần cẩu tại xưởng/nhà máy - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế chuyên chở nguyên vật liệu (trong khu vực khai thác) - <span class='text-danger fw-bolder'>Nhóm 3</span>",
    "Đường bộ-Tài xế xe chở than từ nơi khai thác, xe trộn bê tông - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Khai thác gỗ-Điều khiển cần cẩu, điều khiển bộ nối tại nơi khai thác - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sông-Tàu chở khách cự ly xa (đò dọc) - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Khai thác gỗ-Quản đốc, giám sát viên, công nhân tại nơi bốc dỡ - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sông-Nhân viên/thủy thủ tàu du lịch, tàu chở vật liệu xây dựng - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Cảng-Điều khiển cần cẩu. Điều khiển ròng rọc nâng hàng - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Cảng-Công nhân xưởng đóng tàu và đốc công (làm việc ngoài khơi). - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Hàng không-Nhân viên vệ sinh tường cao hoặc trần - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường bộ-Tài xế xe chở cát/đá/vật liệu xây dựng. Nhân viên áp tải - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân đào đắp, khai thác nguyên liệu - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Thiết bị phụ tùng điện-Lắp đặt, sửa chữa điều hòa (trên tầng cao) - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thủ kho - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Hướng dẫn điều khiển cẩu cần trục - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân chưng cất - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Lái xe cẩu cần trục - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Thợ làm khuôn mẫu - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất hóa chất-Chiết nạp, sản xuất khí công nghiệp/khí nén - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất hóa chất-Công nhân chiết nạp, sản xuất gas/khí hóa lỏng - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên võ thuật/xiếc thú//múa lửa - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên xiếc trên cao, nhào lộn - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xây dựng-Thợ sơn tường/sơn nước, quét vôi - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xây dựng-Thợ xây, Thợ hồ, Phụ hồ. Thầu xây dựng có trực tiếp làm. - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Thủy điện - Thủy lợi-Công nhân xây dựng - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân điều hành và sản xuất bê tông - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xây dựng-Thợ hàn tại công trình, Thợ làm cửa sắt tại công trình - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường bộ-Tài xế/phụ xế xe tải công trình, xe container, cẩu/cần trục - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường bộ-Tài xế lái xe ủi/san lấp/ múc/đào, xe lu, xe kobe/xe ben - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường bộ-Tài xế/phụ xế xe tải hàng hóa >4 tấn, xe khách liên tỉnh - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sông-Vận tải đường sông (tàu thủy, sà lan) - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân sản xuất/luyện/cán/đúc - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Diễn viên xiếc - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân khai thác - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Trồng trọt-Hái dừa - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Rừng-Nhân viên kiểm lâm có làm việc/tuần tra tại lâm trường, rừng - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Quản lý đô thị-Công nhân cắt tỉa cây xanh ở độ cao >=4m - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Nhựa/Cao su/Da-Công nhận vận hành, bảo trì nồi hơi/ lò hơi - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Điện/viễn thông-Công nhân đường dây cao thế, làm việc ở độ cao >=4m - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Hàng nội thất-Ốp đá hoa cương - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Dệt May/Giày Dép/Túi xách/Nón-Công nhân vận hành, bảo trì nồi hơi/lò hơi - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "DV giải trí/Các lĩnh vực khác-Thợ lắp dựng ăng ten/bảo trì ở độ cao >=4m - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sắt/cầu đường-Điều khiển máy san đất, máy đào, máy múc, dập - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sắt/cầu đường-Công nhân làm đường núi/ tàu nạo vét. - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sắt/cầu đường-Công nhân sửa chữa, bảo trì, lắp đặt đường dây - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Thủy điện - Thủy lợi-Công nhân sử dụng máy móc công trình - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sắt/cầu đường-Điều khiển máy móc làm đường/ lái cẩu - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường sắt/cầu đường-Lái xe chở đất đá, trộn bê tông, xe lu, xe ben - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xây dựng-Thợ trang trí ngoại thất. Công nhân lắp đặt thang máy. - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Xây dựng-Công nhân ốp đá (đá mài, đá rửa, đá hoa cương), giàn giáo - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Quảng cáo-Nhân viên vẽ/lắp đặt/dựng bảng quảng cáo ngoài trời - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Điện/viễn thông-Thi công đường cáp (bảo trì, quấn cáp) ở độ cao >=4m - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Rừng-Quản lý/nhân viên khu bảo tồn thiên nhiên - <span class='text-danger fw-bolder'>Nhóm 4</span>",
    "Đường biển-Lái thuyền & nhân viên trên tàu cứu hộ, tàu du lịch, du thuyền - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường biển-Thợ lặn biển - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường biển-Thủy thủ, nhân viên trên tàu/ sà lan/ phà/ thuyền buồm - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường bộ-Tài xế/phụ xế áp tải xe chở khí hóa lỏng, xe bồn xăng dầu - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường bộ-Tài xế/phụ xế xe vận chuyển vật liệu cháy nổ - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường bộ-Tài xế, phụ xế lái xe toa kéo - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường sông-Nhân viên/thủy thủ tàu cứu hộ. Tàu/sà lan chở xăng dầu - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác gỗ-Lái xe và phụ xe chở gỗ - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường sông- Thợ lặn sông - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác gỗ-Công nhân, Thợ cưa xẻ gỗ tại nơi khai thác - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân điều hành và sản xuất chất phụ gia - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Xi măng/Vôi/Thạch cao-Công nhân nổ mìn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Hàng không-Phi công đang được huấn luyện trong công ty hàng không - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Hàng không-Phi công máy bay trực thăng - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sản xuất hóa chất-Công nhân sản xuất các loại axít - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sản xuất sắt/Thép/Tôn/Máy móc-Công nhân khuân vác sắt/ thép/ tôn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sản xuất Thuốc súng/Chất nổ-Nơi làm việc/ công việc có liên quan - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác quặng/than đá/dầu khí ở dưới lòng đất-Công nhân hầm mỏ - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sản xuất hóa chất-Công nhân làm việc với hóa chất độc hại - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "DV giải trí/Nghệ thuật-Sân khấu-Múa lân/ sư tử/ rồng - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sở thú-Nhân viên chăm sóc thú, Nhân viên huấn luyện thú - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Điện ảnh/Truyền hình-Diễn viên đóng thế vai nguy hiểm (Cascader) - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Giải trí đặc biệt-Gái bán bar, mời rượu, gái nhảy - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Chăm sóc sắc đẹp-Làm nghề massage tại nhà - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Nước-Thợ đào giếng - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Sản xuất xe-Nhân viên chạy thử xe ôtô, môtô (thử tốc độ - va đập) - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Điện/viễn thông-Công nhân đường hầm, vận hành lò hơi, nồi hơi - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Ngành nghề khác-Thợ lặn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác quặng/than đá/dầu khí mặt đất-Công nhân nổ mìn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác quặng/than đá-tất cả nhân viên làm việc ngoài khơi - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Khai thác quặng/than đá/dầu khí ngoài khơi-Thợ lặn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Ngành nghề khác-Công nhân lau chùi bên ngoài cao ốc - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Ngành nghề khác-Nhân viên lau chùi ống khói - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Điện/viễn thông-Nhân viên phụ trách máy biến thế - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Thể thao-Vận động viên/Cầu thủ bóng bầu dục, khúc côn cầu - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Thể thao-Huấn huyện viên/Vận động viên/Thợ lặn biển, leo núi - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Quảng cáo/Báo chí/Truyền hình-Phóng viên chiến trường - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Xây dựng-Công nhân lau kiếng nhà cao tầng - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường sắt/cầu đường-Công nhân kỹ thuật công trình dưới lòng đất - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường sắt/cầu đường-Công nhân xây dựng cầu; Công nhân nổ mìn - <span class='text-danger fw-bolder'>Nhóm Từ chối</span>",
    "Đường biển-Dân cư trên đảo ven biển - <span class='text-danger fw-bolder'>Nhóm 1 & Loại trừ</span>",
    "Ngư nghiệp/Biển-Đánh bắt cá biển/ Ngư dân, Đánh bắt hải sản gần bờ - <span class='text-danger fw-bolder'>Nhóm 4 Tăng phí & Loại trừ</span>",
    "Đường biển-Ngư dân đi biển, Tàu công. Người làm việc trên giàn khoan - <span class='text-danger fw-bolder'>Nhóm 4 Tăng phí & Loại trừ</span>",
    "Đường biển-Công việc có đi lại trên biển - <span class='text-danger fw-bolder'>Nhóm 4 Tăng phí & Loại trừ</span>",
  ];

  function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  customInput.addEventListener("click", () => {
    customInputContainer.classList.toggle("show");
  });

  let danhSachNhomNgheLength = danhSachNhomNghe.length;

  for (let i = 0; i < danhSachNhomNgheLength; i++) {
    let country = danhSachNhomNghe[i];
    const li = document.createElement("li");
    // const countryName = document.createTextNode(country);
    // li.appendChild(countryName);
    li.innerHTML = country;
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
    // console.log(selectedCountry);
  }

  searchInput.addEventListener("keyup", (e) => {
    let searchedVal = searchInput.value.toLowerCase();
    let searched_country = [];

    searched_country = danhSachNhomNghe
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
      } else {
        document.getElementById('chooseMajorBtn').style.display = 'block';
      }
      priorityGlobal = priority
    })
  }

  let priorityDeleteGlobal = 0;
  const exampleModal1 = document.getElementById('exampleModal1')
  if (exampleModal1) {
    exampleModal1.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const priority = button.getAttribute('data-bs-whatever')
      priorityDeleteGlobal = priority
    })
  }

  function setNhomNghe() {
    // const selectedMajor = document.getElementById(inputId).value;
    const selectedMajor = selectedData.innerText;
    const normalizedMainText = removeDiacritics(selectedMajor).toLowerCase();
    // console.log(normalizedMainText);
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