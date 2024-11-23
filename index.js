console.log("Hello World!");

function extractAge(ageString) {
  // Regular expression to match numbers followed by specific keywords
  const regex = /(\d+)\s*tuổi|(\d+)\s*tháng|(\d+)\s*ngày/g;
  let match;
  let years = 0,
    months = 0,
    days = 0;

  // Loop through all matches
  while ((match = regex.exec(ageString)) !== null) {
    if (match[1]) years = parseInt(match[1], 10);
    if (match[2]) months = parseInt(match[2], 10);
    if (match[3]) days = parseInt(match[3], 10);
  }

  return { years, months, days };
}

// Function to get a row based on conditions
function getRow(data, age, type, sex, groupNumber) {
  let group = "Nhom 1";
  if (groupNumber === "1") {
    group = "Nhom 1";
  }
  if (groupNumber === "2") {
    group = "Nhom 2";
  }
  if (groupNumber === "3") {
    group = "Nhom 3";
  }
  if (groupNumber === "4") {
    group = "Nhom 4";
  }

  if (type == "ATSH") {
    return data.find(
      (row) =>
        row[0] === age && row[1] === type && row[2] === sex && row[3] === group
    );
  } else {
    return data.find(
      (row) => row[0] === age && row[1] === sex && row[2] === group
    );
  }
}

function updateAmountText(currentInputId, priority, inputOtherId) {
  const currentInput = document.getElementById(currentInputId);
  // const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  // const gioiTinhDoc = document.getElementById(`gioiTinh_${priority}`);
  // const goiBaoHiemDoc = document.getElementById(`goiBaoHiem`);
  // const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  // const thoiHanDoc = document.getElementById('thoiHan');
  // const { years, months, days } = extractAge(tuoiDoc.value);
  // let amount = 0;

  // if (goiBaoHiemDoc.value == 'ATSH') {
  //   const row = getRow(dataResultATSH, years.toString(), goiBaoHiemDoc.value, gioiTinhDoc.value, nhomNgheDoc.value);

  //   if (parseInt(thoiHanDoc.value) < 26) {
  //     amount = row[4];
  //   }else {
  //     amount = row[5];
  //   }
  // } else {
  //   const row = getRow(dataResult, years.toString(), '', gioiTinhDoc.value, nhomNgheDoc.value);

  //   if (row) {
  //     amount = row[3];
  //   }
  // }

  //  Loại bỏ dấu cham '.' trong số
  let advanceAmount = currentInput.value.replace(/\./g, "");
  // check if not a number
  if (isNaN(advanceAmount)) {
    alert("Vui lòng nhập số");
    currentInput.value = "";
    return;
  }
  const table = document.getElementById(`tableMain_${priority}`);
  const redLine = document.getElementById(`lineRed_${priority}`);
  // remove class d-none
  table.classList.remove("d-none");
  redLine.classList.remove("d-none");
  // const chiPhi = (parseFloat(advanceAmount.replace(/,/g, '')) * parseFloat(amount.replace(/,/g, ''))) / 1000000000;
  currentInput.value = formatNumber(advanceAmount); // Chèn dấu phẩy vào số
  // update chi phi
  updateChiPhi(priority, inputOtherId);
}

