<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once '../vendor/autoload.php';
require_once '../helper/general.php';



// Đọc dữ liệu JSON từ yêu cầu POST
$request = json_decode(file_get_contents('php://input'), true);

// Nếu không nhận được dữ liệu, hiển thị thông báo lỗi
if (!$request) {
    echo json_encode(['success' => false, 'message' => 'Không có dữ liệu yêu cầu.']);
    exit;
}

$dataFormChinh = $request['dataFormChinh'];
$dataFormBoSung1 = $request['dataForm2'];
$dataFormBoSung2 = $request['dataForm3'];
$dataFormBoSung3 = $request['dataForm4'];
$total = $request['total'];
$writer = $request['writer'];
$nhanVienTuVan = $request['nhanVienTuVan'] ?? '';
$sdt = $request['sdt'] ?? '';
$vanPhong = $request['vanPhong'] ?? '';

$isBHTNCaoCap = false;
$isBHHoTroVienPhi = false;
$isBHHoTroDieuTriUngThu = false;
$isBHSucKhoeToanCau24_7 = false;
// logEntry("Request data: " . json_encode($request));
$BHMoney = '';
if ($dataFormChinh['soTienBaoHiem_1'] !== '') {
    $BHMoney = $dataFormChinh['soTienBaoHiem_1'];
    // convert '1.000.000' to 1000000
    $BHMoney = (float)str_replace('.', '', $BHMoney);
    // /2
    $BHMoney = $BHMoney / 2;
    // convert 1000000 to '1.000.000'
    $BHMoney = number_format($BHMoney, 0, ',', '.');
}

$tableChinhHtml = "";
if (isset($dataFormChinh['noiTru_1']) && $dataFormChinh['noiTru_1'] == 'on') {
    $isBHSucKhoeToanCau24_7 = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['noiTruLuaChon_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['noiTruPhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['noiTru20_1']) && $dataFormChinh['noiTru20_1'] == 'on') {
    $isBHSucKhoeToanCau24_7 = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['noiTru20LuaChon_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['noiTru20PhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['ngoaiTru_1']) && $dataFormChinh['ngoaiTru_1'] == 'on') {
    $isBHSucKhoeToanCau24_7 = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['ngoaiTruLuaChon_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['ngoaiTruPhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['BHNCaoCap_1']) && $dataFormChinh['BHNCaoCap_1'] == 'on') {
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Tai Nạn Cao Cấp</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['BHNCaoCapSotienBH_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['BHNCaoCapPhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['hoTroVienPhi_1']) && $dataFormChinh['hoTroVienPhi_1'] == 'on') {
    $isBHHoTroVienPhi = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Viện Phí</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['hoTroVienPhiLuaChon_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['hoTroVienPhiPhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['taiNanCC_1']) && $dataFormChinh['taiNanCC_1'] == 'on') {
    $isBHTNCaoCap = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['taiNanCCSotienBH_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['taiNanCCPhiCoBan_1']) . "</td>
        </tr>
    ";
}
if (isset($dataFormChinh['BHUngThu_1']) && $dataFormChinh['BHUngThu_1'] == 'on') {
    $isBHHoTroDieuTriUngThu = true;
    $tableChinhHtml .= "
        <tr>
            <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['BHUngThuSotienBH_1']) . "</td>
            <td class='border-bottom' colspan='2'>" . getFieldValue($dataFormChinh['BHUngThuPhiCoBan_1']) . "</td>
        </tr>
    ";
}