function updateChiPhi(priority, inputChiPhiId) {
  const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  const gioiTinhDoc = document.getElementById(`gioiTinh_${priority}`);
  const goiBaoHiemDoc = document.getElementById(`goiBaoHiem`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  const thoiHanDoc = document.getElementById("thoiHan");
  const { years } = extractAge(tuoiDoc.value);
  const soTienBaoHiemDoc = document.getElementById(`soTienBaoHiem_${priority}`);
  const inputChiPhi = document.getElementById(inputChiPhiId);
  let amount = 0;

  changeInputMoney("BHNCaoCap", priority);
  changeInputMoney("BHUngThu", priority);

  if (priority == 1) {
    if (goiBaoHiemDoc.value == "ATSH") {
      const row = getRow(
        dataResultATSH,
        years.toString(),
        goiBaoHiemDoc.value,
        gioiTinhDoc.value,
        nhomNgheDoc.value
      );

      if (parseInt(thoiHanDoc.value) < 26) {
        amount = row[4];
      } else {
        amount = row[5];
      }
    } else {
      const row = getRow(
        dataResultATDT,
        years.toString(),
        "",
        gioiTinhDoc.value,
        nhomNgheDoc.value
      );

      if (row) {
        amount = row[3];
      }
    }

    let advanceAmount = soTienBaoHiemDoc.value.replace(/\./g, "");

    const chiPhi = advanceAmount
      ? (parseFloat(advanceAmount.replace(/,/g, "")) *
          parseFloat(amount.replace(/,/g, ""))) /
        1000000000
      : 0;
    inputChiPhi.value = formatNumber(chiPhi.toFixed(0));
  }
  updateTotalPhiCoBanByPriority(priority);
}

function formatNumber(num) {
  return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function convertNumberToTextVND(total) {
  try {
    let rs = "";
    let ch = [
      "không",
      "một",
      "hai",
      "ba",
      "bốn",
      "năm",
      "sáu",
      "bảy",
      "tám",
      "chín",
    ];
    let rch = ["lẻ", "mốt", "", "", "", "lăm"];
    let u = [
      "",
      "mươi",
      "trăm",
      "ngàn",
      "",
      "",
      "triệu",
      "",
      "",
      "tỷ",
      "",
      "",
      "ngàn",
      "",
      "",
      "triệu",
    ];
    let nstr = total.toString();
    let n = Array.from(nstr).reverse().map(Number);
    let len = n.length;

    for (let i = len - 1; i >= 0; i--) {
      if (i % 3 === 2) {
        if (n[i] === 0 && n[i - 1] === 0 && n[i - 2] === 0) continue;
      } else if (i % 3 === 1) {
        if (n[i] === 0) {
          if (n[i - 1] === 0) continue;
          else {
            rs += " " + rch[n[i]];
            continue;
          }
        }
        if (n[i] === 1) {
          rs += " mười";
          continue;
        }
      } else if (i !== len - 1) {
        if (n[i] === 0) {
          if (i + 2 <= len - 1 && n[i + 2] === 0 && n[i + 1] === 0) continue;
          rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
          continue;
        }
        if (n[i] === 1) {
          rs += " " + (n[i + 1] === 1 || n[i + 1] === 0 ? ch[n[i]] : rch[n[i]]);
          rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
          continue;
        }
        if (n[i] === 5) {
          if (n[i + 1] !== 0) {
            rs += " " + rch[n[i]];
            rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
            continue;
          }
        }
      }
      rs += (rs === "" ? " " : ", ") + ch[n[i]];
      rs += " " + (i % 3 === 0 ? u[i] : u[i % 3]);
    }

    rs = rs
      .trim()
      .replace(/lẻ,|mươi,|trăm,|mười,/g, (match) => match.slice(0, -1));

    if (rs.slice(-1) !== " ") {
      rs += " đồng";
    } else {
      rs += "đồng";
    }

    return rs.charAt(0).toUpperCase() + rs.slice(1);
  } catch (ex) {
    console.error(ex);
    return "";
  }
}

// Hàm tính tuổi
function calculateAge(input, priority) {
  const birthDateInput = input.value; // Lấy giá trị từ phần tử được truyền vào
  const ageOutput = document.getElementById(`tuoi_${priority}`); // Lấy phần tử hiển thị kết quả
  const checkBoxNoiTruDoc = document.getElementById(`noiTru_${priority}`);
  const checkBoxNoiTru20Doc = document.getElementById(`noiTru20_${priority}`);
  const checkBoxNgoaiTruDoc = document.getElementById(`ngoaiTru_${priority}`);
  const checkBoxHoTroVienPhiDoc = document.getElementById(
    `hoTroVienPhi_${priority}`
  );
  const checkBoxBHNCaoCapDoc = document.getElementById(`BHNCaoCap_${priority}`);
  const checkBoxBHUngThuDoc = document.getElementById(`BHUngThu_${priority}`);
  console.log(birthDateInput);
  if (birthDateInput) {
    const birthDate = new Date(birthDateInput);
    const today = new Date();

    // Tính số năm, tháng, ngày
    let years = today.getFullYear() - birthDate.getFullYear();
    let months = today.getMonth() - birthDate.getMonth();
    let days = today.getDate() - birthDate.getDate();

    // Điều chỉnh nếu tháng hoặc ngày chưa đến
    if (days < 0) {
      months -= 1;
      days += new Date(today.getFullYear(), today.getMonth(), 0).getDate(); // Số ngày của tháng trước
    }
    if (months < 0) {
      years -= 1;
      months += 12;
    }

    if (years < 0) {
      ageOutput.value = ""; // Xóa giá trị nếu ngày sinh không hợp lệ
      Swal.fire({
        position: "center",
        icon: "warning",
        text: "Số tuổi không hợp lệ",
        showConfirmButton: false,
        timer: 1500,
      });
      return;
    }
    // if (years > maxAge) {
    //   ageOutput.value = ""; // Xóa giá trị nếu ngày sinh không hợp lệ
    //   Swal.fire({
    //     position: "center",
    //     icon: "warning",
    //     text: "Số tuổi không hợp lệ",
    //     showConfirmButton: false,
    //     timer: 1500,
    //   });
    //   return;
    // }
    // Hiển thị kết quả
    ageOutput.value = `${years} tuổi ${months} tháng ${days} ngày`;
    updateChiPhi(priority, `phiCoban_${priority}`);
    if (checkBoxNoiTruDoc.checked) {
      handleChangeSelect("noiTru", priority);
    }
    if (checkBoxNoiTru20Doc.checked) {
      handleChangeSelect("noiTru20", priority);
    }
    if (checkBoxNgoaiTruDoc.checked) {
      handleChangeSelect("ngoaiTru", priority);
    }
    if (checkBoxHoTroVienPhiDoc.checked) {
      changeInputMoney("hoTroVienPhi", priority);
    }
    if (checkBoxBHUngThuDoc.checked) {
      changeInputMoney("BHUngThu", priority);
    }
    if (checkBoxBHNCaoCapDoc.checked) {
      changeInputMoney("BHNCaoCap", priority);
    }
  } else {
    ageOutput.value = ""; // Xóa giá trị nếu ngày sinh không hợp lệ
  }
}

function getGroup(nhomNghe) {
  if (nhomNghe == "1") {
    return "Nhom 1";
  }
  if (nhomNghe == "2") {
    return "Nhom 2";
  }
  if (nhomNghe == "3") {
    return "Nhom 3";
  }
  if (nhomNghe == "4") {
    return "Nhom 4";
  }
}

function getSelect(type) {
  if (type == "pho_thong") {
    return "Pho thong";
  }
  if (type == "dac_biet") {
    return "Dac biet";
  }
  if (type == "cao_cap") {
    return "Cao cap";
  }
  if (type == "co_ban") {
    return "Co ban";
  }
  if (type == "thinh_vuong") {
    return "Thinh vuong";
  }
}

function handleChecked(type, priority) {
  const checkBoxDoc = document.getElementById(`${type}_${priority}`);
  const selectDoc = document.getElementById(`${type}LuaChon_${priority}`);
  const wrapperPhiCobanDoc = document.getElementById(
    `${type}WrapperPhiCoBan_${priority}`
  );
  const phiCoban = document.getElementById(`${type}PhiCoBan_${priority}`);
  const ngaySinhDoc = document.getElementById(`ngaySinh_${priority}`);
  const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  // validate input
  if (validateInput(priority) == false) {
    checkBoxDoc.checked = false;
    return;
  }
  showTable(priority);

  if (checkBoxDoc.checked) {
    // enable select
    selectDoc.disabled = false;
    // remove class d-none
    wrapperPhiCobanDoc.classList.remove("d-none");

    const { years } = extractAge(tuoiDoc.value);

    const row = dataResultCSSKTC.find(
      (row) =>
        row[0] === years.toString() &&
        row[1] === getGroup(nhomNgheDoc.value) &&
        row[2] === getSelect(selectDoc.value)
    );

    if (type == "noiTru") {
      phiCoban.value = formatNumber(row[3].replace(/,/g, ""));
    }
    if (type == "noiTru20") {
      phiCoban.value = formatNumber(row[4].replace(/,/g, ""));
    }
    if (type == "ngoaiTru") {
      phiCoban.value = formatNumber(row[5].replace(/,/g, ""));
    }
  } else {
    // disable select
    selectDoc.disabled = true;
    // add class d-none
    wrapperPhiCobanDoc.classList.add("d-none");
    phiCoban.value = "";
  }
  updateTotalPhiCoBanByPriority(priority);
}

function handleChangeSelect(type, priority) {
  const selectDoc = document.getElementById(`${type}LuaChon_${priority}`);
  const phiCoban = document.getElementById(`${type}PhiCoBan_${priority}`);
  const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  // // validate input
  // if (validateInput(priority) == false) {
  //   return;
  // }

  if (selectDoc.value) {
    const { years } = extractAge(tuoiDoc.value);

    console.log(years.toString());
    console.log(getGroup(nhomNgheDoc.value));
    console.log(getSelect(selectDoc.value));

    const row = dataResultCSSKTC.find(
      (row) =>
        row[0] === years.toString() &&
        row[1] === getGroup(nhomNgheDoc.value) &&
        row[2] === getSelect(selectDoc.value)
    );

    console.log(row);

    if (type == "noiTru") {
      phiCoban.value = formatNumber(row[3].replace(/,/g, ""));
    }
    if (type == "noiTru20") {
      phiCoban.value = formatNumber(row[4].replace(/,/g, ""));
    }
    if (type == "ngoaiTru") {
      phiCoban.value = formatNumber(row[5].replace(/,/g, ""));
    }

    updateTotalPhiCoBanByPriority(priority);
  }
}

function handleCheckedWithInputMoney(type, priority) {
  const checkBoxDoc = document.getElementById(`${type}_${priority}`);
  const inputMoneyDoc = document.getElementById(`${type}SotienBH_${priority}`);
  const phiCobanDoc = document.getElementById(`${type}PhiCoBan_${priority}`);
  const luaChonDoc = document.getElementById(`${type}LuaChon_${priority}`);
  // validate input
  if (validateInput(priority) == false) {
    checkBoxDoc.checked = false;
    return;
  }
  showTable(priority);

  if (checkBoxDoc.checked) {
    // enable select
    if (type == "hoTroVienPhi") {
      luaChonDoc.disabled = false;
      changeInputMoney(type, priority);
    } else {
      inputMoneyDoc.disabled = false;
    }
  } else {
    if (type == "hoTroVienPhi") {
      // disable select
      luaChonDoc.disabled = true;
    } else {
      // disable select
      inputMoneyDoc.disabled = true;
      inputMoneyDoc.value = "";
    }

    // add class d-none
    phiCobanDoc.value = "";
  }
  updateTotalPhiCoBanByPriority(priority);
}

function changeInputMoney(type, priority) {
  const inputMoneyDoc = document.getElementById(`${type}SotienBH_${priority}`);
  const phiCobanDoc = document.getElementById(`${type}PhiCoBan_${priority}`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  const gioiTinhDoc = document.getElementById(`gioiTinh_${priority}`);
  const checkBoxDoc = document.getElementById(`${type}_${priority}`);

  // if not checked then return
  if (!checkBoxDoc.checked) {
    return;
  }

  if (type == "hoTroVienPhi") {
    // validate input
    // if (validateInput(priority) == false) {
    //   return;
    // }
    const luaChonDoc = document.getElementById(`${type}LuaChon_${priority}`);
    const { years } = extractAge(tuoiDoc.value);
    let age = years.toString();

    if (years <= 4 && years >= 0) {
      age = "0 - 4";
    }
    // 5-18
    if (years <= 18 && years > 4) {
      age = "5 - 18";
    }
    // 19-40
    if (years <= 40 && years > 18) {
      age = "19 - 40";
    }
    // 41-45
    if (years <= 45 && years > 40) {
      age = "41 - 45";
    }
    // 46-50
    if (years <= 50 && years > 45) {
      age = "46 - 50";
    }
    // 51-55
    if (years <= 55 && years > 50) {
      age = "51 - 55";
    }
    // 56-60
    if (years <= 60 && years > 55) {
      age = "56 - 60";
    }

    const row = dataResultHTVP.find(
      (row) => row[0].trim() === age && row[1] === getGroup(nhomNgheDoc.value)
    );
    if (row) {
      const chiPhi =
        (parseFloat(luaChonDoc.value.replace(/,/g, "")) *
          parseFloat(row[2].trim().replace(/,/g, ""))) /
        100000;
      phiCobanDoc.value = formatNumber(chiPhi.toFixed(0));
    } else {
      phiCobanDoc.value = "";
    }
    updateTotalPhiCoBanByPriority(priority);
  } else {
    // validate input
    // if (validateInput(priority) == false) {
    //   inputMoneyDoc.value = "";

    //   return;
    // }
    const inputMoney = inputMoneyDoc.value.replace(/\./g, "");
    inputMoneyDoc.value = formatNumber(inputMoney);

    if (inputMoneyDoc.value) {
      if (type == "taiNanCC") {
        const row = dataResultTNCC.find(
          (row) => row[0] === getGroup(nhomNgheDoc.value)
        );
        if (row) {
          const chiPhi =
            (parseFloat(inputMoney.replace(/,/g, "")) *
              parseFloat(row[1].trim().replace(/,/g, ""))) /
            1000000000;
          phiCobanDoc.value = formatNumber(chiPhi.toFixed(0));
        } else {
          phiCobanDoc.value = "";
        }
      }
      if (type == "BHNCaoCap") {
        const { years } = extractAge(tuoiDoc.value);
        let age = years.toString();
        if (years <= 15 && years > 0 && gioiTinhDoc.value == "Nam") {
          age = "1-15";
        }
        if (years <= 12 && years > 0 && gioiTinhDoc.value == "Nu") {
          age = "1-12";
        }
        const row = dataResultBHCCTD.find(
          (row) => row[0] === age && row[1] === gioiTinhDoc.value
        );
        console.log(row);
        if (row) {
          const chiPhi =
            (parseFloat(inputMoney.replace(/,/g, "")) *
              parseFloat(row[2].trim().replace(/,/g, ""))) /
            1000000000;
          phiCobanDoc.value = formatNumber(chiPhi.toFixed(0));
        } else {
          phiCobanDoc.value = "";
        }
      }
      if (type == "BHUngThu") {
        const { years } = extractAge(tuoiDoc.value);
        let age = years.toString();
        const row = dataResultHTDTUT.find(
          (row) => row[0] === age && row[1] === gioiTinhDoc.value
        );
        console.log(row);
        if (row) {
          const chiPhi =
            (parseFloat(inputMoney.replace(/,/g, "")) *
              parseFloat(row[2].trim().replace(/,/g, ""))) /
            1000000000;
          phiCobanDoc.value = formatNumber(chiPhi.toFixed(0));
        } else {
          phiCobanDoc.value = "";
        }
      }

      updateTotalPhiCoBanByPriority(priority);
    }
  }
}

function updateTotalPhiCoBanByPriority(priority) {
  console.log("updateTotalPhiCoBanByPriority");
  const table = document.getElementById(`tableMain_${priority}`);
  const redLine = document.getElementById(`lineRed_${priority}`);
  const phi1NamDoc = document.getElementById(`phi1Nam_${priority}`);
  const phiNuaNamDoc = document.getElementById(`phiNuaNam_${priority}`);
  const phiQuyDoc = document.getElementById(`phiQuy_${priority}`);

  const phiCoban = document.getElementById(`phiCoban_${priority}`);
  const phiCobanNoiTru = document.getElementById(`noiTruPhiCoBan_${priority}`);
  const phiCobanNoiTru20 = document.getElementById(
    `noiTru20PhiCoBan_${priority}`
  );
  const phiCobanNgoaiTru = document.getElementById(
    `ngoaiTruPhiCoBan_${priority}`
  );
  const phiCoBanTaiNanCC = document.getElementById(
    `taiNanCCPhiCoBan_${priority}`
  );
  const phiCobanHoTroVienPhi = document.getElementById(
    `hoTroVienPhiPhiCoBan_${priority}`
  );
  const phiCobanBHNCaoCap = document.getElementById(
    `BHNCaoCapPhiCoBan_${priority}`
  );
  const phiCobanBHUngThu = document.getElementById(
    `BHUngThuPhiCoBan_${priority}`
  );

  const checkBoxNoiTruDoc = document.getElementById(`noiTru_${priority}`);
  const checkBoxNoiTru20Doc = document.getElementById(`noiTru20_${priority}`);
  const checkBoxNgoaiTruDoc = document.getElementById(`ngoaiTru_${priority}`);
  const checkBoxTaiNanCCDoc = document.getElementById(`taiNanCC_${priority}`);
  const checkBoxHoTroVienPhiDoc = document.getElementById(
    `hoTroVienPhi_${priority}`
  );
  const checkBoxBHNCaoCapDoc = document.getElementById(`BHNCaoCap_${priority}`);
  const checkBoxBHUngThuDoc = document.getElementById(`BHUngThu_${priority}`);

  const phiCobanValue =
    phiCoban && phiCoban.value
      ? parseFloat(phiCoban.value.replace(/\./g, ""))
      : 0;
  const phiCobanNoiTruValue = phiCobanNoiTru.value
    ? parseFloat(phiCobanNoiTru.value.replace(/\./g, ""))
    : 0;
  const phiCobanNoiTru20Value = phiCobanNoiTru20.value
    ? parseFloat(phiCobanNoiTru20.value.replace(/\./g, ""))
    : 0;
  const phiCobanNgoaiTruValue = phiCobanNgoaiTru.value
    ? parseFloat(phiCobanNgoaiTru.value.replace(/\./g, ""))
    : 0;
  const phiCoBanTaiNanCCValue = phiCoBanTaiNanCC.value
    ? parseFloat(phiCoBanTaiNanCC.value.replace(/\./g, ""))
    : 0;
  const phiCobanHoTroVienPhiValue = phiCobanHoTroVienPhi.value
    ? parseFloat(phiCobanHoTroVienPhi.value.replace(/\./g, ""))
    : 0;
  const phiCobanBHNCaoCapValue = phiCobanBHNCaoCap.value
    ? parseFloat(phiCobanBHNCaoCap.value.replace(/\./g, ""))
    : 0;
  const phiCobanBHUngThuValue = phiCobanBHUngThu.value
    ? parseFloat(phiCobanBHUngThu.value.replace(/\./g, ""))
    : 0;

  let total = 0;

  if (priority == 1) {
    total += phiCobanValue;
  }

  if (checkBoxNoiTruDoc.checked && phiCobanNoiTruValue) {
    total += phiCobanNoiTruValue;
  }
  if (checkBoxNoiTru20Doc.checked) {
    total += phiCobanNoiTru20Value;
  }
  if (checkBoxNgoaiTruDoc.checked) {
    total += phiCobanNgoaiTruValue;
  }
  if (checkBoxTaiNanCCDoc.checked) {
    total += phiCoBanTaiNanCCValue;
  }
  if (checkBoxHoTroVienPhiDoc.checked) {
    total += phiCobanHoTroVienPhiValue;
  }
  if (checkBoxBHNCaoCapDoc.checked) {
    total += phiCobanBHNCaoCapValue;
  }
  if (checkBoxBHUngThuDoc.checked) {
    total += phiCobanBHUngThuValue;
  }

  if (
    total == 0 &&
    !checkBoxNoiTruDoc.checked &&
    !checkBoxNoiTru20Doc.checked &&
    !checkBoxNgoaiTruDoc.checked &&
    !checkBoxTaiNanCCDoc.checked &&
    !checkBoxHoTroVienPhiDoc.checked &&
    !checkBoxBHNCaoCapDoc.checked &&
    !checkBoxBHUngThuDoc.checked
  ) {
    table.classList.add("d-none");
    redLine.classList.add("d-none");
  }

  const phi1Nam = total * 1;
  const phiNuaNam = total * 0.5;
  const phiQuy = total * 0.25;

  phi1NamDoc.innerText = formatNumber(phi1Nam.toFixed(0));
  phiNuaNamDoc.innerText = formatNumber(phiNuaNam.toFixed(0));
  phiQuyDoc.innerText = formatNumber(phiQuy.toFixed(0));

  updateTotalChiPhi();
}

function validateInput(priority) {
  const ngaySinhDoc = document.getElementById(`ngaySinh_${priority}`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);

  if (!ngaySinhDoc.value) {
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "Vui lòng nhập ngày sinh",
      showConfirmButton: false,
      timer: 1500,
    });
    return false;
  }
  if (!nhomNgheDoc.value) {
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "Vui lòng chọn nhóm nghề",
      showConfirmButton: false,
      timer: 1500,
    });
    return false;
  }
  return true;
}

function updateTotalChiPhi() {
  const phi1Nam1 = document.getElementById("phi1Nam_1");
  const phi1Nam2 = document.getElementById("phi1Nam_2");
  const phi1Nam3 = document.getElementById("phi1Nam_3");
  const phi1Nam4 = document.getElementById("phi1Nam_4");

  const totalQuy = document.getElementById("totalQuy");
  const totalNuaNam = document.getElementById("totalNuaNam");
  const total1Nam = document.getElementById("total1Nam");

  const total1 = parseFloat(phi1Nam1.innerText.replace(/\./g, ""));
  const total2 = parseFloat(phi1Nam2.innerText.replace(/\./g, ""));
  const total3 = parseFloat(phi1Nam3.innerText.replace(/\./g, ""));
  const total4 = parseFloat(phi1Nam4.innerText.replace(/\./g, ""));

  const totalPhi1Nam = total1 + total2 + total3 + total4;
  const totalPhiNuaNam = totalPhi1Nam / 2;
  const totalPhiQuy = totalPhi1Nam / 4;

  total1Nam.innerText = `Năm (VNĐ): ${formatNumber(totalPhi1Nam.toFixed(0))}`;
  totalNuaNam.innerText = `Nửa năm (VNĐ): ${formatNumber(
    totalPhiNuaNam.toFixed(0)
  )}`;
  totalQuy.innerText = `QUÝ (VNĐ): ${formatNumber(totalPhiQuy.toFixed(0))}`;
}