$tableBoSungHtml_1 = "";
if ($dataFormBoSung1['hoVaTen_2'] !== "" && $dataFormBoSung1['gioiTinh_2'] !== "" && $dataFormBoSung1['nhomNghe_2'] !== "") {
    $tableBoSungHtml_1 .= "
        <div>
            <h3 class='highlight_blue'>II. NGƯỜI ĐƯỢC BẢO HIỂM BỔ SUNG 1</h3>
            <table class='avoid-page-break'>
                <tr>
                    <th>Họ và tên</th>
                    <th class='highlight_blue'>Giới tính</th>
                    <th>Tuổi</th>
                    <th class='highlight_blue'>Nhóm nghề</th>
                </tr>
                <tr>
                    <td>{$dataFormBoSung1['hoVaTen_2']}</td>
                    <td>{$dataFormBoSung1['gioiTinh_2']}</td>
                    <td>" . extractAge($dataFormBoSung1['tuoi_2']) . "</td>
                    <td>{$dataFormBoSung1['nhomNghe_2']}</td>
                </tr>
            </table>
            <br/>
            <table class='avoid-page-break'>
                <tr class='section-title'>
                    <td class='title-table border-bottom highlight_blue' style='width: 40%;'>Quyền lợi bổ sung</td>
                    <td class='title-table border-bottom highlight_blue'>Lựa chọn</td>
                    <td class='title-table border-bottom highlight_blue'>Phí bảo hiểm cơ bản (đồng/năm)</td>
                </tr>

    ";

    if (isset($dataFormBoSung1['noiTru_2']) && $dataFormBoSung1['noiTru_2'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['noiTru_2']) && $dataFormBoSung1['noiTru_2'] == 'on' ? getFieldValue($dataFormBoSung1['noiTruLuaChon_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['noiTru_2']) && $dataFormBoSung1['noiTru_2'] == 'on' ? getFieldValue($dataFormBoSung1['noiTruPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['noiTru20_2']) && $dataFormBoSung1['noiTru20_2'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['noiTru20_2']) && $dataFormBoSung1['noiTru20_2'] == 'on' ? getFieldValue($dataFormBoSung1['noiTru20LuaChon_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['noiTru20_2']) && $dataFormBoSung1['noiTru20_2'] == 'on' ? getFieldValue($dataFormBoSung1['noiTru20PhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['ngoaiTru_2']) && $dataFormBoSung1['ngoaiTru_2'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['ngoaiTru_2']) && $dataFormBoSung1['ngoaiTru_2'] == 'on' ? getFieldValue($dataFormBoSung1['ngoaiTruLuaChon_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['ngoaiTru_2']) && $dataFormBoSung1['ngoaiTru_2'] == 'on' ? getFieldValue($dataFormBoSung1['ngoaiTruPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['taiNanCC_2']) && $dataFormBoSung1['taiNanCC_2'] == 'on') {
        $isBHTNCaoCap = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Tai Nạn Cao Cấp</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['taiNanCC_2']) && $dataFormBoSung1['taiNanCC_2'] == 'on' ? getFieldValue($dataFormBoSung1['taiNanCCSotienBH_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['taiNanCC_2']) && $dataFormBoSung1['taiNanCC_2'] == 'on' ? getFieldValue($dataFormBoSung1['taiNanCCPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['hoTroVienPhi_2']) && $dataFormBoSung1['hoTroVienPhi_2'] == 'on') {
        $isBHHoTroVienPhi = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Viện Phí</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['hoTroVienPhi_2']) && $dataFormBoSung1['hoTroVienPhi_2'] == 'on' ? getFieldValue($dataFormBoSung1['hoTroVienPhiLuaChon_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['hoTroVienPhi_2']) && $dataFormBoSung1['hoTroVienPhi_2'] == 'on' ? getFieldValue($dataFormBoSung1['hoTroVienPhiPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['BHNCaoCap_2']) && $dataFormBoSung1['BHNCaoCap_2'] == 'on') {
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['BHNCaoCap_2']) && $dataFormBoSung1['BHNCaoCap_2'] == 'on' ? getFieldValue($dataFormBoSung1['BHNCaoCapSotienBH_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['BHNCaoCap_2']) && $dataFormBoSung1['BHNCaoCap_2'] == 'on' ? getFieldValue($dataFormBoSung1['BHNCaoCapPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung1['BHUngThu_2']) && $dataFormBoSung1['BHUngThu_2'] == 'on') {
        $isBHHoTroDieuTriUngThu = true;
        $tableBoSungHtml_1 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['BHUngThu_2']) && $dataFormBoSung1['BHUngThu_2'] == 'on' ? getFieldValue($dataFormBoSung1['BHUngThuSotienBH_2']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung1['BHUngThu_2']) && $dataFormBoSung1['BHUngThu_2'] == 'on' ? getFieldValue($dataFormBoSung1['BHUngThuPhiCoBan_2']) : '') . "</td>
            </tr>
        ";
    }

    $tableBoSungHtml_1 .= "
            </table>     
        </div>
    ";
}

$tableBoSungHtml_2 = "";
if ($dataFormBoSung2['hoVaTen_3'] !== "" && $dataFormBoSung2['gioiTinh_3'] !== "" && $dataFormBoSung2['nhomNghe_3'] !== "") {
    $tableBoSungHtml_2 .= "
        <div>
            <h3 class='highlight_blue'>III. NGƯỜI ĐƯỢC BẢO HIỂM BỔ SUNG 2</h3>
            <table class='avoid-page-break'>
                <tr>
                    <th>Họ và tên</th>
                    <th class='highlight_blue'>Giới tính</th>
                    <th>Tuổi</th>
                    <th class='highlight_blue'>Nhóm nghề</th>
                </tr>
                <tr>
                    <td>{$dataFormBoSung2['hoVaTen_3']}</td>
                    <td>{$dataFormBoSung2['gioiTinh_3']}</td>
                    <td>" . extractAge($dataFormBoSung2['tuoi_3']) . "</td>
                    <td>{$dataFormBoSung2['nhomNghe_3']}</td>
                </tr>
            </table>
            <br/>
            <table class='avoid-page-break'>
                <tr class='section-title'>
                    <td class='title-table border-bottom highlight_blue' style='width: 40%;'>Quyền lợi bổ sung</td>
                    <td class='title-table border-bottom highlight_blue'>Lựa chọn</td>
                    <td class='title-table border-bottom highlight_blue'>Phí bảo hiểm cơ bản (đồng/năm)</td>
                </tr>

    ";

    if (isset($dataFormBoSung2['noiTru_3']) && $dataFormBoSung2['noiTru_3'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['noiTru_3']) && $dataFormBoSung2['noiTru_3'] == 'on' ? getFieldValue($dataFormBoSung2['noiTruLuaChon_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['noiTru_3']) && $dataFormBoSung2['noiTru_3'] == 'on' ? getFieldValue($dataFormBoSung2['noiTruPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['noiTru20_3']) && $dataFormBoSung2['noiTru20_3'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['noiTru20_3']) && $dataFormBoSung2['noiTru20_3'] == 'on' ? getFieldValue($dataFormBoSung2['noiTru20LuaChon_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['noiTru20_3']) && $dataFormBoSung2['noiTru20_3'] == 'on' ? getFieldValue($dataFormBoSung2['noiTru20PhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['ngoaiTru_3']) && $dataFormBoSung2['ngoaiTru_3'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['ngoaiTru_3']) && $dataFormBoSung2['ngoaiTru_3'] == 'on' ? getFieldValue($dataFormBoSung2['ngoaiTruLuaChon_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['ngoaiTru_3']) && $dataFormBoSung2['ngoaiTru_3'] == 'on' ? getFieldValue($dataFormBoSung2['ngoaiTruPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['taiNanCC_3']) && $dataFormBoSung2['taiNanCC_3'] == 'on') {
        $isBHTNCaoCap = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Tai Nạn Cao Cấp</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['taiNanCC_3']) && $dataFormBoSung2['taiNanCC_3'] == 'on' ? getFieldValue($dataFormBoSung2['taiNanCCSotienBH_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['taiNanCC_3']) && $dataFormBoSung2['taiNanCC_3'] == 'on' ? getFieldValue($dataFormBoSung2['taiNanCCPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['hoTroVienPhi_3']) && $dataFormBoSung2['hoTroVienPhi_3'] == 'on') {
        $isBHHoTroVienPhi = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Viện Phí</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['hoTroVienPhi_3']) && $dataFormBoSung2['hoTroVienPhi_3'] == 'on' ? getFieldValue($dataFormBoSung2['hoTroVienPhiLuaChon_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['hoTroVienPhi_3']) && $dataFormBoSung2['hoTroVienPhi_3'] == 'on' ? getFieldValue($dataFormBoSung2['hoTroVienPhiPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['BHNCaoCap_3']) && $dataFormBoSung2['BHNCaoCap_3'] == 'on') {
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['BHNCaoCap_3']) && $dataFormBoSung2['BHNCaoCap_3'] == 'on' ? getFieldValue($dataFormBoSung2['BHNCaoCapSotienBH_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['BHNCaoCap_3']) && $dataFormBoSung2['BHNCaoCap_3'] == 'on' ? getFieldValue($dataFormBoSung2['BHNCaoCapPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung2['BHUngThu_3']) && $dataFormBoSung2['BHUngThu_3'] == 'on') {
        $isBHHoTroDieuTriUngThu = true;
        $tableBoSungHtml_2 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['BHUngThu_3']) && $dataFormBoSung2['BHUngThu_3'] == 'on' ? getFieldValue($dataFormBoSung2['BHUngThuSotienBH_3']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung2['BHUngThu_3']) && $dataFormBoSung2['BHUngThu_3'] == 'on' ? getFieldValue($dataFormBoSung2['BHUngThuPhiCoBan_3']) : '') . "</td>
            </tr>
        ";
    }

    $tableBoSungHtml_2 .= "
            </table>     
        </div>
    ";
}

$tableBoSungHtml_3 = "";
if ($dataFormBoSung3['hoVaTen_4'] !== "" && $dataFormBoSung3['gioiTinh_4'] !== "" && $dataFormBoSung3['nhomNghe_4'] !== "") {
    $tableBoSungHtml_3 .= "
        <div>
            <h3 class='highlight_blue'>IV. NGƯỜI ĐƯỢC BẢO HIỂM BỔ SUNG 3</h3>
            <table class='avoid-page-break'>
                <tr>
                    <th>Họ và tên</th>
                    <th class='highlight_blue'>Giới tính</th>
                    <th>Tuổi</th>
                    <th class='highlight_blue'>Nhóm nghề</th>
                </tr>
                <tr>
                    <td>{$dataFormBoSung3['hoVaTen_4']}</td>
                    <td>{$dataFormBoSung3['gioiTinh_4']}</td>
                    <td>" . extractAge($dataFormBoSung3['tuoi_4']) . "</td>
                    <td>{$dataFormBoSung3['nhomNghe_4']}</td>
                </tr>
            </table>
            <br/>
            <table class='avoid-page-break'>
                <tr class='section-title'>
                    <td class='title-table border-bottom highlight_blue' style='width: 40%;'>Quyền lợi bổ sung</td>
                    <td class='title-table border-bottom highlight_blue'>Lựa chọn</td>
                    <td class='title-table border-bottom highlight_blue'>Phí bảo hiểm cơ bản (đồng/năm)</td>
                </tr>

    ";

    if (isset($dataFormBoSung3['noiTru_4']) && $dataFormBoSung3['noiTru_4'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['noiTru_4']) && $dataFormBoSung3['noiTru_4'] == 'on' ? getFieldValue($dataFormBoSung3['noiTruLuaChon_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['noiTru_4']) && $dataFormBoSung3['noiTru_4'] == 'on' ? getFieldValue($dataFormBoSung3['noiTruPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['noiTru20_4']) && $dataFormBoSung3['noiTru20_4'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi nội trú đồng chi trả 20% (dưới 6 tuổi mặc định đồng chi trả 30%)</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['noiTru20_4']) && $dataFormBoSung3['noiTru20_4'] == 'on' ? getFieldValue($dataFormBoSung3['noiTru20LuaChon_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['noiTru20_4']) && $dataFormBoSung3['noiTru20_4'] == 'on' ? getFieldValue($dataFormBoSung3['noiTru20PhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['ngoaiTru_4']) && $dataFormBoSung3['ngoaiTru_4'] == 'on') {
        $isBHSucKhoeToanCau24_7 = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7 Quyền lợi ngoại trú</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['ngoaiTru_4']) && $dataFormBoSung3['ngoaiTru_4'] == 'on' ? getFieldValue($dataFormBoSung3['ngoaiTruLuaChon_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['ngoaiTru_4']) && $dataFormBoSung3['ngoaiTru_4'] == 'on' ? getFieldValue($dataFormBoSung3['ngoaiTruPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['taiNanCC_4']) && $dataFormBoSung3['taiNanCC_4'] == 'on') {
        $isBHTNCaoCap = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Tai Nạn Cao Cấp</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['taiNanCC_4']) && $dataFormBoSung3['taiNanCC_4'] == 'on' ? getFieldValue($dataFormBoSung3['taiNanCCSotienBH_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['taiNanCC_4']) && $dataFormBoSung3['taiNanCC_4'] == 'on' ? getFieldValue($dataFormBoSung3['taiNanCCPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['hoTroVienPhi_4']) && $dataFormBoSung3['hoTroVienPhi_4'] == 'on') {
        $isBHHoTroVienPhi = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Viện Phí</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['hoTroVienPhi_4']) && $dataFormBoSung3['hoTroVienPhi_4'] == 'on' ? getFieldValue($dataFormBoSung3['hoTroVienPhiLuaChon_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['hoTroVienPhi_4']) && $dataFormBoSung3['hoTroVienPhi_4'] == 'on' ? getFieldValue($dataFormBoSung3['hoTroVienPhiPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['BHNCaoCap_4']) && $dataFormBoSung3['BHNCaoCap_4'] == 'on') {
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Bệnh Hiểm Nghèo Cao Cấp Toàn Diện</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['BHNCaoCap_4']) && $dataFormBoSung3['BHNCaoCap_4'] == 'on' ? getFieldValue($dataFormBoSung3['BHNCaoCapSotienBH_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['BHNCaoCap_4']) && $dataFormBoSung3['BHNCaoCap_4'] == 'on' ? getFieldValue($dataFormBoSung3['BHNCaoCapPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }
    if (isset($dataFormBoSung3['BHUngThu_4']) && $dataFormBoSung3['BHUngThu_4'] == 'on') {
        $isBHHoTroDieuTriUngThu = true;
        $tableBoSungHtml_3 .= "
            <tr>
                <td class='border-bottom'>Bảo Hiểm Hỗ Trợ Điều Trị Ung Thư</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['BHUngThu_4']) && $dataFormBoSung3['BHUngThu_4'] == 'on' ? getFieldValue($dataFormBoSung3['BHUngThuSotienBH_4']) : '') . "</td>
                <td class='border-bottom'>" . (isset($dataFormBoSung3['BHUngThu_4']) && $dataFormBoSung3['BHUngThu_4'] == 'on' ? getFieldValue($dataFormBoSung3['BHUngThuPhiCoBan_4']) : '') . "</td>
            </tr>
        ";
    }

    $tableBoSungHtml_3 .= "
            </table>     
        </div>
    ";
}


// Tạo nội dung HTML cho template
$htmlContent = "
<!DOCTYPE html>
<html lang='vi'>
<head>
    <meta charset='UTF-8'>
    <title>Daichi</title>
    <script src='https://unpkg.com/@phosphor-icons/web'></script>
    <style>
        body {
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
        }
        .border {
          border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
        }
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
        .section-title {
            font-weight: bold;
            background-color: #ddd;
            
        }
        .title-table {
            font-weight: bold;
        }
        .border-bottom {
            border-bottom: 1px solid #000;
        }
        .page-break {
          page-break-after: always;
        }
        ul {
            margin-left: 20px;
            list-style-type: disc;
        }
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
        .note {
            font-style: italic;
        }
        .table-BHTC {
            border: 0.5px groove #000;
            border-collapse: collapse;
        }
        .table-BHTC th, .table-BHTC td {
            border: 0.5px groove #000;
        }
        .avoid-page-break {
            page-break-inside: avoid; /* Ngăn chia bảng */
        }
        .highlight_blue {
            background-color: #B0E2FF;
        }
        .highlight_coban {
            background-color: #00C5CD;
        }
        .highlight_phothong {
            background-color: #B0E2FF;
        }
        .highlight_dacbiet {
            background-color: #7FFFD4;
        }
        .highlight_caocap {
            background-color: #FFA500;
        }
        .highlight_thinhvuong {
            background-color: #FFD700;
        }
        .highlight_khongapdung {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div>
        <h2 style='text-align: center;'>BẢNG TÓM TẮT QUYỀN LỢI BẢO HIỂM DAI-ICHI</h2>
        <h4 style='text-align: center;'>TÊN SẢN PHẨM: AN TÂM SONG HÀNH</h4>

        <h3 class='highlight_blue'>I. NGƯỜI ĐƯỢC BẢO HIỂM CHÍNH</h3>
        <table>
            <tr>
                <th>Họ và tên</th>
                <th class='highlight_blue'>Giới tính</th>
                <th>Tuổi</th>
                <th class='highlight_blue'>Nhóm nghề</th>
            </tr>
            <tr>
                <td>{$dataFormChinh['hoVaTen_1']}</td>
                <td>{$dataFormChinh['gioiTinh_1']}</td>
                <td>" . extractAge($dataFormChinh['tuoi_1']) . "</td>
                <td>{$dataFormChinh['nhomNghe_1']}</td>
            </tr>
        </table>
        <br/>
        <table>
            <tr style='border-bottom: 2px solid #000;'>
                <th>Sản phẩm</th>
                <th class='highlight_blue'>Thời hạn (năm)</th>
                <th>Thời gian đóng phí dự kiến (năm)</th>
                <th class='highlight_blue'>Số tiền bảo hiểm (đồng)</th>
                <th>Phí bảo hiểm cơ bản (đồng/năm)</th>
            </tr>
            <tr class='section-title'>
                <td colspan='5' style='text-align: start;'>Sản phẩm chính</td>
            </tr>
            <tr>
                <td>" . getFullNameBH($dataFormChinh['goiBaoHiem']) . "</td>
                <td>{$dataFormChinh['thoiHan']}</td>
                <td>{$dataFormChinh['thoiHanDongDuKien']}</td>
                <td>{$dataFormChinh['soTienBaoHiem_1']}</td>
                <td>{$dataFormChinh['phiCoban_1']}</td>
            </tr>
            <tr class='section-title'>
                <td colspan='5' style='text-align: start;'>Sản phẩm bổ sung/hỗ trợ</td>
            </tr>
            <tr>
                <td class='title-table border-bottom'>Quyền lợi bổ sung</td>
                <td class='title-table border-bottom' colspan='2'>Lựa chọn</td>
                <td class='title-table border-bottom' colspan='2'>Phí bảo hiểm cơ bản (đồng/năm)</td>
            </tr>

            {$tableChinhHtml}
        </table>     
    </div>
    <br/>
    <br/>

    {$tableBoSungHtml_1}
    <br/>
    <br/>
    {$tableBoSungHtml_2}
    <br/>
    <br/>

    {$tableBoSungHtml_3}
    <br/>
    <br/>

    <div>
        <h3>TỔNG PHÍ BẢO HIỂM (ĐỒNG)</h3>
        <table>
            <tr class='section-title'>
                <td class='title-table border-bottom highlight_blue'>QUÝ</td>
                <td class='title-table border-bottom highlight_blue'>NỮA NĂM</td>
                <td class='title-table border-bottom highlight_blue'>NĂM</td>
            </tr>

            <tr>
                <td class='border-bottom'>" . extractAfterColon($total['totalQuy']) . "</td>
                <td class='border-bottom'>" . extractAfterColon($total['totalNuaNam']) . "</td>
                <td class='border-bottom'>" . extractAfterColon($total['total1Nam']) . "</td>
            </tr>
        </table>
    </div>

    <div class='page-break'></div> <!-- Page break here -->

    <div>
        <p class='note'>* Lưu ý: Thời hạn đóng phí dự tính có thể khác với thời hạn hợp đồng, thời hạn đóng phí tối thiểu thông thường là 10 năm, nếu đóng chưa đủ 10 năm hủy hợp đồng thì sẽ rút được rất ít so với số tiền đã đóng cho cty bảo hiểm.</p>

        <h3>QUYỀN LỢI BẢO HIỂM CHÍNH</h3>
        <ul>
            <li><span>Quyền lợi tử vong do tai nạn:</span> Nhận thêm tới đa 50% STBH của sản phẩm chính, tức = <span>{$dataFormChinh['soTienBaoHiem_1']}/2 = {$BHMoney}</span></li>
            <li><span>Quyền lợi tử vong không do tai nạn:</span> Nhận giá trị lớn của = <span>{$dataFormChinh['soTienBaoHiem_1']}</span></li>
            <li><span>Quyền lợi thương tật toàn bộ vĩnh viễn:</span> Nhận giá trị lớn của = <span>{$dataFormChinh['soTienBaoHiem_1']}</span></li>
            <li>Quyền lợi cho toàn hậu sự: Nhận trước 10% QLBH từ vong tối đa 30 triệu</li>
            <li>Quyền lợi gia tăng số tiền bảo hiểm: Vào dịp đặc biệt được tăng 50% số tiền bảo hiểm tối đa 500 triệu</li>
            <li>Quyền lợi thưởng duy trì hợp đồng</li>
            <li>Quyền lợi thường gắn bó dài lâu</li>
            <li>Quyền lợi đáo hạn</li>
        </ul>".
        (
            $isBHTNCaoCap ? 
            "<h3>QUYỀN LỢI BẢO HIỂM TAI NẠN CAO CẤP</h3>
            <ul>
                <li>Quyền lợi tử vong do tai nạn lên đến 200% số tiền bảo hiểm</li>
                <li>Quyền lợi do tai nạn: nhận tỷ lệ % STBH dựa trên sự kiện và tỷ lệ thanh</li>
            </ul>" : ""
        )
        ."".
        (
            $isBHHoTroVienPhi ? 
            "<h3>QUYỀN LỢI BẢO HIỂM HỖ TRỢ VIỆN PHÍ</h3>
            <ul>
                <li>Quyền lợi bảo hiểm hỗ trợ viện phí</li>
                <li>Quyền lợi hỗ trợ chi phí điều trị tại khoa/phòng hồi sức đặc biệt</li>
                <li>Quyền lợi hỗ trợ chi phí phẫu thuật</li>
                <li>Quyền lợi hỗ trợ điều trị tại khoa/phòng cấp cứu do tai nạn</li>
                <li>Hỗ trợ điều trị ngoại trú</li>
            </ul>" : ""
        )
        ."".
        (
            $isBHHoTroDieuTriUngThu ? 
            "<h3>QUYỀN LỢI BẢO HIỂM HỖ TRỢ ĐIỀU TRỊ UNG THƯ</h3>
            <ul>
                <li>Nhận tối đa 150% số tiền bảo hiểm</li>
                <li>Quyền lợi trợ cấp nằm viện 0,2% STBH cho mỗi ngày nằm viện điều trị ung thư, không vượt quá 2 triệu đồng mỗi ngày nằm</li> 
                <li>Quyền lợi hỗ trợ chi phí điều trị ung</li> 
                <li>Quyền lợi hỗ trợ hồi phục sức khoẻ</li>
            </ul>" : ""
        )
        ."".
        (
            $isBHSucKhoeToanCau24_7 ? "<h3>QUYỀN LỢI BẢO HIỂM CHĂM SÓC SỨC KHỎE TOÀN CẦU 24/7</h3>":""
        )."
    </div>
    ".
    (
        $isBHSucKhoeToanCau24_7 ? "
            <div class='page-break'></div> <!-- Page break here -->
            <div>
                <h2>Bảng Quyền Lợi Bảo Hiểm Của Sản Phẩm Bảo Hiểm Chăm Sóc Sức Khỏe Toàn Cầu 24/7</h2>
                <p>Chi trả chi phí y tế của NĐBH. Chi tiết quyền lợi bảo hiểm tương ứng theo Chương trình bảo hiểm.</p>
                <table class='table-BHTC'>
                    <tr>
                        <th colspan='2'>CHƯƠNG TRÌNH BẢO HIỂM</th>
                        <th class='highlight_coban'>CƠ BẢN</th>
                        <th class='highlight_phothong'>PHỔ THÔNG</th>
                        <th class='highlight_dacbiet'>ĐẶC BIỆT</th>
                        <th class='highlight_caocap'>CAO CẤP</th>
                        <th class='highlight_thinhvuong'>THỊNH VƯỢNG</th>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='2'>
                            <span style='font-weight: bold;'>Quyền lợi tối đa một Bệnh/Thương tật</span> <br/>
                            (áp dụng cho Quyền lợi Điều trị nội trú và Quyền lợi Điều trị ngoại trú)
                        </td>
                        <td>150.000.000</td>
                        <td>300.000.000</td>
                        <td>600.000.000</td>
                        <td>1.000.000.000</td>
                        <td>2.000.000.000</td>
                    </tr>
                    <tr>
                        <td colspan='5'>trong suốt thời gian tham gia sản phẩm này</td>
                    </tr>
                </table>
                <table class='table-BHTC' style='margin-top: 5px;'>
                    <tr>
                        <td colspan='2' rowspan='2' class='section-title' style='text-align: start;'>A. QUYỀN LỢI ĐIỀU TRỊ NỘI TRÚ</td>
                        <td colspan='5' class='section-title'>MỨC GIỚI HẠN PHỤ</td>
                    </tr>   
                    <tr>
                        <th class='highlight_coban'>CƠ BẢN</th>
                        <th class='highlight_phothong'>PHỔ THÔNG</th>
                        <th class='highlight_dacbiet'>ĐẶC BIỆT</th>
                        <th class='highlight_caocap'>CAO CẤP</th>
                        <th class='highlight_thinhvuong'>THỊNH VƯỢNG</th>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Phạm vi địa lý</td>
                        <td colspan='5'>Toàn cầu</td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Đồng chi trả</td>
                        <td colspan='5'><span style='font-weight:  bold;'>30% hoặc 20% hoặc 0%</span> được ghi trên giấy Chứng nhận bảo hiểm.</td>
                    </tr>
                    <tr class='section-title'>
                        <td>1</td>
                        <td style='text-align: start;'>Điều trị nội trú</td>
                        <td colspan='5'></td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>1.1</td>
                        <td style='font-weight:  bold; text-align: start;'>Chi phí Phẫu thuật nội trú</td>
                        <td colspan='5'></td>
                    </tr>
                    <tr>
                        <td>a</td>
                        <td style='text-align: start;'>Mỗi cuộc Phẫu thuật cho mỗi Bệnh/Thương tật</td>
                        <td>12.500.000</td>
                        <td>25.000.000</td>
                        <td>50.000.000</td>
                        <td>75.000.000</td>
                        <td>125.000.000</td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td style='text-align: start;'>Mỗi Năm hợp đồng cho mỗi Bệnh/Thương tật</td>
                        <td>25.000.000</td>
                        <td>50.000.000</td>
                        <td>100.000.000</td>
                        <td>150.000.000</td>
                        <td>250.000.000</td>
                    </tr>  
                    
                    <tr>
                        <td style='font-weight:  bold;' rowspan='2'>1.2</td>
                        <td rowspan='2' style='text-align: start;'><span style='font-weight:  bold;'>Tiền phòng</span>/Ngày nằm viện</td>
                        <td>750.000</td>
                        <td>1.500.000</td>
                        <td>2.500.000</td>
                        <td>3.000.000</td>
                        <td>6.000.000</td>
                    </tr>
                    <tr>
                        <td colspan='5'>Tối đa 100 Ngày nằm viện/Năm hợp đồng cho mỗi Bệnh/Thương tật.</td>
                    </tr>

                    <tr>
                        <td style='font-weight:  bold;' rowspan='2'>1.3</td>
                        <td rowspan='2' style='text-align: start;'><span style='font-weight:  bold;'>Tiền phòng Chăm sóc đặc biệt (ICU)</span>/Ngày nằm viện</td>
                        <td>1.050.000</td>
                        <td>2.100.000</td>
                        <td>3.150.000</td>
                        <td>5.250.000</td>
                        <td>Chi phí y tế thực tế</td>
                    </tr>
                    <tr>
                        <td colspan='5'>Tối đa 100 Ngày nằm viện/Năm hợp đồng cho mỗi Bệnh/Thương tật.</td>
                    </tr>

                    <tr>
                        <td style='font-weight:  bold;' rowspan='2'>1.4</td>
                        <td rowspan='2' style='text-align: start;'><span style='font-weight:  bold;'>Tiền giường cho người thân</span>/Ngày nằm viện (khi chăm sóc Người được bảo hiểm dưới 18 tuổi)</td>
                        <td>250.000</td>
                        <td>500.000</td>
                        <td>750.000</td>
                        <td>1.000.000</td>
                        <td>1.250.000</td>
                    </tr>
                    <tr>
                        <td colspan='5'>Tối đa 100 Ngày nằm viện/Năm hợp đồng cho mỗi Bệnh/Thương tật.</td>
                    </tr>

                    <tr>
                        <td style='font-weight:  bold;' rowspan='2'>1.5</td>
                        <td rowspan='2' style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều dưỡng tại nhà</span>/ngày</td>
                        <td>125.000</td>
                        <td>250.000</td>
                        <td>350.000</td>
                        <td>500.000</td>
                        <td>750.000</td>
                    </tr>
                    <tr>
                        <td colspan='5'>Tối đa 30 ngày/Năm hợp đồng cho mỗi Bệnh/Thương tật.</td>
                    </tr>
                    
                    <tr>
                        <td style='font-weight:  bold;'>1.6</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Vật lý trị liệu</span>/Năm hợp đồng</td>
                        <td>1.000.000</td>
                        <td>2.000.000</td>
                        <td>4.000.000</td>
                        <td>6.000.000</td>
                        <td>10.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>1.7</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều trị nội trú khác</span>/Năm hợp đồng cho mỗi Bệnh/Thương tật</td>
                        <td>10.000.000</td>
                        <td>20.000.000</td>
                        <td>40.000.000</td>
                        <td>60.000.000</td>
                        <td>100.000.000</td>
                    </tr>
                </table>
                <br/>
                <div class='page-break'></div> <!-- Page break here -->
                <table class='table-BHTC' style='margin-top: 5px;'>
                    <tr>
                        <td colspan='2' rowspan='2' class='section-title' style='text-align: start;'>A. QUYỀN LỢI ĐIỀU TRỊ NỘI TRÚ</td>
                        <td colspan='5' class='section-title'>MỨC GIỚI HẠN PHỤ</td>
                    </tr>   
                    <tr>
                        <th class='highlight_coban'>CƠ BẢN</th>
                        <th class='highlight_phothong'>PHỔ THÔNG</th>
                        <th class='highlight_dacbiet'>ĐẶC BIỆT</th>
                        <th class='highlight_caocap'>CAO CẤP</th>
                        <th class='highlight_thinhvuong'>THỊNH VƯỢNG</th>
                    </tr>

                    <tr class='section-title'>
                        <td colspan='7' style='text-align: start;'>2. ĐIỀU TRỊ NGOẠI TRÚ, ĐIỀU TRỊ TRONG NGÀY VÀ ĐIỀU TRỊ CẤP CỨU</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2.1</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Phẫu thuật ngoại trú/Phẫu thuật trong ngày</span>/Năm hợp đồng cho mỗi Bệnh/Thương tật</td>
                        <td>2.500.000</td>
                        <td>5.000.000</td>
                        <td>10.000.000</td>
                        <td>15.000.000</td>
                        <td>25.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2.2</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chạy thận nhân tạo</span>/Năm hợp đồng</td>
                        <td class='highlight_khongapdung'>Không áp dụng</td>
                        <td>5.000.000</td>
                        <td>10.000.000</td>
                        <td>15.000.000</td>
                        <td>25.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2.3</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Cấp cứu do Tai nạn</span>/Năm hợp đồng cho mỗi Thương tật</td>
                        <td>1.050.000</td>
                        <td>2.100.000</td>
                        <td>5.250.000</td>
                        <td>10.500.000</td>
                        <td>15.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2.4</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>2.4. Tổn thương răng do Tai nạn</span>/Năm hợp đồng cho mỗi Thương tật</td>
                        <td>1.500.000</td>
                        <td>3.000.000</td>
                        <td>5.000.000</td>
                        <td>7.500.000</td>
                        <td>10.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2.5</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí xe cấp cứu/Năm hợp đồng cho mỗi Bệnh</span>/Thương tật</td>
                        <td>1.500.000</td>
                        <td>3.000.000</td>
                        <td>5.000.000</td>
                        <td colspan='2'>Chi phí y tế thực tế</td>
                    </tr>

                    <tr class='section-title'>
                        <td colspan='7' style='text-align: start;'>3. ĐIỀU TRỊ ĐẶC BIỆT <span style='font-weight: normal;'><i>(bao gồm Điều trị nội trú, Điều trị ngoại trú, Điều trị trong ngày)</i></span></td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>3.1</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Điều trị ung thư</span></td>
                        <td colspan='5'></td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>a</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí điều trị hóa trị (tiêm và truyền) và xạ trị</span></td>
                        <td colspan='5'>Chi phí y tế thực tế</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>b</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí điều trị liệu pháp miễn dịch (tiêm và truyền) và trúng đích (tiêm và truyền)</span>/Năm hợp đồng</td>
                        <td>10.000.000</td>
                        <td>20.000.000</td>
                        <td>40.000.000</td>
                        <td>60.000.000</td>
                        <td>100.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>c</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều trị nội trú</span></td>
                        <td colspan='5'>Theo Mức giới hạn phụ của mục <span style='font-weight:  bold;'>1. Điều trị nội trú</span></td>
                    </tr>
                    <tr>
                        <td rowspan='2' style='font-weight:  bold;'>3.2</td>
                        <td rowspan='2' style='text-align: start;'><span style='font-weight:  bold;'>Cấy ghép bộ phận cho Người được bảo hiểm (người nhận bộ phận) và người hiến bộ phận cho Người được bảo hiểm</span>/cho mỗi bộ phận được cấy ghép, bao gồm: thận, tim, gan và tủy xương trong suốt thời gian tham gia sản phẩm này</td>
                        <td>75.000.000</td>
                        <td>150.000.000</td>
                        <td>300.000.000</td>
                        <td>500.000.000</td>
                        <td>1.000.000.000</td>
                    </tr>
                    <tr>
                        <td colspan='5'>Chi phí y tế của người hiến bộ phận cho Người được bảo hiểm không được vượt quá 50% giới hạn của quyền lợi này.</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>3.3</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Điều trị Tình trạng bẩm sinh/di truyền</span> trong suốt thời gian tham gia sản phẩm này</td>
                        <td class='highlight_khongapdung'>Không áp dụng</td>
                        <td>15.000.000</td>
                        <td>25.000.000</td>
                        <td>35.000.000</td>
                        <td>55.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>3.4</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Điều trị Biến chứng thai sản</span>/lần mang thai</td>
                        <td class='highlight_khongapdung'>Không áp dụng</td>
                        <td>15.000.000</td>
                        <td>25.000.000</td>
                        <td>35.000.000</td>
                        <td>55.000.000</td>
                    </tr>
                </table>
            </div>
            <div class='page-break'></div> <!-- Page break here -->
            <div>
                <div>
                    <h3 style='display: inline;'>QUYỀN LỢI LỰA CHỌN THÊM: <i style='display: inline; font-weight: normal; font-size: 13px;'>(tùy theo lựa chọn của Bên mua bảo hiểm)</i></h3>
                    
                </div>
                <table class='table-BHTC' style='margin-top: 5px;'>
                    <tr>
                        <td colspan='2' rowspan='2' class='section-title' style='text-align: start;'>B. QUYỀN LỢI ĐIỀU TRỊ NGOẠI TRÚ</td>
                        <td colspan='5' class='section-title'>MỨC GIỚI HẠN PHỤ</td>
                    </tr>   
                    <tr>
                        <th class='highlight_coban'>CƠ BẢN</th>
                        <th class='highlight_phothong'>PHỔ THÔNG</th>
                        <th class='highlight_dacbiet'>ĐẶC BIỆT</th>
                        <th class='highlight_caocap'>CAO CẤP</th>
                        <th class='highlight_thinhvuong'>THỊNH VƯỢNG</th>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Phạm vi địa lý</td>
                        <td rowspan='4' class='highlight_khongapdung'>Không áp dụng</td>
                        <td colspan='4'>Việt Nam</td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Quyền lợi tối đa mỗi Năm hợp đồng</td>
                        <td style='font-weight:  bold;'>5.000.000</td>
                        <td style='font-weight:  bold;'>10.000.000</td>
                        <td style='font-weight:  bold;'>15.000.000</td>
                        <td style='font-weight:  bold;'>25.000.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>1</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều trị ngoại trú theo Y học hiện đại</span>/Lần khám</td>
                        <td>1.000.000</td>
                        <td>2.000.000</td>
                        <td>4.000.000</td>
                        <td>6.500.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều trị ngoại trú theo Y học thay thế</span>/Năm hợp đồng</td>
                        <td>1.500.000</td>
                        <td>2.500.000</td>
                        <td>4.000.000</td>
                        <td>6.500.000</td>
                    </tr>
                    
                    <tr>
                        <td colspan='2' rowspan='2' class='section-title' style='text-align: start;'>C. QUYỀN LỢI CHĂM SÓC RĂNG</td>
                        <td colspan='5' class='section-title'>MỨC GIỚI HẠN PHỤ</td>
                    </tr>   
                    <tr>
                        <th class='highlight_coban'>CƠ BẢN</th>
                        <th class='highlight_phothong'>PHỔ THÔNG</th>
                        <th class='highlight_dacbiet'>ĐẶC BIỆT</th>
                        <th class='highlight_caocap'>CAO CẤP</th>
                        <th class='highlight_thinhvuong'>THỊNH VƯỢNG</th>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Phạm vi địa lý</td>
                        <td colspan='3' rowspan='4' class='highlight_khongapdung'>Không áp dụng</td>
                        <td colspan='2'>Việt Nam</td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align: start;'>Quyền lợi tối đa mỗi Năm hợp đồng</td>
                        <td style='font-weight:  bold;'>10.500.000</td>
                        <td style='font-weight:  bold;'>17.500.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>1</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí cạo vôi răng<span>/Năm hợp đồng</td>
                        <td>1.000.000</td>
                        <td>1.500.000</td>
                    </tr>
                    <tr>
                        <td style='font-weight:  bold;'>2</td>
                        <td style='text-align: start;'><span style='font-weight:  bold;'>Chi phí Điều trị nha khoa khác</span> (không bao gồm chi phí cầu răng, implant, răng giả tháo lắp, flipper, trám răng bằng vàng và kim loại quý)</td>
                        <td colspan='2'>Chi phí y tế thực tế</td>
                    </tr>
                </table>
                <div class='note-container'>
                    <p><i><strong>Lưu ý:</strong> Thời gian chờ là thời gian mà các sự kiện bảo hiểm của Quyền lợi Điều trị nội trú và/hoặc Quyền lợi Điều trị ngoại trú và/hoặc Quyền lợi Chăm sóc răng do Bệnh xảy ra không được chi trả (trừ trường hợp có thỏa thuận khác giữa Dai-ichi Life Việt Nam và Bên mua bảo hiểm). Thời gian chờ này được áp dụng như sau:</i></p>
                    <ul class='nested-list' style='list-style-type:none'>
                        <li><i>(i) 30 (ba mươi) ngày tính từ ngày bắt đầu Thời hạn bảo hiểm; hoặc 10 (mười) ngày tính từ ngày Dai-ichi Life Việt Nam chấp nhận khôi phục hiệu lực gần nhất của sản phẩm bảo hiểm này; tùy vào sự kiện nào diễn ra trễ hơn.</i></li>
                        <li><i>(ii) 90 (chín mươi) ngày tính từ ngày bắt đầu Thời hạn bảo hiểm của Năm hợp đồng đầu tiên của sản phẩm bảo hiểm này cho những Bệnh đặc biệt.</i></li>
                    </ul>
                </div>
            </div>
        ":""
    )
    ."
</body>
</html>
";

// Tạo thư mục lưu PDF nếu chưa tồn tại
$pdfDir = '../exports/';
if (!is_dir($pdfDir)) {
    mkdir($pdfDir, 0777, true);
}

try {
    // Khởi tạo mPDF và lưu file PDF
    $mpdf = new \Mpdf\Mpdf([
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_left' => 10,
        'margin_right' => 10,
    ]);
    // Optional: force page breaks if you need
    $mpdf->SetAutoPageBreak(true, 30);

    // Set the watermark
    $mpdf->SetWatermarkText($writer, 0.05); // 0.1 is the opacity
    $mpdf->showWatermarkText = true; // Enable watermark display

    // Define the footer
    $footerHtml = "
        <table style='font-size: 12px; font-weight: normal; width: 100%; background-color: #fff;'>
            <tr>
                <td colspan='2' style='font-weight: normal; text-align: start; color:  #929292;'>Nhân viên tư vấn: {$nhanVienTuVan}</td>
            </tr>
            <tr>
                <td style='font-weight: normal; text-align: start; color: #929292;'>Số điện thoại: {$sdt}</td>
                <td style='font-weight: normal; text-align: center; color:  #929292;'>Văn phòng: {$vanPhong}</td>
            </tr>
        </table>
    ";
    $mpdf->SetHTMLFooter($footerHtml);

    // Write the HTML content
    $mpdf->WriteHTML($htmlContent);

    $pdfFileName = 'DAI_ICHI_Report' . '_' . date('Y-m-d-H-i-s') . '.pdf';
    $pdfPath = $pdfDir . $pdfFileName;

    $mpdf->Output($pdfPath, 'F'); // Lưu file PDF


    // Trả về đường dẫn file PDF
    echo json_encode([
        'success' => true,
        'pdfUrl' => 'exports/' . $pdfFileName
    ]);
} catch (\Mpdf\MpdfException $e) {
    // Xử lý lỗi mPDF
    echo json_encode([
        'success' => false,
        'message' => 'Lỗi khi tạo PDF: ' . $e->getMessage()
    ]);
}