function clearData() {
  const priority = priorityDeleteGlobal;

  const ngaySinhDoc = document.getElementById(`ngaySinh_${priority}`);
  const tuoiDoc = document.getElementById(`tuoi_${priority}`);
  const gioiTinhDoc = document.getElementById(`gioiTinh_${priority}`);
  const nhomNgheDoc = document.getElementById(`nhomNghe_${priority}`);
  const goiBaoHiemDoc = document.getElementById(`goiBaoHiem`);
  const thoiHanDoc = document.getElementById("thoiHan");
  const soTienBaoHiemDoc = document.getElementById(`soTienBaoHiem_${priority}`);
  const phiCobanDoc = document.getElementById(`phiCoban_${priority}`);

  const noiTruDoc = document.getElementById(`noiTru_${priority}`);
  const noiTruLuaChonDoc = document.getElementById(`noiTruLuaChon_${priority}`);
  const noiTruPhiCoBanDoc = document.getElementById(
    `noiTruPhiCoBan_${priority}`
  );
  const noiTruWrapperPhiCoBanDoc = document.getElementById(
    `noiTruWrapperPhiCoBan_${priority}`
  );

  const noiTru20Doc = document.getElementById(`noiTru20_${priority}`);
  const noiTru20LuaChonDoc = document.getElementById(
    `noiTru20LuaChon_${priority}`
  );
  const noiTru20PhiCoBanDoc = document.getElementById(
    `noiTru20PhiCoBan_${priority}`
  );
  const noiTru20WrapperPhiCoBanDoc = document.getElementById(
    `noiTru20WrapperPhiCoBan_${priority}`
  );

  const ngoaiTruDoc = document.getElementById(`ngoaiTru_${priority}`);
  const ngoaiTruLuaChonDoc = document.getElementById(
    `ngoaiTruLuaChon_${priority}`
  );
  const ngoaiTruPhiCoBanDoc = document.getElementById(
    `ngoaiTruPhiCoBan_${priority}`
  );
  const ngoaiTruWrapperPhiCoBanDoc = document.getElementById(
    `ngoaiTruWrapperPhiCoBan_${priority}`
  );

  const taiNanCCDoc = document.getElementById(`taiNanCC_${priority}`);
  const taiNanCCSotienBHDoc = document.getElementById(
    `taiNanCCSotienBH_${priority}`
  );
  const taiNanCCPhiCoBanDoc = document.getElementById(
    `taiNanCCPhiCoBan_${priority}`
  );

  const hoTroVienPhiDoc = document.getElementById(`hoTroVienPhi_${priority}`);
  const hoTroVienPhiLuaChonDoc = document.getElementById(
    `hoTroVienPhiLuaChon_${priority}`
  );
  const hoTroVienPhiPhiCoBanDoc = document.getElementById(
    `hoTroVienPhiPhiCoBan_${priority}`
  );

  const BHNCaoCapDoc = document.getElementById(`BHNCaoCap_${priority}`);
  const BHNCaoCapSotienBHDoc = document.getElementById(
    `BHNCaoCapSotienBH_${priority}`
  );
  const BHNCaoCapPhiCoBanDoc = document.getElementById(
    `BHNCaoCapPhiCoBan_${priority}`
  );

  const BHUngThuDoc = document.getElementById(`BHUngThu_${priority}`);
  const BHUngThuSotienBHDoc = document.getElementById(
    `BHUngThuSotienBH_${priority}`
  );
  const BHUngThuPhiCoBanDoc = document.getElementById(
    `BHUngThuPhiCoBan_${priority}`
  );

  const phi1NamDoc = document.getElementById(`phi1Nam_${priority}`);
  const phiNuaNamDoc = document.getElementById(`phiNuaNam_${priority}`);
  const phiQuyDoc = document.getElementById(`phiQuy_${priority}`);
  const table = document.getElementById(`tableMain_${priority}`);
  const redLine = document.getElementById(`lineRed_${priority}`);

  ngaySinhDoc.value = "";
  tuoiDoc.value = "";
  gioiTinhDoc.value = "Nam";
  nhomNgheDoc.value = "";
  if (priority == 1) {
    goiBaoHiemDoc.value = "ATDT";
    thoiHanDoc.value = "26";
    soTienBaoHiemDoc.value = "";
    phiCobanDoc.value = "";
  }

  noiTruDoc.checked = false;
  noiTruLuaChonDoc.disabled = true;
  noiTruPhiCoBanDoc.value = "";
  noiTruWrapperPhiCoBanDoc.classList.add("d-none");

  noiTru20Doc.checked = false;
  noiTru20LuaChonDoc.disabled = true;
  noiTru20PhiCoBanDoc.value = "";
  noiTru20WrapperPhiCoBanDoc.classList.add("d-none");

  ngoaiTruDoc.checked = false;
  ngoaiTruLuaChonDoc.disabled = true;
  ngoaiTruPhiCoBanDoc.value = "";
  ngoaiTruWrapperPhiCoBanDoc.classList.add("d-none");

  taiNanCCDoc.checked = false;
  taiNanCCSotienBHDoc.value = "";
  taiNanCCSotienBHDoc.disabled = true;
  taiNanCCPhiCoBanDoc.value = "";
  taiNanCCPhiCoBanDoc.disabled = true;

  hoTroVienPhiDoc.checked = false;
  hoTroVienPhiLuaChonDoc.disabled = true;
  hoTroVienPhiPhiCoBanDoc.value = "";
  hoTroVienPhiPhiCoBanDoc.disabled = true;

  BHNCaoCapDoc.checked = false;
  BHNCaoCapSotienBHDoc.value = "";
  BHNCaoCapSotienBHDoc.disabled = true;
  BHNCaoCapPhiCoBanDoc.value = "";
  BHNCaoCapPhiCoBanDoc.disabled = true;

  BHUngThuDoc.checked = false;
  BHUngThuSotienBHDoc.value = "";
  BHUngThuSotienBHDoc.disabled = true;
  BHUngThuPhiCoBanDoc.value = "";
  BHUngThuPhiCoBanDoc.disabled = true;

  phi1NamDoc.innerText = "0";
  phiNuaNamDoc.innerText = "0";
  phiQuyDoc.innerText = "0";
  table.classList.add("d-none");
  redLine.classList.add("d-none");

  updateTotalChiPhi();

  const modal = bootstrap.Modal.getInstance(
    document.getElementById("exampleModal1")
  );
  modal.hide();
}

function showTable(priority) {
  const table = document.getElementById(`tableMain_${priority}`);
  const redLine = document.getElementById(`lineRed_${priority}`);
  // remove class d-none
  table.classList.remove("d-none");
  redLine.classList.remove("d-none");
}
// --------------------- Created By InCoder ---------------------
